<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class BaseController extends CoreController {

    protected $_menus = '';
    public function __construct()
    {
        //获取配置文件中的menu目录
        //验证当前登录用户
//        if(! Auth::check())
//        {
//            return Redirect::to('auth/login');
//        }
        $this->_menus = config("menu");
        $this->assign('menus',$this->_menus);
    }
}
