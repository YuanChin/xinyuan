<?php

namespace App\Http\Requests\Web;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
            'avatar' => 'mimes:png,jpg,gif,jpeg|dimensions:min_width=208,min_height=208',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'avatar.mimes' =>'頭貼必須是 png, jpg, gif, jpeg 格式的圖片',
            'avatar.dimensions' => '圖片清晰度不夠，寬和高需要 208px 以上',
            'name.unique' => '該名稱已經被使用過了，請重新填寫',
            'name.regex' => '使用者名稱只支持英文、數字、橫槓及下划線',
            'name.between' => '使用者名稱必須介於 3 - 25 個字符之間',
            'name.required' => '使用者名稱不能為空'
        ];
    }
}
