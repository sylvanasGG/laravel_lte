<?php namespace App;


class Contact extends BaseModel {

    protected $table = 'contacts';


    /**
     * ��ϵ���ͣ�����
     */
    const CONTACT_TYPE_IN   = 0;
    /**
     * ��ϵ���ͣ����
     */
    const CONTACT_TYPE_OUT  = 1;
    /**
     * ��ϵ����
     *
     * @var array
     */
    public static $CONTACT_TYPE = array(
        self::CONTACT_TYPE_IN   => '����',
        self::CONTACT_TYPE_OUT  => '���'
    );

    /**
     * �Ƿ��´���ϵ������ϵ
     */
    const CONTACT_ON_NO     = 0;
    /**
     * �Ƿ��´���ϵ����ϵ
     */
    const CONTACT_ON_YES    = 1;
    /**
     * �Ƿ��´���ϵ
     *
     * @var array
     */
    public static $CONTACT_ON = array(
        self::CONTACT_ON_NO     => '��',
        self::CONTACT_ON_YES    => '��'
    );
}
