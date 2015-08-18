<?php
namespace App\Cores;
/**
 * ���ú�����
 *
 * @author Camry.Chen
 */
class Core_Fun {
    /**
     * ����json����
     */
    public static function returnJson( $code , $msg='', $target='' , $params=array(), $callback=NULL)
    {
        $msg = empty($msg)? Core_Modret::getMsg($code) :$msg;
        return Core_Modret::getRetJson($code, $msg, $target, $params,$callback);
    }

    /**
     * ���json���� ��exit
     */
    public static function exitJson( $code , $msg='', $target='' , $params=array(), $callback=NULL)
    {
        exit( self::returnJson($code, $msg, $target, $params,$callback));
    }

    /**
     * iframe��ajax��ʽ���json���� ��Ҫ����script��ǩ
     */
    public static function iFrameExitJson( $code , $msg='', $target='' , $params=array(), $callback=NULL)
    {
        if(Core_Comm_Validator::checkCallback($callback))		//�лص���������Ҫ<script>��ǩ
        {
            exit('<script>'.self::returnJson($code, $msg, $target , $params, $callback).'</script>');
        }
        else
        {
            exit( self::returnJson($code, $msg, $target, $params));
        }
    }

    /**
     * showMsg ����
     *
     * @param string $msg	��ʾ��Ϣ����
     * @param string $goUrl ��ת��ַ
     * @param int    $time	��ת�ȴ�ʱ��
     * @param string $type  ��ʾ����
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
        //����Ƿ����ʺ�?
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
     * ���UrlRoot
     *
     * @return string
     */
    public static function getUrlRoot()
    {
        $http = $_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http';
        return $http . '://' . $_SERVER['HTTP_HOST'];
    }

    /**
     * ��ʽ���ֽ�
     *
     * @param $size - ��С(�ֽ�)
     * @return string ���ظ�ʽ������ı�
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
     * AES ����
     *
     * @param string $str ���ܵ��ַ���
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
     * AES ����
     *
     * @param string $str ���ܵ��ַ���
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
     * �Ա������� JSON ����
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
     * ��ȡ��Ӣ�Ļ���ַ���
     */
    public static function  mixSub($str, $len, $charset="utf-8")
    {
        //�����ȡ����С�ڵ���0���򷵻ؿ�
        if( !is_numeric($len) or $len <= 0 )
        {
            return "";
        }

        //�����ȡ���ȴ������ַ������ȣ���ֱ�ӷ��ص�ǰ�ַ���
        $sLen = strlen($str);
        if( $len >= $sLen )
        {
            return $str;
        }
        //�ж�ʹ��ʲô���룬Ĭ��Ϊutf-8
        if ( strtolower($charset) == "utf-8" )
        {
            $len_step = 3; //�����utf-8���룬�������ַ�����Ϊ3
        }else{
            $len_step = 2; //�����gb2312��big5���룬�������ַ�����Ϊ2
        }

        //ִ�н�ȡ����
        $len_i = 0;
        //��ʼ��������ǰ�ѽ�ȡ���ַ�����������ֵΪ�ַ����ĸ���ֵ�����ֽ�����
        $substr_len = 0; //��ʼ��Ӧ��Ҫ��ȡ�����ֽ���

        for( $i=0; $i < $sLen; $i++ )
        {
            if ( $len_i >= $len ) break; //�ܽ�ȡ$len���ַ�����ֹͣѭ��
            //�жϣ�����������ַ�������ǰ���ֽ���������Ӧ����������ַ�����
            if( ord(substr($str,$i,1)) > 0xa0 )
            {
                $i += $len_step - 1;
                $substr_len += $len_step;
            }else{ //����ΪӢ���ַ�����1���ֽ�
                $substr_len ++;
            }
            $len_i ++;
        }
        $result_str = substr($str,0,$substr_len );
        return $result_str;
    }

    /**
     * ���������绰����4λ��
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
     * �Ⲧ�����绰
     */
    public static function callOutLandTelephone($phone)
    {
        if(is_string($phone))
        {
            $arr = explode('-',$phone);
            //�жϵ�һλ�Ƿ���86 ����
            if($arr[0] == '86' || $arr[0] == '+86' || $arr[0] == '086')
            {
                //�жϵڶ����Ƿ�Ϊ���Ż��߲���0����
                if(isset($arr[1]) && (strlen($arr[1]) == 3 || strlen($arr[1]) == 4 || strlen($arr[1]) == 2))
                {
                    //�жϵ������Ƿ�Ϊ������
                    if(isset($arr[2]) && strlen($arr[2]) > 4 )
                    {
                        //����ƴ�Ӻ���
                        $newArr = array($arr[1],$arr[2]);
                        return join('',$newArr);
                    }
                    //����ڶ���Ϊ������
                } elseif(isset($arr[1]) && strlen($arr[1]) > 4)
                {
                    return $arr[1];
                }
                //�жϵ�һ��Ϊ�������Ż򲻼�0����
            } elseif(strlen($arr[0]) == 3 || strlen($arr[0]) == 4 || strlen($arr[0]) == 2)
            {
                //�жϵڶ����Ƿ�Ϊ������
                if(isset($arr[1]) && strlen($arr[1]) > 4)
                {
                    //����ƴ�Ӻ���
                    $newArr = array($arr[0],$arr[1]);
                    return join('',$newArr);
                }
                //��һ�μ�Ϊ������
            } elseif(strlen($arr[0]) > 4)
            {
                return $arr[0];
            }
        }
        return $phone;
    }
}
