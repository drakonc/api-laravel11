<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'age' => 'required|integer|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre no debe tener más de 100 caracteres',
            'age.required' => 'La edad es requerida',
            'age.min' => 'La edad debe ser mayor a 3 años',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'age' => 'edad',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Error de Validacion',
                'data' => $validator->errors()
            ]
        ));
    }
}
