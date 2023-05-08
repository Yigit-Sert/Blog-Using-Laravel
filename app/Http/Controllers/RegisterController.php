<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([   //  if the validation fails, no more code is read below it
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
//  Another usage of line above -> 'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:7'  //   Another way to do it:   'password' => ['required', 'max:255', 'min:7']
        ]);

        $user = User::create($attributes);

        // log the user in
        auth()->login($user);

        return redirect('/')->with('success', 'Account has been created!');
    }
}
