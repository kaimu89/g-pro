<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ValidationErrorResponseCustomizer;

class AddPlayerRequest extends FormRequest
{
    // use ValidationErrorResponseCustomizer;
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
        //OK
        return [
            'ign' => ['required', 'string', 'max:50'],
            'proama' => ['required', 'in:0,1'],
            'game' => ['not_in:0'],
            'position' => ['not_in:0'],
            'rank' => ['not_in:0'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'ign' => 'IGN',
            'description' => '紹介文',
        ];
    }

    public function messages()
    {
        return [
            'proama.required' => 'どちらかを選択して下さい。'
        ];
    }
}
