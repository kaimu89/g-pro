<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Recruit;

class MyTeamRecruitRequest extends FormRequest
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
        $recruit = Recruit::find($this->id);

        if (isset($recruit->staff_id)) {
            return [
                "staff_id" => ['required', 'exists:staff,id',],
                "content" => ['required', 'string'],
                "ab_skill" => ['required', 'string'],
                "wel_skill" => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
            ];
        }

        if (isset($recruit->position_id) && isset($recruit->rank_id) && $recruit->team->proama == '0') {
            return  [
                'position_id' => ["url", 'required', 'exists:positions,id'],
                'rank_id' => ['required', 'exists:ranks,id'],
                'age' => ['required', 'in:0,1,2,3,4',],
                'house' => ['required', 'in:0,1'],
                'description' => ['nullable', 'string'],
            ];
        }

        if (isset($recruit->position_id) && isset($recruit->rank_id) && $recruit->team->proama == 1) {
            return  [
                'position_id' => ['required', 'exists:positions,id'],
                'rank_id' => ['required', 'exists:ranks,id'],
                'description' => ['nullable', 'string'],
            ];
        }
    }

    public function attributes()
    {
        return [
            'position' => 'ポジション',
            'rank' => 'ランク',
            'age' => '年齢',
            'house' => 'ゲーミングハウス',
            'staff' => 'スタッフ',
            'content' => '仕事内容',
            'ab_skill' => '必須スキル',
            'wel_skill' => '歓迎スキル',
            'description' => '募集文',
        ];
    }

    public function messages()
    {
        return [
            'position.exists' => '登録されているポジションから選んでください',
            'rank.exists' => '登録されているランクから選んでください',
            'staff.exists' => '登録されているスタッフから選んでください',
        ];
    }
}
