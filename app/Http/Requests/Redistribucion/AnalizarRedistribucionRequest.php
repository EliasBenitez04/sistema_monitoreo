<?php

namespace App\Http\Requests\Redistribucion;

use Illuminate\Foundation\Http\FormRequest;

class AnalizarRedistribucionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'periodo' => ['required'],
            'grupo_plan' => ['nullable'],
            'linea' => ['nullable'],
            'temporada' => ['nullable'],
        ];
    }
}
