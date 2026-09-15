<?php

namespace Tests\Unit\Services;

use App\Services\Redistribucion\RedistribucionPlanner;
use PHPUnit\Framework\TestCase;

class RedistribucionPlannerTest extends TestCase
{
    private RedistribucionPlanner $planner;

    protected function setUp(): void
    {
        parent::setUp();
        $this->planner = new RedistribucionPlanner();
    }

    public function test_calcula_exceso_y_necesidad_con_las_reglas_actuales(): void
    {
        $resultado = $this->planner->plan([
            ['codigo' => 'A1', 'sucursal_id' => 22, 'cant_vta' => 100, 'stock_actual' => 100],
            ['codigo' => 'A1', 'sucursal_id' => 9, 'cant_vta' => 50, 'stock_actual' => 0],
        ]);

        $this->assertSame(1, $resultado['cantidad_sugerencias']);
        $this->assertSame(95, $resultado['total_unidades']);
        $this->assertSame(22, $resultado['sugerencias'][0]['sucursal_origen']);
        $this->assertSame(9, $resultado['sugerencias'][0]['sucursal_destino']);
        $this->assertSame(95, $resultado['sugerencias'][0]['cantidad']);
    }

    public function test_respeta_prioridad_de_origenes_y_agota_exceso_en_orden(): void
    {
        $resultado = $this->planner->plan([
            ['codigo' => 'A1', 'sucursal_id' => 22, 'cant_vta' => 100, 'stock_actual' => 50],
            ['codigo' => 'A1', 'sucursal_id' => 6, 'cant_vta' => 100, 'stock_actual' => 50],
            ['codigo' => 'A1', 'sucursal_id' => 9, 'cant_vta' => 40, 'stock_actual' => 0],
        ]);

        $this->assertSame(2, $resultado['cantidad_sugerencias']);
        $this->assertSame(80, $resultado['total_unidades']);
        $this->assertSame(22, $resultado['sugerencias'][0]['sucursal_origen']);
        $this->assertSame(45, $resultado['sugerencias'][0]['cantidad']);
        $this->assertSame(6, $resultado['sugerencias'][1]['sucursal_origen']);
        $this->assertSame(35, $resultado['sugerencias'][1]['cantidad']);
    }

    public function test_no_genera_sugerencias_para_codigos_bloqueados(): void
    {
        $resultado = $this->planner->plan([
            ['codigo' => 'A1', 'sucursal_id' => 22, 'cant_vta' => 100, 'stock_actual' => 100],
            ['codigo' => 'A1', 'sucursal_id' => 9, 'cant_vta' => 50, 'stock_actual' => 0],
        ], ['A1']);

        $this->assertSame(0, $resultado['cantidad_sugerencias']);
        $this->assertSame(0, $resultado['total_unidades']);
        $this->assertSame([], $resultado['sugerencias']);
    }

    public function test_nunca_transfiere_mas_del_exceso_disponible(): void
    {
        $resultado = $this->planner->plan([
            ['codigo' => 'A1', 'sucursal_id' => 22, 'cant_vta' => 100, 'stock_actual' => 15],
            ['codigo' => 'A1', 'sucursal_id' => 9, 'cant_vta' => 100, 'stock_actual' => 0],
        ]);

        $this->assertSame(10, $resultado['total_unidades']);
        $this->assertSame(10, $resultado['sugerencias'][0]['cantidad']);
    }
}
