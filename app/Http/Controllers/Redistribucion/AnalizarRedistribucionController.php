<?php

namespace App\Http\Controllers\Redistribucion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Redistribucion\AnalizarRedistribucionRequest;
use App\Services\Redistribucion\RedistribucionAnalyzer;
use Illuminate\Support\Facades\Log;
use Throwable;

class AnalizarRedistribucionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:redistribucionsugerencia create');
    }

    public function __invoke(
        AnalizarRedistribucionRequest $request,
        RedistribucionAnalyzer $analyzer
    ) {
        try {
            $resultado = $analyzer->analyze($request->validated());

            if ($resultado['sin_datos']) {
                return redirect()
                    ->route('RedistribucionSugeridas.index')
                    ->with('warning', 'No se encontraron datos para analizar.');
            }

            if ($resultado['cantidad_sugerencias'] === 0) {
                return redirect()
                    ->route('RedistribucionSugeridas.index')
                    ->with('warning', 'El análisis terminó, pero no se encontraron redistribuciones necesarias.');
            }

            return redirect()
                ->route('RedistribucionSugeridas.index')
                ->with(
                    'success',
                    'Análisis realizado correctamente. Se generaron '
                    . $resultado['cantidad_sugerencias']
                    . ' sugerencias con '
                    . $resultado['total_unidades']
                    . ' unidades de stock para redistribuir.'
                );
        } catch (Throwable $e) {
            Log::error('Error al analizar redistribución sugerida', [
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return redirect()
                ->route('RedistribucionSugeridas.index')
                ->with('error', 'Ocurrió un error al realizar el análisis. Revise los registros del sistema.');
        }
    }
}
