<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTeamRequest extends FormRequest
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
            'file' => ['file', 'image'],
            'proama' => ['required', 'in:0,1'],
            'pro_game' => ['nullable', 'required_if:proama,0', 'exists:games,id',],
            'ama_game' => ['nullable', 'required_if:proama,1', 'exists:games,id',],
            'pro_top' => ['nullable', 'string', 'required_if:proama,0', 'max:50'],
            'ama_top' => ['nullable', 'string', 'required_if:proama,1', 'max:50'],
            'hp' => ['nullable', 'url', 'active_url', 'required_if:proama,0',],
            'email' => ['required', 'email', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'file' => 'チームロゴ',
            'proama' => 'チーム種類',
            'pro_game' => 'ゲームタイトル',
            'pro_top' => '代表名',
            'ama_top' => 'リーダー名',
            'ama_game' => 'ゲームタイトル',
        ];
    }

    public function messages()
    {
        return [
            'proama.required' => 'どちらかを選択してください',

            'pro_game.required_if' => 'ゲームを選択してください',
            'pro_game.exists' => '登録されているゲームから選んでください',

            'ama_game.required_if' => 'ゲームを選択してください',
            'ama_game.exists' => '登録されているゲームから選んでください',

            'pro_top.required_if' => '代表名は必須入力です',
            'ama_top.required_if' => 'リーダー名は必須入力です',

            'hp.required_if' => 'プロチームはHPのURLが必要です',
        ];
    }
}
