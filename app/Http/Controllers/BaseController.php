<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use App\Cores\Core_Template;
use App\AdminAccess;
use Illuminate\Support\Facades\Lang;
class BaseController extends CoreController {

    protected $_menus = '';
    protected $_user = '';
    /**
     * 允许访问的权限
     *
     * @var array
     */
    protected $_allowAccess = array();
    public function __construct()
    {
        $this->middleware('auth');
        //获取配置文件中的menu目录
        //验证当前登录用户

        if( !Auth::check())
        {
           // return redirect()->intended('auth/login');
            return redirect($this->redirectPath('auth/login'));
        }
//        var_dump(Auth::user());exit;
        $this->_user = Auth::user();
        $this->_menus = config("menu");
        $this->assign('_user',$this->_user);
        //权限验证
//        if (! $this->allow())
//        {
//            return back()->withErrors([Lang::get('access.accessNotAllow')]);
//        }
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

    /**
     * 获取Menu列表
     *
     * @return array
     */
    public function getMenuList()
    {
        // 加载Menu
        $menu = $this->_menus;
        // 仪表盘不进入权限控制
        unset($menu['dashboard']);
        $_allowPost = array(
            'treeView' => array('name'=>'基本权限'),
            'treeViewMenu' => array(
                array('name' => '允许修改设置', 'url' => '_allowpost', 'actionName' => '_allowpost', 'auth' => '')
            )
        );
        array_unshift($menu, $_allowPost);
        return $menu;
    }

    /**
     * 获取允许访问的菜单列表
     */
    public function getAccessMenuList()
    {
        $menuList = $this->_menus;
        if (! AdminAccess::checkIsSystemAdmin($this->_user))
        {
            if ($this->_user->cp_group_id)
            {
                foreach ($menuList as $key => $topMenu)
                {
                    if ($key == 'dashboard') continue;
                    $itemExists = 0;
                    foreach ($topMenu['treeViewMenu'] as $menuKey => $menu)
                    {
                        if(array_key_exists($menu['actionName'], $this->_allowAccess))
                        {
                            $itemExists = 1;
                        }
                        else
                        {
                            unset($menuList[$key]['treeViewMenu'][$menuKey]);
                        }
                    }
                    if(! $itemExists) unset($menuList[$key]);
                }
            }
        }
        return $menuList;
    }

    /**
     * 检查访问权限
     *
     * @return boolean
     */
    public function allow()
    {
        // 检查是否是系统管理员
        if (AdminAccess::checkIsSystemAdmin($this->_user))
        {
            return true;
        }
        //检测所在的管理组
        if (! $this->_user->cp_group_id)
        {
            return false;
        }
        $this->_user->custom_access = ! empty($this->_user->custom_access) ? unserialize($this->_user->custom_access) : array();
        if (intval($this->_user->cp_group_id) > 0)
        {
            //获取组权限列表
            $accessList = $this->getAdminAccessesToArray();
            //权限菜单
            $menuList = $this->_menus;
            //管理框架无需权限
            $this->_allowAccess['App\Http\Controllers\AdminController@getIndex'] = true;
            foreach ($menuList as $topMenu)
            {
                foreach ($topMenu['treeViewMenu'] as $menu)
                {
                    $adminAccess = AdminAccess::where('cp_group_id', '=', $this->_user->cp_group_id)->where('access', '=', $menu['actionName'])->first();
                    if ($adminAccess &&! in_array($adminAccess->access, $this->_user->custom_access) && $menu['auth'])
                    {
                        $menu['auth'] = is_array($menu['auth']) ? $menu['auth'] : (array)$menu['auth'];
                        foreach ($menu['auth'] as $auth)
                        {
                            $accessList[] = array('cp_group_id' => $adminAccess->cp_group_id, 'access' => $auth);
                        }
                    }
                }
            }
            //保存访问权限
            foreach ($accessList as $access)
            {
                if (empty($this->_user->custom_access))
                {
                    $this->_allowAccess[$access['access']] = true;
                } elseif ( !in_array($access['access'], $this->_user->custom_access))
                {
                    $this->_allowAccess[$access['access']] = true;
                }
            }
            //是否允许POST
            if(!empty($_POST) && !array_key_exists('_allowpost', $this->_allowAccess))
            {
                return false;
            }
            $actionName = $this->getRouter()->currentRouteAction();
            if (isset($this->_allowAccess[$actionName]))
            {
                return $this->_allowAccess[$actionName];
            }
            return false;
        }
        return true;
    }

    /**
     * 获取组权限列表
     *
     * @return array
     */
    protected function getAdminAccessesToArray()
    {
        $adminAccesses = $this->_user->adminAccesses;
        $adminAccessList = array();
        if($adminAccesses)
        {
            foreach($adminAccesses as $adminAccess)
            {
                $adminAccessList[] = $adminAccess->toArray();
            }
        }
        return $adminAccessList;
    }
}
