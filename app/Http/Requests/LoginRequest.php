<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:App\Models\User,email',
            'password' => [
                'required',
                Password::min(10)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'email.required' => 'É necessário o informe do email do usuário para processar a requisição de login.',
            'email.email' => 'Não é possível processar o login de um usuário com email inválido.',
            'email.exists' => 'Endereço de email não existe em nossa base de dados.',
            'password.required' => 'É necessário o informe da senha do usuário para processar a requisição de login.',
        ];
    }
}
