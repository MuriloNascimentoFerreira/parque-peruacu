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
        return [
            'nome' => ['required','max:255','string'],
            'lotacao' => ['required', 'integer', 'max:255'],
            'duracao' => ['required','integer'],
            'distancia' => ['required','numeric']
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
            'nome.required' => 'O nome do roteiro deve ser preenchido',
            'nome.max' => 'O nome do roteiro deve ter no máximo 255 caracteres',
            'lotacao.required' => 'A lotação deve ser preenchida',
            'lotacao.integer' => 'Somente números inteiros',
            'lotacao.max' => 'Número máximo de 255',
            'duracao.required' => 'A duração deve ser preenchida',
            'duracao.integer' => 'Somente números inteiros',
            'distancia.required' => 'A distância deve ser preenchida',
            'distancia.numeric' => 'A distância deve ser um número decimal'
        ];
    }
}
