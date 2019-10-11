<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileEditRequest extends FormRequest
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

        //no regexと誕生日　誕生日はjsがまだのためその後に行う。
        return [
            'first_name' => ['nullable', 'string', 'max:25',],
            'last_name' => ['nullable', 'string', 'max:25',],
            //更新する際に自身の名前を除くことが出来る
            'user_name' => ['required', 'string', 'max:50', Rule::unique('users')->ignore(auth()->user()->id)],
            'gender' => ['nullable', 'in:0,1',],
            //更新する際に自身の名前を除くことが出来る
            'twitter' => ['nullable', 'regex:/\w{4,14}/', Rule::unique('users')->ignore(auth()->user()->id)],
            'birthday' => ['nullable', 'date'],
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => '姓',
            'last_name' => '名',
            'user_name' => 'ユーザー名',
            'gender' => '性別',
            'twitter' => 'twitter',
            'date' => '誕生日',
        ];
    }

    public function messages()
    {
        return [
            'twitter.regex' => 'twitterは4文字以上14文字以内です',
            'birthday.date' => '正しい誕生日を指定して下さい',
        ];
    }
}
