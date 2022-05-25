<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class VerificationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'verification_code' => ['required', 'string']
        ];
    }
}
