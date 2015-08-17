<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function adminGroup()
    {
        return $this->hasOne('App\AdminGroup','cp_group_id','cp_group_id');
    }

    /* ״̬ */
    const STATUS_ACTIVATED  = 0;
    const STATUS_DISABLED   = 1;
    public static $STATUS = array(
        self::STATUS_ACTIVATED  => '�Ѽ���',
        self::STATUS_DISABLED   => '�ѽ���'
    );
    public static $STATUS_HTML = array(
        self::STATUS_ACTIVATED  => '�Ѽ���',
        self::STATUS_DISABLED   => '<span style="color: red;">�ѽ���</span>'
    );
}
