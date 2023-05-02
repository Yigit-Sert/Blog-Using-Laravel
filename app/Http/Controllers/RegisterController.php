<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255|min:7'  //   Another way to do it:   'password' => ['required', 'max:255', 'min:7']
        ]);

        User::create($attributes);

        return redirect('/');
    }
}
