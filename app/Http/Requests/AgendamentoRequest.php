<?php

namespace App\Http\Requests;

use App\Models\Enums\Profile;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AgendamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->profile === Profile::USER_ADMINISTRADOR || $this->user()->profile === Profile::USER_VISITANTE){
            return true;
        }
        return false;
    }

    public function prepareForValidation()
    {
        if(isset($this->data)){
            $this->merge([
                'data' => Carbon::createFromFormat('d/m/Y', $this->data)->format('Y-m-d')
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'nomeResponsavel' => ['required','max:255','string'],
            'email' => ['required','email'],
            'motivo' => ['required','max:255','string'],
            'cep' => ['required','max:255','string'],
            'cidade' => ['required','max:255','string'],
            'uf' => ['required','max:2','string'],
            'pais' => ['required','max:255','string'],
            'descricao' => ['max:255'],
            'numero' => ['required','max:15', 'string'],
            'visita' => ['nullable']
        ];
    }
    public function messages()
    {
        return[
            'nomeResponsavel.required' => 'O nome do responsável é obrigatório',
            'nomeResponsavel.max' => 'O nome do responsável não pode ter mais de 255 caracteres',
            'nomeResponsavel.string' => 'O nome do responsável deve ser uma string',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser um endereço válido',
            'motivo.required' => 'O motivo é obrigatório',
            'motivo.max' => 'O motivo não pode ter mais de 255 caracteres',
            'motivo.string' => 'O motivo deve ser uma string',
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
            'numero.string' => 'O número deve ser uma string',
        ];
    }
}
