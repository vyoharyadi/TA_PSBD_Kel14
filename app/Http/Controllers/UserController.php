<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function index()
    {
        $users = User::where('role', 'user')->where('status', 'active')->get();
        $statusView = 'active';
        return view('user', compact('users', 'statusView'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $user->update($request->only(['username', 'email', 'phone', 'address']));
        return redirect()->back()->with('success', 'User berhasil diupdate');
    }

    public function ban($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $user->update(['status' => 'banned']);
        return redirect()->back()->with('success', 'User berhasil di-ban');
    }

    public function showInactive()
    {
        $users = User::where('role', 'user')->where('status', 'inactive')->get();
        $statusView = 'inactive';
        return view('user', compact('users', 'statusView'));
    }

    public function showBanned()
    {
        $users = User::where('role', 'user')->where('status', 'banned')->get();
        $statusView = 'banned';
        return view('user', compact('users', 'statusView'));
    }

    public function activate($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $user->update(['status' => 'active']);
        return redirect()->back()->with('success', 'User berhasil diaktifkan');
    }

    public function unban($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $user->update(['status' => 'active']);
        return redirect()->back()->with('success', 'User berhasil di-unban');
    }

    public function destroy($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
