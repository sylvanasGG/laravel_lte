<?php namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use Redirect, Input;
use App\Cores\Core_Article;
use App\Comment;
    class CommentController extends BaseController {

        /**
         * @param $mod
         * @param Request $request
         */
        public function commentSearch($mod,$request)
        {
            $content  = $article_id = $created_at_start = $created_at_end = '';
            if($request->has('content'))
            {
                $content = $request->input('content');
                $mod->where('content','LIKE',"%$content%");
            }

            if($request->has('article_id'))
            {
                $article_id = $request->input('article_id');
                $mod->where('article_id','=',$article_id);
            }

            if($request->has('created_at_start'))
            {
                $created_at_start = $request->input('created_at_start');
                $mod->where('created_at','>=',$created_at_start);
            }

            if($request->has('created_at_end'))
            {
                $created_at_end = $request->input('created_at_end');
                $mod->where('created_at','<=',$created_at_end);
            }

            $this->assign('content', $content);
            $this->assign('article_id', $article_id);
            $this->assign('created_at_start', $created_at_start);
            $this->assign('created_at_end', $created_at_end);
        }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
	{
        $mod = Comment::orderBy('updated_at','desc');
        $this->commentSearch($mod,$request);

        $comments = $mod->paginate(10);

        $this->assign('comments',$comments);
        return $this->display('admin.comment.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        //return view('admin.comments.index')->withComments(Comment::all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if (Comment::create(Input::all())) {
            return Redirect::back();
        } else {
            return Redirect::back()->withInput()->withErrors('评论发表失败！');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $comment_id
	 * @return View
	 */
	public function getEdit($comment_id)
	{
        $comment = Comment::where('comment_id','=', $comment_id)->first();
        $this->assign('comment',$comment);
        return $this->display('admin.comment.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit(Request $request, $id)
	{
        $this->validate($request, [
            'nickname' => 'required',
            'content' => 'required',
        ]);
        if (Comment::where('comment_id', $id)->update(Input::except(['_method', '_token']))) {
            return Redirect::to('comment/index');
        } else {
            return Redirect::back()->withInput()->withErrors('更新失败！');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function getDelete(Request $request)
	{

        if(Comment::where('comment_id','=',$request->input('id'))->delete())
        {
            $data = array(
            'ret'=>0,
            'msg'=>'删除成功',
        );
            echo json_encode($data);
        }
	}

}
