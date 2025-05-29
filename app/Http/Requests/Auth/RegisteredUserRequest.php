<?php

namespace App\Http\Requests\Auth;

use App\Models\Enums\Profile;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisteredUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.unique' => 'Já possui cadastro!',
            'password.required' => 'O campo senha é obrigatório',
            'password.confirmed' => 'As senhas não conferem',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres',
            'password_confirmation.required' => 'O campo confirmar senha é obrigatório',
            'password_confirmation.min' => 'A confirmação de senha deve ter pelo menos 8 caracteres',
        ];
    }
}
