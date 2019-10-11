<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class MyTeamEditRequest extends FormRequest
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
        $data = [
            'name' => ['required', 'string', 'max:50', 'unique:children,name', Rule::unique('teams')->ignore(auth()->user()->team->id)],
            // 'pro_game' => ['nullable', 'exists:games,id'],
            // 'ama_game' => ['filled', 'exists:games,id'],
            'email' => ['required', "email", 'max:255',],
            'hp' => ['nullable', 'url', 'active_url',],
            'top' => ['required', 'string', 'max:50',],
            'description' => ['nullable', 'string',],
        ];

        if (Auth::user()->team->proama == 0) {
            $data += array('pro_game' => ['nullable', 'exists:games,id']);
        } elseif (Auth::user()->team->proama == 1) {
            $data += array('ama_game' => ['filled', 'exists:games,id',]);
        }

        return $data;
    }

    public function attributes()
    {
        return [
            'name' => 'チーム名',
            'pro_game' => 'ゲームタイトル',
            'ama_game' => 'ゲームタイトル',
            'mail' => '連絡先',
            'hp' => 'HP',
            'top' => '代表名',
        ];
    }

    public function messages()
    {
        return [
            'pro_game.exsits' => '登録されているゲームから選んでください',
            'ama_game.exsits' => '登録されているゲームから選んでください',
        ];
    }
}
