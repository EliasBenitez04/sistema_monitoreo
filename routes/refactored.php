<?php

use App\Http\Controllers\Ot\StoreTrazabilidadController;
use App\Http\Controllers\Redistribucion\AnalizarRedistribucionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas migradas desde controladores legacy
|--------------------------------------------------------------------------
| Este archivo se carga DESPUÉS de routes/web.php. Al registrar la misma
| combinación método + URI + nombre, Laravel utiliza estas acciones como la
| implementación vigente mientras el resto del módulo continúa en legacy.
*/

Route::post(
    '/RedistribucionSugeridas/analizar',
    AnalizarRedistribucionController::class
)->name('RedistribucionSugeridas.analizar');

Route::post(
    '/ots',
    StoreTrazabilidadController::class
)->name('ots.store');
