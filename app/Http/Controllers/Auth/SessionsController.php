<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Вкажіть email',
            'email.email' => 'Email має некоректний формат',
            'password.required' => 'Вкажіть пароль',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Невірний email або пароль',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('notes.index'))->with('success', 'Ви увійшли до системи');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Ви вийшли з системи');
    }
}
