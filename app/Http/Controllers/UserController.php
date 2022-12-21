<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::getAllUsers());
    }

    public function destroy(User $user)
    {
        // $this->authorize is not needed here, because the UserPolicy is linked automatically with the 7 CRUD verbs:
        // index, show, create, store, edit, update and delete
        // more info at https://laravel.com/docs/9.x/authorization#registering-policies -> Policy Auto-Discovery
        $user->delete();
        return redirect()->back();
    }
}
