<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
//        User::query()->create([
//            'name'=>'Admin',
//            'email'=>'admin@gmail.com',
//            'password'=>'123',
//        ]);
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
           'email'=>['required','email'],
            'password'=>['required'],
        ]);

        if (Auth::attempt($validated)) {
            if(Auth::user()->is_admin) {
                return redirect()->route('admin.main.index');
            } else {
                return redirect()->route('home');
            }

        }

        return redirect()->back()->with('error','Incorrect email/password');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Регенерировать CSRF-токен

        return redirect()->route('login')->with('success','Unlogged successfully'); // Перенаправление на главную страницу
    }


}
