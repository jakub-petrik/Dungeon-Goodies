<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    public function showUserListForAdmin(Request $request)
    {
        $query = User::orderBy('id');

        if ($search = $request->input('search')) {
            $searchLower = strtolower($search);

            $query->where(function ($q) use ($search, $searchLower) {
                $q->whereRaw('LOWER(first_name) LIKE ?', ["%{$searchLower}%"])
                  ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$searchLower}%"])
                  ->orWhereRaw('LOWER(email) LIKE ?', ["%{$searchLower}%"])
                  ->orWhereRaw("LOWER(CONCAT(first_name, ' ', last_name)) LIKE ?", ["%{$searchLower}%"]);

                if (is_numeric($search)) {
                    $q->orWhere('id', $search);
                }

                $q->orWhere(function ($q2) use ($searchLower) {
                    if (Str::startsWith($searchLower, ['a', 'ad', 'adm', 'admin'])) {
                        $q2->where('admin', true);
                    } elseif (Str::startsWith($searchLower, ['m', 'me', 'mem', 'memb', 'member'])) {
                        $q2->where('admin', false);
                    }
                });
            });
        }

        $users = $query->paginate(3)->withQueryString();

        return view('layouts.Users_Info_Page', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,member'
        ]);

        $user = \App\Models\User::findOrFail($id);

        if (auth()->id() === $user->id && $request->input('role') !== 'admin') {
            return response()->json(['error' => 'You cannot remove your own admin role.'], 403);
        }

        $user->admin = $request->input('role') === 'admin';
        $user->save();

        return response()->json(['success' => true]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
