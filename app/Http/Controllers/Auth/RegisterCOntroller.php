<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterCOntroller extends Controller
{

    public function create()  {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)  {
        $creds=$request->validate([
            'name'=>'required|unique:users',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',

        ]);

        $user=User::create($creds);

        Auth::login($user);

        return redirect()->route('home');
    }
}
