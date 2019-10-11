<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "name" => ["required", "max:50", "string"],
            "email" => ["email", "max:255"],
            // "category" => ["not_in:0"],
            "title" => ["required", "string", "max:255"],
            "body" => ["required", "string"],
        ];
    }

    public function attributes()
    {
        return [
            "name" => "名前",
            "email" => "連絡先",
            "title" => "お問い合わせ名",
            "body" => "お問い合わせ内容",
        ];
    }

    public function messages()
    {
        return [];
    }
}
