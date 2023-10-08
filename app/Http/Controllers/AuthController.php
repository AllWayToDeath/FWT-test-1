<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(Request $request): View|RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        if (!Auth::attempt($credentials)) {
            return view('auth.login', ['messages' => ['Неверные почта или пароль']]);
        }

        $request->session()->regenerate();

        return Redirect::route('tasks.list');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordAgain = $request->input('password_again');

        $messages = [];

        $iEmailAlreadyExists = User::query()
            ->where('email', $email)
            ->exists();

        if ($password !== $passwordAgain) {
            $messages[] = 'Пароли не совпадают';
        }
        if ($iEmailAlreadyExists) {
            $messages[] = 'Почта уже используется';
        }

        if (count($messages) > 0) {
            return view('auth.login', ['messages' => $messages]);
        }


        $encryptedPassword = Hash::make($password);

        $user = User::query()
            ->create([
                'name' => $name,
                'email' => $email,
                'password' => $encryptedPassword,
            ]);

        if (auth()->user()) {
            auth()->logout();
        }

        Auth::login($user);

        return Redirect::route('tasks.list');
    }
}
