<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(RegisterRequest $request) 
    {

        return User::upsertInstance($request);
    }

    public function login(LoginRequest $request) 
    {
        return User::login($request);
    }

    public function logout() 
    {
        return Auth::user()->logout();
    }

    public function delete() 
    {
        return Auth::user()->deleteInstance();
    }
}
