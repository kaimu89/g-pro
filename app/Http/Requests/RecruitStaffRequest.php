<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitStaffRequest extends FormRequest
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

        $request =  [
            'staff' => ['required', 'exists:staff,id',],
            'content' => ['required', 'string', 'max:255'],
            'ab_skill' => ['required', 'string', 'max:255'],
            'wel_skill' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];

        if (auth()->user()->team->proama == '0') {
            $request += array('game' => ['required', 'exists:games,id',]);
        }

        return $request;
    }

    public function attributes()
    {
        return [
            'game' => 'ゲームタイトル',
            'staff' => 'スタッフ',
            'content' => '仕事内容',
            'ab_skill' => '必須スキル',
            'wel_skill' => '歓迎スキル',
            'description' => '紹介文',
        ];
    }

    public function messages()
    {
        return [
            'game.exists' => '登録されているゲームから選んでください',
            'staff.exists' => '登録されているスタッフから選んでください',
        ];
    }
}
