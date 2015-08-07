<?php

namespace App\Cores;

use App\BaseModel;
use App\Article;

/**
 * 核心订单模型[主要处理订单枚举类型和数据解析]
 *
 * @author Camry.Chen
 */
class Core_Article extends BaseModel {

    /*
     * 文章类型：文字
     */
    const ARTICLE_TYPE_WORD   =  'word';
    /*
     * 文章类型：编程
     */
    const ARTICLE_TYPE_CODE   =  'code';
    /*
     * 文章类型：游戏
     */
    const ARTICLE_TYPE_GAME   =  'game';
    /*
     * 文章类型：其他
     */
    const ARTICLE_TYPE_OTHER   =  'other';

    public static $ARTICLE_TYPE = [
        self::ARTICLE_TYPE_WORD => '文字',
        self::ARTICLE_TYPE_CODE => '编程',
        self::ARTICLE_TYPE_GAME => '游戏',
        self::ARTICLE_TYPE_OTHER => '其他',
    ];

    public static function getAllArticle()
    {

        //所有文章
        $articles = Article::orderBy('updated_at','desc')->get();
        $articleArr = [];
        foreach($articles as $article)
        {
            $articleArr[$article->article_id] = str_limit($article->title,15);
        }
        return $articleArr;
    }
}
