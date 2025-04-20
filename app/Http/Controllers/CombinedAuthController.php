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
                return back()->withErrors(['email' => 'Invalid password.']);
            }
        } else {
            $newUser = User::create([
                'name' => explode('@', $request->email)[0],
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($newUser);
            return redirect()->route('main')->with('status', 'Account created and logged in.');
        }
    }
}
