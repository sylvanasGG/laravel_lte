<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Lang;

class VisitorController extends BaseController
{
    
    /**
     * @param $mod
     * @param Request $request
     */
    public function visitorSearch($mod,$request)
    {
        $username  = $email = $phone = '';
        if($request->has('username'))
        {
            $username = $request->input('username');
            $mod->where('username','LIKE',"%$username%");
        }

        if($request->has('email'))
        {
            $email = $request->input('email');
            $mod->where('email','=',$email);
        }

        if($request->has('phone'))
        {
            $phone = $request->input('phone');
            $mod->where('phone','LIKE',"%$phone%");
        }

        
        $this->assign('username', $username);
        $this->assign('email', $email);
        $this->assign('phone', $phone);
    }

    /**
     * Display a listing of the resource.
     *@param Request $request
     * @return Response
     */
    public function getIndex(Request $request)
    {
        $mod = Visitor::orderBy('created_at','desc');
        $this->visitorSearch($mod,$request);
        $visitors = $mod->paginate(15);
        $this->assign('visitors',$visitors);
        return $this->display('admin.visitor.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function getAdd()
    {
        return $this->display('admin.visitor.add');
    }

    /**
     * 动作：增加用户
     *
     * @param Request $request
     * @return View
     */
    public function postAdd(Request $request)
    {
        //验证
        $this->validate($request, [
            'username' => 'required|max:255|unique:visitors',
            'password' => 'required|min:6',
            'email'    => 'required|email|max:255|unique:visitors',
        ]);

        $visitor = new visitor();
        $visitor->username = $request->input('username');
        $visitor->password = bcrypt($request->input('password'));
        $visitor->email = $request->input('email');
        $visitor->phone = $request->input('phone');
        $visitor->save();

        return redirect($this->redirectPath('visitor/index'))->with($this->statusVar, Lang::get('auth.addvisitorSuccess'));

    }


    /**
     * 视图：修改用户信息
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $visitor = visitor::find($id);
        $this->assign('visitor',$visitor);
        return $this->display('admin.visitor.edit');
    }

    /**
     * 动作：修改用户信息
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function postEdit($id,Request $request)
    {
        //验证
        $this->validate($request, [
            'username' => 'required|max:255',
            'password' => 'min:6',
            'email'    => 'required|email|max:255',
        ]);
        $visitor = visitor::find($id);
        $visitor->username = $request->input('username');
        $visitor->email = $request->input('email');
        $visitor->phone = $request->input('phone');
        if($request->has('password'))
        {
            $visitor->password = bcrypt($request->input('password'));
        }
        $visitor->save();

        return redirect($this->redirectPath('visitor/index'))->with($this->statusVar, Lang::get('auth.editvisitorSuccess'));

    }

    /**
     * 动作:删除用户
     *
     * @param $id
     */
    public function getDelete(Request $request)
    {
        $visitor = visitor::find($request->input('id'));
        $visitor->delete();
        $data = array(
            'ret'=>0,
            'msg'=>'删除成功',
        );
        echo json_encode($data);
    }
}
