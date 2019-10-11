<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MyPlayerEditRequest extends FormRequest
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
            'ign' => ['required', 'string', 'max:255'],
            'proama' => ['required', 'in:0,1'],
            'game_id' => ['required', 'integer'],
            'position_id' => ['required', 'integer'],
            'rank_id' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            "ign" => "IGN",
            "proama" => "志望チーム",
            "game_id" => "ゲームタイトル",
            "position_id" => "ポジション",
            "rank_id" => "ランク",
            "description" => "紹介文"
        ];
    }
}
