<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller{

    /**
     * 视图：登录
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {

        return View('admin.auth.login');
    }

    /**
     * 动作：登录
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /*
     * 动作：退出
     */
    public function getLoginOut()
    {
        Auth::logout();
        return redirect()->intended('auth/login');
    }

    /**
     * 视图：忘记密码发送邮件
     */
    public function getSendEmailForPassword()
    {
        return View('admin.auth.missPassword');
    }

    /**
     * 动作：发送邮件
     *
     * @param Request $request
     */
    public function postSendEmailForPassword(Request $request)
    {
        if($request->has('userEmail'))
        {
            $pattern = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9_-])+\.)+([a-zA-Z0-9]{2,4})+$/";
            if(preg_match($pattern,Input::get('userEmail')))
            {
                if(! $request->has('username'))
                {
                    $this->exitJson(Core_Comm_Modret::RET_MISS_ARG, '请先填写用户名','username');
                }
                if(!User::where('username', '=', $request->input('username'))->first())
                {
                    
                }
                $userEmail = $request->input('userEmail');
                $data = array('username' => $request->input('username'));
                Mail::send('auth.emailForPassword', $data, function($message)
                {
                    $userEmail = Input::get('userEmail');
                    $message->to($userEmail)->subject('修改后台登录密码');
                });
                //写入缓存
               // Cache::put("dynamicPassword_".Input::get('userEmail'), $dynamicPassword,5);
               // $this->exitJson(Core_Comm_Modret::RET_SUCC, '口令发送成功请查看');
                return redirect()->intended('auth/login');
            } else
            {
                $this->exitJson(Core_Comm_Modret::RET_MISS_ARG, '请填写正确邮箱地址','userEmail');
            }
        }
    }

}