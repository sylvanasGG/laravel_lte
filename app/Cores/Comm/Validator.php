<?php
/**
 * 验证类
 *
 * @author Camry.Chen
 */
class Core_Comm_Validator {
    /**
     * 验证json回调函数名
     *
     * @param $callback
     * @return boolean
     */
    public static function checkCallback($callback)
    {
        if(empty($callback))
        {
            return false;
        }
        if(preg_match("/^[a-zA-Z_][a-zA-Z0-9_\.]*$/", $callback))
        {
            return true;
        }
        return false;
    }

    /**
     * 是否是帐号
     *
     * @param $account
     * @return bool
     */
    public static function isUserAccount($account)
    {
        $whitelist= array("t");
        if(in_array($account,$whitelist))
        {
            return true;
        }
        if(preg_match('/^[A-Za-z][A-Za-z0-9_\-]{2,20}$/', $account))
        {
            return true;
        }
        return false;
    }

    /**
     * 是否是昵称
     *
     * @param $nick
     * @return bool
     */
    public static function isUserNick($nick)
    {
        $len = strlen($nick);
        if($len == 0 || $len > 36 || preg_match("/[^\x{4e00}-\x{9fa5}\w\-\&]/u", $nick) == 1)
        {
            return false;
        }
        return true;
    }

	/**
	 * 检验email
	 *
	 * @access public
	 * @param string $str
	 * @return bool
	 */
	public static function isEmail($str)
	{
		return preg_match ( "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $str );
	}
	
	/**
	 * 检验手机号码
	 * 
	 * @param string $str
	 * @return bool
	 */
	public static function isMobile($str)
	{
		if (preg_match('/^(13|15|18)\d{9}$/',$str))
		{
			return true;
		}
	    return false;
	}

}