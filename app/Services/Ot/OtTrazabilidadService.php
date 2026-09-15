<?php

namespace App\Services\Ot;

use App\Models\Ot;
use Illuminate\Support\Facades\DB;

class OtTrazabilidadService
{
    /**
     * @param array<int|string, mixed> $procesos
     * @param array<int|string, mixed> $resultados
     * @param array<int|string, mixed> $fechas
     */
    public function create(
        int $otId,
        array $procesos,
        array $resultados = [],
        array $fechas = []
    ): Ot {
        return DB::transaction(function () use ($otId, $procesos, $resultados, $fechas): Ot {
            $ot = Ot::findOrFail($otId);

            foreach ($procesos as $key => $proceso) {
                $proceso = trim((string) $proceso);
                if ($proceso === '') {
                    continue;
                }

                $ot->trazabilidades()->create([
                    'id_ot' => $ot->id_ot,
                    'proceso' => $proceso,
                    'resultado' => $resultados[$key] ?? null,
                    'fecha_proceso' => $fechas[$key] ?? null,
                ]);
            }

            return $ot;
        });
    }
}
