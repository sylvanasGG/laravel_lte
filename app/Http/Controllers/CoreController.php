<?php

namespace App\Http\Controllers;

use App\Cores\Core_Template;
use App\Cores\Core_Config;
use App\Cores\Core_Fun;
use Illuminate\Support\Facades\Request;

/**
 * 核心控制器
 *
 * @package App\Http\Controllers
 * @author Camry.Chen
 */
class CoreController extends Controller {

    /**
     * 状态消息变量名
     *
     * @var string
     */
    protected $statusVar = 'status';

    /**
     * This is configured to only allow guest and csrf
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('csrf');
    }

    /**
     *
     * 调用一个模板
     *
     * @param string $tpl
     * @return \Illuminate\View\View
     */
    public function display($tpl)
    {
        $this->_setDefaultTplParams();
        return Core_Template::display($tpl);
    }

    /**
     * 设置一个模板变量
     *
     * @param string $key
     * @param mixed $val
     */
    public function assign($key, $val)
    {
        Core_Template::assignVar($key, $val);
    }

    /**
     * 在所有视图同共享同一数据
     *
     * @param string $key
     * @param mixed $val
     */
    public function share($key, $val)
    {
        view()->share($key, $val);
    }

    /**
     *
     * 获取一个模板内容
     *
     * @param string $tpl
     * @return \Illuminate\View\View
     */
    public function fetch($tpl)
    {
        $this->_setDefaultTplParams();
        return Core_Template::fetch($tpl);
    }

    /**
     * 设置默认模板参数
     */
    protected function _setDefaultTplParams()
    {
        Core_Template::assignVar(array(
            '_actionName' => $this->getRouter()->currentRouteAction(),
            '_appUrl'     => config('app.url'),
            '_version'  => config('lte.version')
        ));
    }

    /**
     * 统一抛出AJAX方法
     *
     * @param number $code < 0
     * @param string $msg
     * @param string $target
     * @param array $params 扩展参数
     * @param string $callback
     */
    public function exitJson($code, $msg='', $target='', $params=array (), $callback=NULL)
    {
        Core_Fun::exitJson($code, $msg, $target, $params, $callback);
    }

    /**
     * 统一返回 AJAX方法
     *
     * @param number $code < 0
     * @param string $msg
     * @param string $target
     * @param array $params 扩展参数
     * @param string $callback
     * @return string
     */
    public function returnJson($code, $msg='', $target='', $params=array (), $callback=NULL)
    {
        return Core_Fun::returnJson($code, $msg, $target, $params, $callback);
    }

    /**
     * Get the post redirect path.
     *
     * @param string $path 路径
     * @return string
     */
    public function redirectPath($path = '/')
    {
        if(! str_is('/', $path))
        {
            return $path;
        }
        if (property_exists($this, 'redirectPath'))
        {
            return $this->redirectPath;
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : $path;
    }


}
