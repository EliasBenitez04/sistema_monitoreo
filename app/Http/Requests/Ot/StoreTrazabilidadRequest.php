<?php

namespace App\Http\Requests\Ot;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrazabilidadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_ot' => ['required', 'integer', 'exists:ot,id_ot'],
            'proceso' => ['nullable', 'array'],
            'proceso.*' => ['nullable', 'string', 'max:255'],
            'resultado' => ['nullable', 'array'],
            'resultado.*' => ['nullable', 'string', 'max:2000'],
            'fecha_proceso' => ['nullable', 'array'],
            'fecha_proceso.*' => ['nullable', 'date'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            $procesos = (array) $this->input('proceso', []);
            $fechas = (array) $this->input('fecha_proceso', []);

            foreach ($procesos as $key => $proceso) {
                if (trim((string) $proceso) === '') {
                    continue;
                }

                if (empty($fechas[$key])) {
                    $validator->errors()->add(
                        'fecha_proceso.' . $key,
                        'La fecha del proceso es obligatoria cuando se informa un proceso.'
                    );
                }
            }
        });
    }
}
