<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'street' => 'required|max:255',
            'number' => 'required|max:10',
            'city' => 'required|max:255',
            'zip_code' => 'required|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'street.required' => 'O campo rua é obrigatório.',
            'street.max' => 'O campo rua não pode ter mais de :max caracteres.',

            'number.required' => 'O campo número é obrigatório.',
            'number.max' => 'O campo número não pode ter mais de :max caracteres.',

            'city.required' => 'O campo cidade é obrigatório.',
            'city.max' => 'O campo cidade não pode ter mais de :max caracteres.',
            
            'zip_code.required' => 'O campo CEP é obrigatório.',
            'zip_code.max' => 'O campo CEP não pode ter mais de :max caracteres.',
        ];
    }
}
