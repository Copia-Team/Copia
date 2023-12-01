<?php

namespace App\Http\Controllers\petani;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();

        return view('petani.profil',[
            'user'=>$user
        ]);
    }

    public function edit(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|max:255|unique:users,email,'.$user->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_telp' => 'max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->update(['image' => $imagePath]);
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'no_telp' => $request->input('no_telp'),
        ]);

        return redirect()->route('petani.profile');
    }

    public function changePassword(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8',
            'konfirmasi_password' => 'required|same:password_baru',
        ]);

        if (!Hash::check($request->input('password_lama'), $user->password)) {
            return redirect()->back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => bcrypt($request->input('password_baru')),
        ]);

        return redirect()->route('petani.profile')->with('success', 'Kata sandi berhasil diubah.');
    }
}
