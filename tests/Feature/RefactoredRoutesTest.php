<?php

namespace Tests\Feature;

use App\Http\Controllers\Ot\StoreTrazabilidadController;
use App\Http\Controllers\Redistribucion\AnalizarRedistribucionController;
use Tests\TestCase;

class RefactoredRoutesTest extends TestCase
{
    public function test_redistribucion_analizar_usa_el_controlador_refactorizado(): void
    {
        $route = app('router')->getRoutes()->getByName('RedistribucionSugeridas.analizar');

        $this->assertNotNull($route);
        $this->assertStringContainsString(
            AnalizarRedistribucionController::class,
            $route->getActionName()
        );
    }

    public function test_ots_store_usa_el_controlador_refactorizado(): void
    {
        $route = app('router')->getRoutes()->getByName('ots.store');

        $this->assertNotNull($route);
        $this->assertStringContainsString(
            StoreTrazabilidadController::class,
            $route->getActionName()
        );
    }
}
