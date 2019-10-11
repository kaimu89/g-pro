<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProRequest extends FormRequest
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

        //ok
        return [
            'name' => ['required', 'string', 'max:50', 'unique:teams,name', 'unique:children,name'],
            'game' => ['required', 'exists:games,id',],
            'top' => ['required', 'string', 'max:50',],
            'email' => ['required', 'email', 'max:50',],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'チーム名',
            'game' => 'ゲームタイトル',
            'top' => '代表名',
            'email' => '連絡先',
            'description' => '紹介文',
        ];
    }

    public function messages()
    {
        return [
            'game.exsits' => '登録されているゲームから選んでください',
        ];
    }
}
