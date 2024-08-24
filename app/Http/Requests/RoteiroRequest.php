<?php

namespace App\Http\Requests;

use App\Models\Enums\Profile;
use Illuminate\Foundation\Http\FormRequest;

class RoteiroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->hasRole(Profile::USER_ADMINISTRADOR)){

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
        return [
            'nome' => ['required','max:255','string'],
            'lotacao' => ['required', 'integer', 'max:255'],
            'duracao' => 'integer',
            'distancia' => 'numeric'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'lotacao' => (int)$this->lotacao,
            'duracao' => 60 * (int)$this->horas + (int)$this->minutos,
            'distancia' => (float) str_replace(',', '.', $this->distancia)
        ]);

        $this->offsetUnset('minutos');
        $this->offsetUnset('horas');
    }

    public function messages()
    {
        return[
            'lotacao.integer' => 'Somente números inteiros',
            'lotacao.max' => 'Número máximo de 255',
            'distancia.numeric' => 'A distância deve ser um número decimal'
        ];
    }
}
