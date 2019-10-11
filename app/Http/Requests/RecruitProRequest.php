<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitProRequest extends FormRequest
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
            'game' => ['required', 'exists:games,id',],
            'position' => ['required', 'exists:positions,id',],
            'rank' => ['required', 'exists:ranks,id',],
            'age' => ['required', 'integer'],
            'house' => ['required', 'in:0,1'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'game' => 'ゲームタイトル',
            'position' => 'ポジション',
            'rank' => 'ランク',
            'age' => '年齢',
            'house' => 'ゲーミングハウス',
            'description' => '紹介文',
        ];
    }

    public function messages()
    {
        return [
            'game.exists' => '登録されているゲームから選んでください',
            'position.exists' => '登録されているポジションから選んでください',
            'rank.exists' => '登録されているランクから選んでください',
            'house.required' => 'どちらかを選択してください',
        ];
    }
}
