<?php

namespace App\Http\Requests;

use App\Models\Enums\Profile;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CondutorVisitaRequest extends FormRequest
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
            'condutores' => ['required', 'array'],
            'condutores.*' => ['exists:condutores,id'],
        ];
    }
    public function messages()
    {
        return[
            'condutores.required' => 'Selecione pelo menos um condutor',
            'condutores.*.exists' => 'Selecione um condutor existente',
        ];
    }
}
