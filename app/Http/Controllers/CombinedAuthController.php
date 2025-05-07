<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CombinedAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('main');
            } else {
                return back()->withErrors(['password' => 'Invalid password.']);
            }
        } else {
            return back()->withErrors(['email' => 'No account found with that email.']);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $newUser = User::create([
            'nickname' => $request->nickname,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        \Illuminate\Support\Facades\Auth::login($newUser);

        return redirect()->route('main')->with('status', 'Account created and logged in.');
    }

}
