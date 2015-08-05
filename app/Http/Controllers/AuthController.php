<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller{

    public function getLogin()
    {

        return View('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
        {
            return redirect()->intended('admin/index');
        }
        return redirect()->intended('auth/login');
     //   return redirect()->intended('auth/login');
//        $user = User::find(1);
//        Auth::login($user);
//        return redirect()->intended('admin/admin');
    }


    public function getRegister()
    {
        return View('admin.auth.register');
    }

    public function postRegister(Request $request)
    {
        User::create([
            'username'=>$request->input('username'),
            'password'=>bcrypt($request->input('password'))
        ]);
        return redirect('auth/login');

    }

}