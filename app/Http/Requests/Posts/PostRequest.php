<?php

namespace App\Http\Requests\Posts;

use App\Http\Requests\Request;

class PostRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'       => 'required|min:3',
                    'body'        => 'required|min:3',
                    'post_category_id' => 'required|numeric',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.min' => '標題至少3個字以上',
            'body.min'  => '文章內容至少3個字以上'
        ];
    }
}
