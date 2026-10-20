<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'name.required' => 'Вкажіть ім\'я',
            'email.required' => 'Вкажіть email',
            'email.email' => 'Email має некоректний формат',
            'email.unique' => 'Користувач з таким email вже існує',
            'password.required' => 'Вкажіть пароль',
            'password.confirmed' => 'Паролі не збігаються',
            'password.min' => 'Пароль має містити щонайменше :min символів',
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('notes.index')->with('success', 'Реєстрація успішна');
    }
}
