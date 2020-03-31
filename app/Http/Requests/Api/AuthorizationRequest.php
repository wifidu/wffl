<?php

/*
 * @author weifan
 * Tuesday 31st of March 2020 08:23:49 AM
 */

namespace App\Http\Requests\Api;

class AuthorizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|alpha_dash|min:6',
        ];
    }
}
