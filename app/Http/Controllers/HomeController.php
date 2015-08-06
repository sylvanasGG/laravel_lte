<?php namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use Redirect, Input, Auth;

class HomeController extends Controller {


    public function getIndex()
    {
        $mod = Article::orderBy('updated_at','desc');
        $articles = $mod->paginate(3);
//        $this->assign('articles',$articles);
//        return $this->display('home.index');
        return View('home.index',['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getArticle($id)
    {
        $article = Article::find($id);
        return View('home.article',['article'=>$article]);
    }

    /**
     * @param $type
     * @return \Illuminate\View\View
     */
    public function getArticles($type)
    {
        $mod = Article::where('article_type', '=', $type)->orderBy('updated_at','desc');
        $articles = $mod->paginate(3);
//        $this->assign('articles',$articles);
//        return $this->display('home.index');
        return View('home.index',['articles'=>$articles]);
    }

    public function getRegister()
    {
        return View('home.register');
    }




}