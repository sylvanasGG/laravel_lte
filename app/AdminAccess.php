<?php
namespace App;

class AdminAccess extends BaseModel {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_accesses';

    /**
     * 获取系统管理员信息
     *
     * @return array
     */
    public static function getSystemAdmin()
    {
        $founder = explode(',', str_replace(' ', '', Config('auth.founder')));
        $founders = User::whereIn('uid', $founder)->get();
        return $founders;
    }


    /**
     * 检查是否是系统管理员
     *
     * @param User $user 用户对象
     * @return boolean
     */
    public static function checkIsSystemAdmin($user)
    {
        $founders = str_replace(' ', '', Config('auth.systemAdmin'));
        //匹配系统管理员ID
        if(str_contains(",{$founders},", ",{$user->uid},"))
        {
            return true;
        }
        return false;
    }
}