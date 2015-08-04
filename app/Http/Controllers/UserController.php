<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $users = User::orderBy('created_at','desc')->get();
        $this->assign('users',$users);
        return $this->display('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function getAdd()
    {
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
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
            'email'    => 'required|email|max:255|unique:users',
            'mobile'   => 'required|min:11|unique:users',
            'cp_group_id' => 'required'
        ]);
        //新增
        User::create([
            'username'  => $request->input('username'),
            'password'  => bcrypt($request->input('password')),
            'email'     => $request->input('email'),
            'mobile'    => $request->input('mobile'),
            'gender'    => $request->input('gender'),
            'cp_group_id' => $request->input('cp_group_id')
        ]);

        return redirect($this->redirectPath())->with($this->statusVar, Lang::get('auth.addUserSuccess'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
