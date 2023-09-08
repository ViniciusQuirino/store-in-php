<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['uuid'],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'age' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $minAge = 18;
                    $age = (int) $value;
                    if ($age < $minAge) {
                        $fail("A $attribute deve ser maior ou igual a $minAge anos.");
                    }
                },
            ],
            'cpf' => ['required'],
            'type' => 'required|string|in:CLIENTE,VENDEDOR',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email deve ser um endereço válido',
            'cpf.required' => 'CPF é obrigatório',
            'password.required' => 'Senha é obrigatório',
            'password.regex' => 'Senha deve conter 8 caracteres, 1 letra maiúscula e 1 letra minuscula no mínimo.',
            'age.required' => 'Idade é obrigatório.',
            'age.numeric' => 'Obrigatório que idade seja um numero e maior ou igual que 18.',
            'type.required' => 'Tipo de conta é obrigatório.',
            'type.in' => "Escolha o tipo da conta."
        ];
    }
}
