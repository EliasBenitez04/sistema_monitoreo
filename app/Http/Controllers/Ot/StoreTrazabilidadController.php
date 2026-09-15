<?php

namespace App\Http\Controllers\Ot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ot\StoreTrazabilidadRequest;
use App\Services\Ot\OtTrazabilidadService;
use Illuminate\Support\Facades\Log;
use Throwable;

class StoreTrazabilidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ot create');
    }

    public function __invoke(
        StoreTrazabilidadRequest $request,
        OtTrazabilidadService $service
    ) {
        try {
            $service->create(
                (int) $request->input('id_ot'),
                (array) $request->input('proceso', []),
                (array) $request->input('resultado', []),
                (array) $request->input('fecha_proceso', [])
            );

            alert()->success('Éxito', 'Trazabilidad registrada correctamente.');

            return redirect()->route('ots.index');
        } catch (Throwable $e) {
            Log::error('Error al registrar trazabilidad de OT', [
                'ot_id' => $request->input('id_ot'),
                'error' => $e->getMessage(),
                'exception' => get_class($e),
            ]);

            alert()->error('Error', 'No se pudo registrar la trazabilidad. Revise los registros del sistema.');

            return redirect()->back()->withInput();
        }
    }
}
