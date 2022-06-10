<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterStoreRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(RegisterStoreRequest $request)
    {
        User::create($request->all())->assignRole('Collaborator');

        return response()->json(['success' => true], 200);
    }
}
