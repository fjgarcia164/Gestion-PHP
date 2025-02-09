<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);
        $user->verified = true;
        $user->save();
        return back()->with('success', 'Usuario verificado.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Usuario eliminado.');
    }
}
