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

    public function prepareForValidation()
    {

    }

    protected $fillable = [
        'nome',
        'apelido',
        'email',
        'localidade',
        'linguasEstrangeiras',
        'escolaridade',
        'instagram',
        'facebook',
        'informacoes',
    ];

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
            'apelido' => ['required','max:255','string'],
            'email' => ['required','email'],
            'localidade' => ['required','max:255','string'],
            'linguasEstrangeiras' => ['required','string'],
            'escolaridade' => ['required'],
            'instagram' => ['nullable','string','max:255'],
            'facebook' => ['nullable','string','max:255'],
            'informacoes' => ['nullable','string','max:255'],
        ];
    }
    public function messages()
    {
        return[
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'nome.string' => 'O nome deve ser uma string.',

            'apelido.required' => 'O apelido é obrigatório.',
            'apelido.max' => 'O apelido não pode ter mais de 255 caracteres.',
            'apelido.string' => 'O apelido deve ser uma string.',

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
        ];
    }
}
