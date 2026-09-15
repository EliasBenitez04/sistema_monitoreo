<?php

namespace App\Services\Redistribucion;

use App\Models\RedistribucionProcesoDetalle;
use App\Models\RedistribucionSugerida;
use App\Models\StockVentasSucursal;
use Illuminate\Support\Facades\DB;

class RedistribucionAnalyzer
{
    private RedistribucionPlanner $planner;

    public function __construct(RedistribucionPlanner $planner)
    {
        $this->planner = $planner;
    }

    /**
     * @param array<string, mixed> $filters
     * @return array{sin_datos: bool, cantidad_sugerencias: int, total_unidades: int}
     */
    public function analyze(array $filters): array
    {
        return DB::transaction(function () use ($filters): array {
            $datos = $this->queryDatos($filters)->get();

            if ($datos->isEmpty()) {
                return [
                    'sin_datos' => true,
                    'cantidad_sugerencias' => 0,
                    'total_unidades' => 0,
                ];
            }

            RedistribucionSugerida::query()
                ->whereDate('fecha_generacion', now()->toDateString())
                ->where('estado', 'PENDIENTE')
                ->delete();

            $codigosBloqueados = config('redistribucion.bloquear_codigos_activos', false)
                ? $this->blockedCodes()
                : [];

            $plan = $this->planner->plan($datos, $codigosBloqueados, [
                'origenes' => config('redistribucion.origenes', []),
                'destinos' => config('redistribucion.destinos', []),
                'porcentaje_stock_origen' => config('redistribucion.porcentaje_stock_origen', 0.05),
                'multiplicador_stock_destino' => config('redistribucion.multiplicador_stock_destino', 2.00),
            ]);

            if (!empty($plan['sugerencias'])) {
                $fechaGeneracion = now();
                $sugerencias = array_map(static function (array $sugerencia) use ($fechaGeneracion): array {
                    $sugerencia['fecha_generacion'] = $fechaGeneracion;
                    return $sugerencia;
                }, $plan['sugerencias']);

                foreach (array_chunk($sugerencias, (int) config('redistribucion.chunk_insert', 1000)) as $chunk) {
                    RedistribucionSugerida::insert($chunk);
                }
            }

            return [
                'sin_datos' => false,
                'cantidad_sugerencias' => (int) $plan['cantidad_sugerencias'],
                'total_unidades' => (int) $plan['total_unidades'],
            ];
        });
    }

    /**
     * @param array<string, mixed> $filters
     */
    private function queryDatos(array $filters)
    {
        $query = StockVentasSucursal::query()
            ->where('periodo', $filters['periodo']);

        foreach (['grupo_plan', 'linea', 'temporada'] as $campo) {
            $valor = $filters[$campo] ?? null;
            if ($valor !== null && $valor !== '') {
                $query->where($campo, $valor);
            }
        }

        return $query;
    }

    /**
     * @return array<int, string>
     */
    private function blockedCodes(): array
    {
        $activos = RedistribucionProcesoDetalle::query()
            ->whereIn('estado', ['PENDIENTE', 'EN PROCESO'])
            ->pluck('codigo');

        $dias = (int) config('redistribucion.dias_bloqueo_finalizados', 30);

        $finalizados = RedistribucionProcesoDetalle::query()
            ->where('redistribucion_proceso_detalle.estado', 'FINALIZADO')
            ->join(
                'redistribucion_lote',
                'redistribucion_lote.id',
                '=',
                'redistribucion_proceso_detalle.lote_id'
            )
            ->where('redistribucion_lote.fecha_finalizacion', '>=', now()->subDays($dias))
            ->pluck('redistribucion_proceso_detalle.codigo');

        return $activos
            ->merge($finalizados)
            ->filter()
            ->map(static fn ($codigo) => (string) $codigo)
            ->unique()
            ->values()
            ->all();
    }
}
