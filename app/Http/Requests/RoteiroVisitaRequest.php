<?php

namespace App\Http\Requests;

use App\Models\Enums\Profile;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RoteiroVisitaRequest extends FormRequest
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
            'roteiros' => ['required', 'array'],
            'roteiros.*' => ['exists:roteiros,id'],
        ];
    }
    public function messages()
    {
        return[
            'roteiros.required' => 'Selecione pelo menos um roteiro',
            'roteiros.*.exists' => 'Selecione um roteiro existente',
        ];
    }
}
