<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect, Input;

use App\Comment;
    class CommentController extends BaseController {

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $mod = Comment::orderBy('updated_at','desc');
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
