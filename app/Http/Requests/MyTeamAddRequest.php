<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyTeamAddRequest extends FormRequest
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
            "add_member" => [
                'required',
                'exists:users,user_name',
                function ($attribute, $value, $fail) {
                    $member = User::where('user_name', $value)->first();

                    if (isset($member->team_id) && $member->team_id == Auth::user()->team_id) {
                        return $fail('既にチームに所属しています。');
                    }

                    if (isset($member->team_id) && $member->team_id != Auth::user()->team_id) {
                        return $fail('既に他のチームに所属しています。');
                    }
                    if (isset($member->child_id) && $member->child->team->id != Auth::user()->team_id) {
                        return $fail("既に他のチームの部門に所属しています。");
                    }
                }
            ],
        ];
    }

    public function messages()
    {
        return [
            'add_member.required' => 'ユーザー名を入力して下さい',
            'add_member.exists' => 'そのユーザー名は登録されてません'
        ];
    }
}
