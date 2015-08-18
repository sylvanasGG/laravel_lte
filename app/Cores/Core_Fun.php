<?php
namespace App\Cores;
/**
 * 常用函数库
 *
 * @author Camry.Chen
 */
class Core_Fun {
    /**
     * 返回json对象
     */
    public static function returnJson( $code , $msg='', $target='' , $params=array(), $callback=NULL)
    {
        $msg = empty($msg)? Core_Modret::getMsg($code) :$msg;
        return Core_Modret::getRetJson($code, $msg, $target, $params,$callback);
    }

    /**
     * 输出json对象 并exit
     */
    public static function exitJson( $code , $msg='', $target='' , $params=array(), $callback=NULL)
    {
        exit( self::returnJson($code, $msg, $target, $params,$callback));
    }

    /**
     * iframe的ajax方式输出json对象 主要是有script标签
     */
    public static function iFrameExitJson( $code , $msg='', $target='' , $params=array(), $callback=NULL)
    {
        if(Core_Comm_Validator::checkCallback($callback))		//有回调函数才需要<script>标签
        {
            exit('<script>'.self::returnJson($code, $msg, $target , $params, $callback).'</script>');
        }
        else
        {
            exit( self::returnJson($code, $msg, $target, $params));
        }
    }

    /**
     * showMsg 方法
     *
     * @param string $msg	提示信息内容
     * @param string $goUrl 跳转地址
     * @param int    $time	跳转等待时间
     * @param string $type  提示类型
     * @return mixed
     */
    public static function showMsg($msg, $goUrl = -1, $time = 2 , $type = 'succeed')
    {
        if ($goUrl == -1)
        {
            $goUrl = empty($_SERVER['HTTP_REFERER']) ? self::getUrlRoot() : $_SERVER['HTTP_REFERER'];
        } elseif (!preg_match ('#^(https?|ftp)://#' , $goUrl) && !preg_match ('/^javascript/' , $goUrl))
        {
            if(!preg_match('/^\//', $goUrl))
            {
                $goUrl = '/'.$goUrl;
            }
        }
        $output = array();
        //检测是否有问号?
        $parseUrl = parse_url($goUrl);
        if((array_key_exists('query',$parseUrl)))
        {
            parse_str($parseUrl['query'], $output);
            if(isset($output['errorType']))
            {
                unset($output['errorType'] );
            }
            if(isset($output['errorMsg']))
            {
                unset($output['errorMsg'] );
            }
        }
        $output['errorType'] = $type;
        $output['errorMsg']  = $msg;
        $url = isset($parseUrl['path']) ? $parseUrl['path'].'?'.http_build_query($output) : '/';
        return Redirect::to($url);
    }

    /**
     * 获得UrlRoot
     *
     * @return string
     */
    public static function getUrlRoot()
    {
        $http = $_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http';
        return $http . '://' . $_SERVER['HTTP_HOST'];
    }

    /**
     * 格式化字节
     *
     * @param $size - 大小(字节)
     * @return string 返回格式化后的文本
     */
    public static function formatBytes($size)
    {
        if ($size >= 1073741824)
        {
            $size = round($size / 1073741824 * 100) / 100 . ' GB';
        }
        elseif ($size >= 1048576)
        {
            $size = round($size / 1048576 * 100) / 100 . ' MB';
        }
        elseif ($size >= 1024)
        {
            $size = round($size / 1024 * 100) / 100 . ' KB';
        }
        else
        {
            $size = $size . ' Bytes';
        }
        return $size;
    }

    /**
     * AES 加密
     *
     * @param string $str 加密的字符串
     * @return string
     */
    public static function encrypt($str)
    {
        # Add PKCS7 padding.
        $block = mcrypt_get_block_size(Config::get('app.cipher'), MCRYPT_MODE_ECB);
        $len = strlen($str);
        $padding = $block - ($len % $block);
        $str .= str_repeat(chr($padding),$padding);
        return mcrypt_encrypt(Config::get('app.cipher'), Config::get('app.key'), $str, MCRYPT_MODE_ECB);
    }

    /**
     * AES 解密
     *
     * @param string $str 加密的字符串
     * @return string
     */
    public static function decrypt($str)
    {
        $str = mcrypt_decrypt(Config::get('app.cipher'), Config::get('app.key'), $str, MCRYPT_MODE_ECB);
        //To remove PKCS7 padding
        $dec_s = strlen($str);
        $padding = ord($str[$dec_s-1]);
        return substr($str, 0, -$padding);
    }

    /**
     * 对变量进行 JSON 编码
     *
     * @param $arr
     * @return string
     */
    public static function jsonEncode($arr)
    {
        //convmap since 0x80 char codes so it takes all multibyte codes (above ASCII 127). So such characters are being "hidden" from normal json_encoding
        array_walk_recursive($arr, function (&$item, $key) { if (is_string($item)) $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); });
        return mb_decode_numericentity(json_encode($arr), array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
    }


    /**
     * 截取中英文混合字符串
     */
    public static function  mixSub($str, $len, $charset="utf-8")
    {
        //如果截取长度小于等于0，则返回空
        if( !is_numeric($len) or $len <= 0 )
        {
            return "";
        }

        //如果截取长度大于总字符串长度，则直接返回当前字符串
        $sLen = strlen($str);
        if( $len >= $sLen )
        {
            return $str;
        }
        //判断使用什么编码，默认为utf-8
        if ( strtolower($charset) == "utf-8" )
        {
            $len_step = 3; //如果是utf-8编码，则中文字符长度为3
        }else{
            $len_step = 2; //如果是gb2312或big5编码，则中文字符长度为2
        }

        //执行截取操作
        $len_i = 0;
        //初始化计数当前已截取的字符串个数，此值为字符串的个数值（非字节数）
        $substr_len = 0; //初始化应该要截取的总字节数

        for( $i=0; $i < $sLen; $i++ )
        {
            if ( $len_i >= $len ) break; //总截取$len个字符串后，停止循环
            //判断，如果是中文字符串，则当前总字节数加上相应编码的中文字符长度
            if( ord(substr($str,$i,1)) > 0xa0 )
            {
                $i += $len_step - 1;
                $substr_len += $len_step;
            }else{ //否则，为英文字符，加1个字节
                $substr_len ++;
            }
            $len_i ++;
        }
        $result_str = substr($str,0,$substr_len );
        return $result_str;
    }

    /**
     * 隐藏座机电话（后4位）
     */
    public static function hideLandTelephone($phone)
    {
        if(is_string($phone))
        {
            $arr = explode('-',$phone);
            foreach($arr as $key=>$val)
            {
                if(strlen($val) > 4)
                {
                    $arr[$key] = substr($val,0,4).'****';
                }
            }
            return join('-',$arr);
        }
        return $phone;
    }

    /**
     * 外拨座机电话
     */
    public static function callOutLandTelephone($phone)
    {
        if(is_string($phone))
        {
            $arr = explode('-',$phone);
            //判断第一位是否有86 号码
            if($arr[0] == '86' || $arr[0] == '+86' || $arr[0] == '086')
            {
                //判断第二段是否为区号或者不加0区号
                if(isset($arr[1]) && (strlen($arr[1]) == 3 || strlen($arr[1]) == 4 || strlen($arr[1]) == 2))
                {
                    //判断第三段是否为座机号
                    if(isset($arr[2]) && strlen($arr[2]) > 4 )
                    {
                        //重新拼接号码
                        $newArr = array($arr[1],$arr[2]);
                        return join('',$newArr);
                    }
                    //如果第二段为座机号
                } elseif(isset($arr[1]) && strlen($arr[1]) > 4)
                {
                    return $arr[1];
                }
                //判断第一段为正常区号或不加0区号
            } elseif(strlen($arr[0]) == 3 || strlen($arr[0]) == 4 || strlen($arr[0]) == 2)
            {
                //判断第二段是否为座机号
                if(isset($arr[1]) && strlen($arr[1]) > 4)
                {
                    //重新拼接号码
                    $newArr = array($arr[0],$arr[1]);
                    return join('',$newArr);
                }
                //第一段即为座机号
            } elseif(strlen($arr[0]) > 4)
            {
                return $arr[0];
            }
        }
        return $phone;
    }
}
