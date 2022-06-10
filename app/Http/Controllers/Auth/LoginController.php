<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if(!auth()->attempt($request->only('email','password'))):
            throw new AuthenticationException();
        endif;
    }
}
