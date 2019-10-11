<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyTeamChildLeaderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            "leader" => ["required", 'exists:users,id']
        ];
    }

    public function attributes()
    {
        return [];
    }

    public function messages()
    {
        return [
            'leader.required' => 'メンバーをいずれか選択して下さい',
            'leader.exists' => '登録されているユーザーから選んで下さい',
        ];
    }
}
