<?php

namespace App\Http\Requests;

use App\Models\Enums\Periodo;
use App\Models\Enums\Profile;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class VisitaRequest extends FormRequest
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
            'data' => ['required', 'date','date_format:Y-m-d'],
            'periodo' => ['required'],
            'quantidadePessoas' => ['required','integer'],
            'quantidadePessoasEfetivo' => ['required','integer'],
        ];
    }
    public function messages()
    {
        return[
            'data.required' => 'A data é obrigatória',
            'data.date' => 'A data deve ser uma data válida',
            'data.date_format' => 'A data deve estar no formato dd/mm/aaaa',
            'periodo.required' => 'O período é obrigatório',
            'quantidadePessoas.required' => 'A quantidade de pessoas é obrigatória',
            'quantidadePessoasEfetivo.required' => 'A quantidade de pessoas efetivas é obrigatória',
            'quantidadePessoas.integer' => 'A quantidade de pessoas deve ser um número inteiro',
            'quantidadePessoasEfetivo.integer' => 'A quantidade de pessoas efetivas deve ser um número inteiro',
        ];
    }
}
