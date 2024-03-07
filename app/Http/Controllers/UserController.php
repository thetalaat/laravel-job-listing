<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create() {
        return view('users.register');
    }

    public function store() {
        $formFields = request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        if(request()->hasFile('logo')) {
            $formFields['logo'] = request()->file('logo')->store('logos', 'public');
        }

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
        
        // Create user
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    public function logout() {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('message', 'User logged out');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate() {
        $formFields = request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            request()->session()->regenerate();

            return redirect('/')->with('message', 'User logged in');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
