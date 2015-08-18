<?php
/**
 * API接口错误字段
 *
 * @author Camry.Chen
 */
class Core_Comm_Apiret {

    /**
     * 约定0为成功
     * 小于0代表系统错误（可重试的错误）
     * 大于0为逻辑错误（通常为程序的bug引起，需要人工干预）详细的错误码待定
     */
    const RET_SUCC = 0; //成功

    const RET_SAVE_FAILED           = 1001; //保存失败
    const RET_DECRYPTION_FAILURE    = 1002; //解密失败
    const RET_JSON_PARSE_ERROR      = 1003; //Json解析错误
    const RET_FORBID                = 1004; //禁止访问
    const RET_ARG_ERR               = 1005; //参数错误
    const RET_FAILED                = 1006; //失败

    //msg
    public static $ARR_MSG = array(
        self::RET_SUCC => "成功"

        , self::RET_SAVE_FAILED         => '保存失败'
        , self::RET_DECRYPTION_FAILURE  => '解密失败'
        , self::RET_JSON_PARSE_ERROR    => 'Json解析错误'
        , self::RET_FORBID              => "禁止访问"
        , self::RET_ARG_ERR             => "参数错误"
        , self::RET_FAILED              => "失败"
    );

    public static function getMsg($code)
    {
        return isset(self::$ARR_MSG[$code]) ? self::$ARR_MSG[$code] : '';
    }

    //get json
    public static function getRetJson($errorCode, $errorMessage='', $data=NULL, $callback=NULL)
    {
        if(empty($errorMessage))
        {
            $errorMessage = self::getMsg($errorCode);
        }

        $jsonPrototype = array(
            'error_code'    => $errorCode,
            'error_message' => $errorMessage
        );

        if(!empty($data))
        {
            $jsonPrototype += (is_string($data) ? str_replace(array("\r","\n","\t"),'',$data) : $data);
        }
        //对变量进行 JSON 编码
        $json = Core_Fun::jsonEncode($jsonPrototype);
        return $json;
    }
}