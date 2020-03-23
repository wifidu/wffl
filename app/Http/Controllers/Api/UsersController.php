<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest as ApiUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function store(ApiUserRequest $request)
    {
        $verifyData = \Cache::get($request->verification_key);

        if (! $verifyData) {
            abort(403, '验证码已经失效');
        }

        if (! hash_equals($verifyData['code'], $request->verification_code)) {
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $verifyData['phone'],
            'password' => $request->password,
        ]);

        \Cache::forget($request->verification_key);

        return new UserResource($user);
    }
}
