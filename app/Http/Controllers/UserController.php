<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    public function index()
    {
        return view('user.create', ['name' => 'Alex']);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'account_type' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $post = new User;
        $post->name = $request->input('username');
        $post->account_type = $request->input('account_type');
        $post->email = $request->input('email');
        $post->password = $request->input('password');
        $post->save();
    
        return redirect('/users')->with('success', 'User Created');
    }
}
