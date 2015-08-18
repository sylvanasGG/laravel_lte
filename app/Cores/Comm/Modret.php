<?php
/**
 * 模块控制器公共应答码
 *
 * @author Camry.Chen
 */
class Core_Comm_Modret {
    /**
     * 统一抛出错误方法
     *
     * 业务逻辑错误 code < 0
     * 系统内部错误 code > 0
	 */
	const RET_SUCC = 0; // 成功
	const RET_DEFAULT_ERR = -1; // h_系统内部错误
	const RET_MISS_ARG = -100; // 缺少参数
	const RET_ARG_ERR = -101; // 参数错误
	const RET_OAUTH_ERR = -102; // h_系统鉴权错误
	const RET_API_ERR = -103; // 接口调用失败
	const RET_API_FREQ_DENY = -104; // 操作过于频繁，请稍后再试
	const RET_API_OAUTH_ERR = -105; // 授权错误
	const RET_API_ARG_ERR = -106; // 操作失败
	const RET_API_INNER_ERR = -107; // 内部错误
	const RET_DATA_NA = -108; // 对不起，您的页面暂时无法找到！
	const RET_T_MISS = -109; // 请输入内容

    const RET_U_UNLOGIN = -120; // 您还未登录

    const RET_DELETED = -150; //此消息不存在
    const RET_SAVE_FAILED = -151; //保存失败
    const RET_JSON_PARSE_ERROR = -152; //Json解析错误

    const RET_AUTH_BY_TOKEN_FAILED  = 1; //腾讯Token验证失败
    const RET_VERIFY_ID_NOT_EXISTS  = 10; //微信订单不存在
    const RET_MISS_FIELDS           = 11; //缺少字段，请仔细检查
    const RET_VERIFY_STATE_ERROR    = 13; //认证状态错误：请主管进行“订单状态同步”
    const RET_NICKNAME_USED         = 1001; //昵称唯一
    const RET_NAME_LIMIT            = 1002; //主体名称限制

    //msg:h_开头的表示异步调用时不展示给用户
    static public $ARR_MSG = array(
        self::RET_SUCC => "成功"
        , self::RET_DEFAULT_ERR => "h_系统内部错误"
        , self::RET_MISS_ARG => "缺少参数"
        , self::RET_ARG_ERR => "参数错误"
        , self::RET_OAUTH_ERR => "h_系统鉴权错误"
        , self::RET_API_ERR => "接口调用失败"
        , self::RET_API_FREQ_DENY => "操作过于频繁，请稍后再试"
        , self::RET_API_OAUTH_ERR => "授权错误"
        , self::RET_API_ARG_ERR => "操作失败"
        , self::RET_API_INNER_ERR => "内部错误"
        , self::RET_DATA_NA => "对不起，您的页面暂时无法找到！"
        , self::RET_T_MISS => "请输入内容"

        , self::RET_U_UNLOGIN => "您还未登录"

        , self::RET_DELETED     => '此消息不存在'
        , self::RET_SAVE_FAILED => '保存失败'
        , self::RET_JSON_PARSE_ERROR => 'Json解析错误'

        , self::RET_AUTH_BY_TOKEN_FAILED => '腾讯Token验证失败，请联系管理员'
        , self::RET_VERIFY_ID_NOT_EXISTS => '微信订单不存在'
        , self::RET_MISS_FIELDS => '缺少字段，请仔细检查'
        , self::RET_VERIFY_STATE_ERROR => '认证状态错误：请主管进行“订单状态同步”'
        , self::RET_NICKNAME_USED => '昵称唯一：需要重新打回昵称，让用户选择其他昵称'
        , self::RET_NAME_LIMIT => '主体名称限制：企业类型只允许认证10个帐号，非企业类型可以认证20个帐号'
    );
				
	static public function getMsg($code)
	{
		return isset(self::$ARR_MSG[$code]) ? self::$ARR_MSG[$code] : $code;
	}
	
	//get json
	static public function getRetJson($code, $msg='', $target='', $data=NULL, $callback=NULL)
	{
		if(empty($msg))
		{
			$msg = "".self::getMsg($code);
		}
		$jsonPrototype = array(
			"ret" => $code,
			"msg" => $msg,
			'target'	=> $target,
		 	"timestamp" => time()//返回接口调用的服务器时间戳 michal
		);
		
		if(!empty($data))
		{
			$jsonPrototype["data"] = is_string($data) ? str_replace(array("\r","\n","\t"),'',$data) : $data;
		} 
		
		$json = json_encode($jsonPrototype);
		//验证回调函数合法性
		if(Core_Comm_Validator::checkCallback($callback))
		{
			$json = $callback."(".$json.")";
		}
		return $json;
	}
}