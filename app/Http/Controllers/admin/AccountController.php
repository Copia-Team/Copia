<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function admin(){

        $user = Auth::user();
        $admins = User::where('role', 'admin');
        $page = request('page', 1);

        if(request('search')){
            $admins->where('username', 'ilike', '%' .request('search'). '%')
                    ->orWhere('name', 'ilike', '%' .request('search'). '%')
                    ->orWhere('email', 'ilike', '%' .request('search'). '%');
        }

        $admins->orderBy('created_at', 'asc');

        $admins = $admins->paginate(5, ['*'], 'page', $page);

        return view('admin.account.admin',[
            'user' => $user,
            'admins' => $admins
        ]);
    }

    public function addAdmin(){
        return view('admin.account.admin.add');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:5', 'max:30', 'unique:users'],
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|min:8|max:255',
            'role' => 'max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_telp' => 'max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
        } else {
            $imagePath = null;
        }

        $request['password'] = Hash::make($request['password']);

        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request['password'],
            'role' => 'admin',
            'image' => $imagePath,
            'no_telp' => $request->input('no_telp'),
        ]);

        return redirect()->route('admin.account');
    }

    public function petani(){

        $petanis = User::where('role', 'petani');
        $page = request('page', 1);

        if(request('search')){
            $petanis->where('username', 'ilike', '%' .request('search'). '%')
                    ->orWhere('name', 'ilike', '%' .request('search'). '%')
                    ->orWhere('email', 'ilike', '%' .request('search'). '%');
        }

        $petanis->orderBy('created_at', 'asc');
        $petanis = $petanis->paginate(5, ['*'], 'page', $page);

        return view('admin.account.petani',[
            'petanis'=> $petanis
        ]);
    }

    public function delete($id) {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('petani.account')->with('failed', 'Failed to delete the account.');
        }

        $role = $user->role;

        $user->delete();

        if ($role === 'admin') {
            return redirect()->route('admin.account')->with('success', 'Account successfully deleted.');
        } elseif ($role === 'petani') {
            return redirect()->route('petani.account')->with('success', 'Account successfully deleted.');
        } else {
            return redirect()->route('petani.route')->with('success', 'Account successfully deleted.');
        }
    }

}
