<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyTeamChildLeaveRequest extends FormRequest
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
            "leave" => [
                "exists:users,id",
                function ($attribute, $value, $fail) {

                    $childs = Auth::user()->team->childs->pluck('id')->toArray();

                    $user = User::find($value);

                    if (!isset($user->child_id)) {
                        return $fail('チームメンバーから選んでください');
                    }

                    if (!in_array($user->child_id, $childs)) {
                        return $fail('チームメンバーから選んでください');
                    }
                }
            ]
        ];
    }
}
