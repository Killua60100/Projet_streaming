<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function store(Request $request)
    {
       try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/welcome')->with('success', 'Utilisateur créé');

    } catch (QueryException $e) {
        return back()->with('error', 'Erreur : impossible de créer l’utilisateur.');
    }
    }
        public function compte()
    {
        $user = Auth::user();
        
        return view('compte', compact('user'));
    }
    
}


