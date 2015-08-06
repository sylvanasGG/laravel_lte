<?php namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Redirect, Input;
use App\Comment;
use App\Http\Controllers\BaseController;
class ReleaseController extends BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function postComment(Request $request,$id)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->nickname = $this->_user->username;
        $comment->email = $this->_user->email;
        $comment->article_id = $id;
        $comment->save();
        return Redirect::back();
    }



}
