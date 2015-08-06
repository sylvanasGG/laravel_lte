<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use App\Cores\Core_Template;
class BaseController extends CoreController {

    protected $_menus = '';
    protected $_user = '';
    public function __construct()
    {
        $this->middleware('auth');
        //获取配置文件中的menu目录
        //验证当前登录用户

//        if( !Auth::check())
//        {
//           // return redirect()->intended('auth/login');
//            return redirect($this->redirectPath('auth/login'));
//        }
//        var_dump(Auth::user());exit;
        $this->_user = Auth::user();
        $this->_menus = config("menu");
        $this->assign('_user',$this->_user);
        $this->assign('menus',$this->_menus);
    }

    /**
     * 设置默认模板参数
     */
    protected function _setDefaultTplParams()
    {
        parent::_setDefaultTplParams();
        Core_Template::assignVar(array(
            '_user' => $this->_user
        ));
    }

    public function getMenuList()
    {
        // 加载Menu
        return $this->_menus;
    }
}
