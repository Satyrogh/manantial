<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimularFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'tasa' => 'required|max:4',
            'cuotas' => 'required|max:2',
            'montoMin' => 'required|max:7',
            'montoMax' => 'required|max:7',
            'notario' => 'required|max:7'
        ];
    }
}
