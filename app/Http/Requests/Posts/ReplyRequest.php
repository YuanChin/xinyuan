<?php

namespace App\Http\Requests\Posts;

use App\Http\Requests\Request;

class ReplyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'content' => ['required', 'min:2']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'content.required' => '內容不能為空',
            'content.min' => '內容至少要兩個字以上',
        ];
    }
}
