<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:5', 'max:30', 'unique:users'],
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|min:8|max:255'
        ]);

        //$validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        $user->store()->create([
            'user_id' => $user->id,
            'name' => $user->name . ' Store',
        ]);

        return redirect('/login')->with('success','Registrasi berhasil, Silahkan Login :D');
    }
}
