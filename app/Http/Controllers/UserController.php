<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(UserLoginRequest $request) {
        $phone = $request->input('phone');
        $password = $request->input('password');

        $user = User::where('phone', $phone)->first();
        if($user) {
           $checkedPassword = Hash::check($password, $user->password);
           if($checkedPassword) {
               Auth::login($user);
               return redirect()->route('admin-home')->with('success', 'Welcome Back Sir!');
           }else{
               return redirect()->back()->with('error', 'Incorrect password!');
           }
        }else {
            return redirect()->back()->with('error', 'Incorrect Phone number!');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('user-login');
    }
}
