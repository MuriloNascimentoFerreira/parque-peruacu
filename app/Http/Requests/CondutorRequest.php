<?php

namespace App\Http\Requests;

use App\Models\Enums\Profile;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CondutorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->profile === Profile::USER_ADMINISTRADOR){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        /* Criar regras com base no atributos do condutor acima */
        return [
            'nome' => ['required','max:255','string'],
            'apelido' => 'max:255',
            'email' => ['required','email'],
            'linguasEstrangeiras' => ['required','string'],
            'escolaridade' => ['required'],
            'instagram' => ['nullable','string','max:255'],
            'facebook' => ['nullable','string','max:255'],
            'informacoes' => ['nullable','string','max:255'],
            'cep' => ['required','max:255','string'],
            'cidade' => ['required','max:255','string'],
            'uf' => ['required','max:2','string'],
            'pais' => ['required','max:255','string'],
            'descricao' => ['max:255'],
            'numero' => ['required','max:15', 'string'],
        ];
    }
    public function messages()
    {
        return[
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'nome.string' => 'O nome deve ser uma string.',

            'apelido.max' => 'O apelido não pode ter mais de 255 caracteres.',

            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser um endereço válido.',

            'localidade.required' => 'A localidade é obrigatória.',
            'localidade.max' => 'A localidade não pode ter mais de 255 caracteres.',
            'localidade.string' => 'A localidade deve ser uma string.',

            'linguasEstrangeiras.required' => 'As linguas estrangeiras são obrigatórias.',
            'linguasEstrangeiras.string' => 'As linguas estrangeiras devem ser uma string.',

            'escolaridade.required' => 'A escolaridade é obrigatória.',

            'instagram.max' => 'O instagram não pode ter mais de 255 caracteres.',
            'facebook.max' => 'O facebook não pode ter mais de 255 caracteres.',
            'informacoes.max' => 'As informações não podem ter mais de 255 caracteres.',

            'cep.required' => 'O CEP é obrigatório',
            'cep.max' => 'O CEP não pode ter mais de 255 caracteres',
            'cep.string' => 'O CEP deve ser uma string',
            'cidade.required' => 'A Cidade é obrigatória',
            'cidade.max' => 'A Cidade não pode ter mais de 255 caracteres',
            'cidade.string' => 'A Cidade deve ser uma string',
            'uf.required' => 'O UF é obrigatório',
            'uf.max' => 'O UF não pode ter mais de 255 caracteres',
            'uf.string' => 'O UF deve ser uma string',
            'pais.required' => 'O Pais é obrigatório',
            'pais.max' => 'O Pais não pode ter mais de 255 caracteres',
            'pais.string' => 'O Pais deve ser uma string',

            'descricao.max' => 'A descrição não pode ter mais de 255 caracteres',
            'numero.required' => 'O número é obrigatório',
            'numero.max' => 'O número não pode ter mais de 15 caracteres',
        ];
    }
}
