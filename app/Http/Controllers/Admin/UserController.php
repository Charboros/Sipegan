<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function store(\App\Http\Requests\StoreUserRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['username'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return back()->with('success', 'Akun petugas berhasil ditambahkan.');
    }

    public function update(\App\Http\Requests\UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        
        $data = [
            'name' => $validated['username'],
            'username' => $validated['username'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return back()->with('success', 'Akun petugas berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
