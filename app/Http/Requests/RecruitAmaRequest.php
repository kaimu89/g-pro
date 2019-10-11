<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitAmaRequest extends FormRequest
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
            'position' => ['required', 'exists:positions,id',],
            'rank' => ['required', 'exists:ranks,id',],
            'description' => ['nullable', 'string'],
        ];
    }
    public function attributes()
    {
        return [
            'position' => 'ポジション',
            'rank' => 'ランク',
            'description' => '募集文',
        ];
    }

    public function messages()
    {
        return [
            'position.exists' => '登録されているポジションから選んでください',
            'rank.exists' => '登録されているランクから選んでください',
        ];
    }
}
