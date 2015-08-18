<?php namespace App;


class Contact extends BaseModel {

    protected $table = 'contacts';


    /**
     * 联系类型：打入
     */
    const CONTACT_TYPE_IN   = 0;
    /**
     * 联系类型：打出
     */
    const CONTACT_TYPE_OUT  = 1;
    /**
     * 联系类型
     *
     * @var array
     */
    public static $CONTACT_TYPE = array(
        self::CONTACT_TYPE_IN   => '打入',
        self::CONTACT_TYPE_OUT  => '打出'
    );

    /**
     * 是否下次联系：不联系
     */
    const CONTACT_ON_NO     = 0;
    /**
     * 是否下次联系：联系
     */
    const CONTACT_ON_YES    = 1;
    /**
     * 是否下次联系
     *
     * @var array
     */
    public static $CONTACT_ON = array(
        self::CONTACT_ON_NO     => '否',
        self::CONTACT_ON_YES    => '是'
    );
}
