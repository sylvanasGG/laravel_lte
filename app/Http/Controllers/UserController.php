<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use App\User;
use App\AdminGroup;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $mod = User::orderBy('created_at','desc');
        $users = $mod->paginate(15);
        $this->assign('users',$users);
        return $this->display('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function getAdd()
    {
        //查询所有职务
        $groupAll = AdminGroup::orderBy('cp_group_id', 'ASC')->get();
        $this->assign('groupAll',$groupAll);
        return $this->display('admin.user.add');
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
            'name' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
            'email'    => 'required|email|max:255|unique:users',
            'cp_group_id' => 'required'
        ]);
        //新增
        User::create([
            'name'  => $request->input('username'),
            'password'  => bcrypt($request->input('password')),
            'email'     => $request->input('email'),
            'cp_group_id' => $request->input('cp_group_id')
        ]);

        return redirect($this->redirectPath())->with($this->statusVar, Lang::get('auth.addUserSuccess'));

    }


    /**
     * 视图：修改用户信息
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $user = User::find($id);
        //查询所有职务
        $groupAll = AdminGroup::orderBy('cp_group_id', 'ASC')->get();
        $this->assign('groupAll',$groupAll);
        $this->assign('user',$user);
        return $this->display('admin.user.edit');
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
            'name' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
            'email'    => 'required|email|max:255|unique:users',
            'mobile'   => 'required|min:11|unique:users',
            'cp_group_id' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->cp_group_id = $request->input('cp_group_id');
        if($request->has('password'))
        {
            $user->password = bcrypt($request->input('password'));
        }
    }
}
