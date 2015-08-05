<?php namespace App;


class Comment extends BaseModel {

    protected $table = 'comments';

    /**
     * 多对1关系：
     *
     * @return mixed
     */
    public function article()
    {
        return $this->hasOne('App\Article', 'article_id', 'article_id');
    }
}
