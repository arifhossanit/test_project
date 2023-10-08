<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    public function index()
    {
        return view('user.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'username'      => 'required',
            'account_type'  => 'required',
            'email'         => 'required|email',
            'password'      => 'required',
        ]);
    
        $post = new User;
        $post->name = $request->input('username');
        $post->account_type = $request->input('account_type');
        $post->email = $request->input('email');
        $post->password =  md5($request->input('password'));
        $post->save();
    
        return redirect('/login')->with('success', 'User Created!');
    }

    public function login(Request $request)
    {
        //remove single session
        return view('user.login');
    }

    public function sing_in(Request $request)
    {
        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required',
        ]);
    
        $users = User::select('*')
             ->where([
                 ['email', '=', $request->input('email')],
                 ['password', '=', md5($request->input('password'))]
             ])
             ->first();
        if (!empty($users->id)) {
            Session::put('login', 1);
            return redirect('/')->with('success', 'Succesfully login!');
        }else {
            return redirect('/login')->with('fail', 'User or password is wrong!');
        }
    }
}
