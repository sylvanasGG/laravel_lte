<?php

namespace App\Cores;

use App\BaseModel;

/**
 * 核心订单模型[主要处理订单枚举类型和数据解析]
 *
 * @author Camry.Chen
 */
class Core_User extends BaseModel {

    /*
     * 管理组：管理员
     */
    const CP_GROUP_ADMIN        =  3;
    /*
     * 管理组：文章发布员
     */
    const CP_GROUP_ARTICLE      =  5;


    public static $CP_GROUP = [
        self::CP_GROUP_ADMIN    => '管理员',
        self::CP_GROUP_ARTICLE  => '文章发布员',
    ];
}
