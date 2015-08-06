<?php namespace App;

use App\Cores\Core_Article;
use Illuminate\Database\Eloquent\Model;

class Article extends Core_Article {

    protected $table = 'articles';

    protected $primaryKey = 'article_id';
    /**
     * 1对多关系：备注信息
     *
     * @return mixed
     */
    public function comment()
    {
        return $this->hasMany('App\Comment', 'article_id', 'article_id');
    }
}
