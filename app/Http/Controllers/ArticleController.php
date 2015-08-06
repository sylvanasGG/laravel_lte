<?php namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Redirect, Input, Auth;

class ArticleController extends BaseController {


    public function getIndex()
    {
        $mod = Article::orderBy('updated_at','desc');
        $articles = $mod->paginate(10);
        $this->assign('articles',$articles);
        return $this->display('admin.article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return $this->display('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function postCreate(Request $request)
    {
//        if($request->hasFile('article_photo')){
//            $file = $request->file('article_photo');
//            $clientName = $file -> getClientOriginalName();
//            echo "{$clientName}<br>";exit;
//        }
        $this->validate($request, [
            'article_type'=> 'required',
            'title' => 'required|unique:articles|max:255',
            'content' => 'required',
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->article_type = $request->input('article_type');
        $article->user_id = $this->_user->id;//Auth::user()->id;
        $article->author = $this->_user->username;

        if ($article->save()) {
            return Redirect::to('article/index');
        }

            return Redirect::back()->withInput()->withErrors('保存失败！');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $article = Article::find($id);
        $this->assign('article', $article);
        return $this->display('admin.article.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit(Request $request,$id)
    {
        $this->validate($request, [
            'article_type'=> 'required',
            'title' => 'required|unique:articles|max:255',
            'content' => 'required',
        ]);

        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->article_type = $request->input('article_type');
        $article->user_id = $this->_user->id;//Auth::user()->id;
        $article->author = $this->_user->username;

        if ($article->save()) {
            return Redirect::to('article/index');
        }

        return Redirect::back()->withInput()->withErrors('保存失败！');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete(Request $request)
    {
        $article = Article::find($request->input('id'));
        $article->delete();
        $data = array(
            'ret'=>0,
            'msg'=>'删除成功',
        );
        echo json_encode($data);
    }

    public function show($id)
    {
        return view('pages.show')->withPage(Page::find($id));
    }

}