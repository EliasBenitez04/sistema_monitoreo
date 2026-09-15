<?php

namespace App\Services\Redistribucion;

class RedistribucionPlanner
{
    /**
     * Calcula sugerencias sin acceder a base de datos.
     *
     * @param iterable<int, mixed> $datos
     * @param array<int, string|int> $codigosBloqueados
     * @param array<string, mixed> $options
     * @return array{sugerencias: array<int, array<string, mixed>>, cantidad_sugerencias: int, total_unidades: int}
     */
    public function plan(iterable $datos, array $codigosBloqueados = [], array $options = []): array
    {
        $options = array_merge([
            'origenes' => [22, 6, 3, 4, 7, 5],
            'destinos' => [9, 8, 14, 16, 2, 15],
            'porcentaje_stock_origen' => 0.05,
            'multiplicador_stock_destino' => 2.00,
        ], $options);

        $origenesPrioridad = array_values(array_map('intval', $options['origenes']));
        $destinosPrioridad = array_values(array_map('intval', $options['destinos']));
        $retencionOrigen = (float) $options['porcentaje_stock_origen'];
        $coberturaDestino = (float) $options['multiplicador_stock_destino'];

        $bloqueados = [];
        foreach ($codigosBloqueados as $codigo) {
            $bloqueados[(string) $codigo] = true;
        }

        $porCodigo = [];
        foreach ($datos as $item) {
            $codigo = trim((string) $this->value($item, 'codigo'));
            if ($codigo === '') {
                continue;
            }

            $porCodigo[$codigo][] = $item;
        }

        $sugerencias = [];
        $totalUnidades = 0;

        foreach ($porCodigo as $codigo => $items) {
            if (isset($bloqueados[$codigo])) {
                continue;
            }

            $origenes = [];
            $destinos = [];

            foreach ($items as $item) {
                $sucursalId = (int) $this->value($item, 'sucursal_id');
                $venta = (int) $this->value($item, 'cant_vta');
                $stock = (int) $this->value($item, 'stock_actual');

                $stockObjetivoOrigen = (int) ceil($venta * $retencionOrigen);
                $exceso = $stock - $stockObjetivoOrigen;

                $stockObjetivoDestino = (int) ceil($venta * $coberturaDestino);
                $necesidad = $stockObjetivoDestino - $stock;

                if (in_array($sucursalId, $destinosPrioridad, true) && $venta >= 0 && $necesidad >= 0) {
                    $destinos[] = [
                        'sucursal_id' => $sucursalId,
                        'venta' => $venta,
                        'stock' => $stock,
                        'stock_objetivo' => $stockObjetivoDestino,
                        'necesidad' => $necesidad,
                    ];
                }

                if (in_array($sucursalId, $origenesPrioridad, true) && $exceso >= 0) {
                    $origenes[] = [
                        'sucursal_id' => $sucursalId,
                        'venta' => $venta,
                        'stock' => $stock,
                        'stock_objetivo' => $stockObjetivoOrigen,
                        'exceso' => $exceso,
                    ];
                }
            }

            $this->sortByPriority($destinos, $destinosPrioridad);
            $this->sortByPriority($origenes, $origenesPrioridad);

            foreach ($destinos as $destino) {
                $pendienteTransferir = (int) $destino['necesidad'];

                foreach ($origenes as &$origen) {
                    if ($pendienteTransferir <= 0) {
                        break;
                    }

                    if ($origen['sucursal_id'] === $destino['sucursal_id']) {
                        continue;
                    }

                    $cantidad = min($pendienteTransferir, (int) $origen['exceso']);
                    if ($cantidad <= 0) {
                        continue;
                    }

                    $sugerencias[] = [
                        'codigo' => $codigo,
                        'sucursal_origen' => $origen['sucursal_id'],
                        'sucursal_destino' => $destino['sucursal_id'],
                        'cantidad' => $cantidad,
                        'stock_origen' => $origen['stock'],
                        'stock_destino' => $destino['stock'],
                        'venta_origen' => $origen['venta'],
                        'venta_destino' => $destino['venta'],
                        'motivo' => 'Redistribución automática: origen con exceso de stock y destino con necesidad. Origen conserva 5% de ventas y destino busca alcanzar 200% de ventas.',
                        'estado' => 'PENDIENTE',
                    ];

                    $origen['exceso'] -= $cantidad;
                    $pendienteTransferir -= $cantidad;
                    $totalUnidades += $cantidad;
                }
                unset($origen);
            }
        }

        return [
            'sugerencias' => $sugerencias,
            'cantidad_sugerencias' => count($sugerencias),
            'total_unidades' => $totalUnidades,
        ];
    }

    /**
     * @param array<int, array<string, mixed>> $items
     * @param array<int, int> $prioridad
     */
    private function sortByPriority(array &$items, array $prioridad): void
    {
        $posiciones = array_flip($prioridad);

        usort($items, static function (array $a, array $b) use ($posiciones): int {
            $posA = $posiciones[$a['sucursal_id']] ?? PHP_INT_MAX;
            $posB = $posiciones[$b['sucursal_id']] ?? PHP_INT_MAX;

            return $posA <=> $posB;
        });
    }

    /**
     * @return mixed
     */
    private function value($item, string $key)
    {
        if (is_array($item)) {
            return $item[$key] ?? null;
        }

        return $item->{$key} ?? null;
    }
}
