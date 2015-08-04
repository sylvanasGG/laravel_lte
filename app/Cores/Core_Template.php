<?php

namespace App\Cores;

/**
 * Template 封装
 *
 * @author Camry.Chen
 */
class Core_Template {
    /**
     * 存储模板变量的全局变量
     *
     * @var array 
     */
    private static $_VAR = array();

    /**
     * 私有的构造函数
     * 禁止new
     */
    private function __construct()
    {

    }

    /**
     * 注册一个变量
     *
     * @param string $key
     * @param mix $value
     */
    public static function assignVar($key, $value = NULL)
    {
        if(is_array($key))
        {
            foreach((array)$key as $_k => $_v)
            {
                self::assignVar($_k, $_v);
            }
        } else
        {
            if (! empty($key))
            {
                self::$_VAR[(string)$key] = $value;
            } else
            {
                self::$_VAR = $value;
            }
        }
    }

    /**
     * 获取一个已经注册的变量
     *
     * @param string $key
     * @param mix $default
     * @return mix
     */
    public static function getVar($key, $default = NULL)
    {
        if(isset(self::$_VAR[$key]))
        {
            return self::$_VAR[$key];
        } else
        {
            if($default)
            {
                return $default;
            } else
            {
                return NULL;
            }
        }
    }

    /**
     * 调用一个模板
     *
     * @param $tpl
     * @return \Illuminate\View\View
     */
    public static function display($tpl)
    {
        return view($tpl, self::$_VAR);
    }

    /**
     *
     * 获取一个模板内容
     *
     * @param string $tpl
     * @return \Illuminate\View\View
     */
    public static function fetch($tpl)
    {
        return view($tpl, self::$_VAR)->render();
    }
}
