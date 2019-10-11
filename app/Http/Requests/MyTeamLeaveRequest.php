<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyTeamLeaveRequest extends FormRequest
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

                    $user = User::find($value);

                    if (!isset($user->team_id)) {
                        return $fail('チームメンバーから選んでください');
                    }

                    if ($user->team_id != Auth::user()->team_id) {
                        return $fail('チームメンバーから選んでください');
                    }
                }
            ]
        ];
    }
}
