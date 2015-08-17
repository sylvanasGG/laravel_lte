<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\AdminGroup;
use App\AdminAccess;
use App\User;
use Redirect;
use Illuminate\Support\Facades\Lang;
class PermController extends BaseController{

    public function getGroupList()
    {
        //查询所有职务
        $groupAll = AdminGroup::orderBy('cp_group_id', 'ASC')->get();
        $this->assign('groupAll',$groupAll);
        return $this->display('admin.perm.groupList');
    }

    public function postGroupList(Request $request)
    {
        //新增职务
        if($request->has('new_cp_group_name'))
        {
            $new_cp_group_name = $request->input('new_cp_group_name');
            if (in_array($new_cp_group_name, array('系统管理员', '超级管理员')) || AdminGroup::where('cp_group_name', '=', $new_cp_group_name)->first())
            {
                return redirect($this->redirectPath('/user/groups'))->withErrors([Lang::get('access.addNewCpGroupFailed')]);
            }
            $adminGroup = new AdminGroup();
            $adminGroup->cp_group_name = strip_tags($new_cp_group_name);
            $adminGroup->save();
        }
        //更新职务
        if($request->has('name'))
        {
            foreach($request->input('name') as $cp_group_id => $cp_group_name)
            {
                $adminGroup = AdminGroup::find($cp_group_id);
                $adminGroup->cp_group_name = $cp_group_name;
                $adminGroup->save();
            }
        }
        //删除职务
        if($request->has('delete'))
        {
            AdminAccess::destroy($request->input('delete'));
            User::whereIn('cp_group_id', $request->input('delete'))->delete();
            AdminGroup::destroy($request->input('delete'));
        }
        return redirect($this->redirectPath('/user/groups'))->with($this->statusVar, Lang::get('access.updateCpGroupSuccess'));
    }

    /**
     * 视图：团队职务
     *
     * @param $id
     */
    public function getGroup($id)
    {
        //查询所有职务
        $groupAll = AdminGroup::orderBy('cp_group_id', 'ASC')->get();
        //获取该职务信息
        $adminGroup = AdminGroup::find($id);
        //获取菜单权限列表
        $menuList = $this->getMenuList();
        //获取职务权限
        $adminAccessList = AdminAccess::where('cp_group_id', '=', $id)->get();

        $groupAccess = array();
        foreach ($adminAccessList as $adminAccess)
        {
            $groupAccess[] = $adminAccess->access;
        }

        $this->assign('groupAll', $groupAll);
        $this->assign('adminGroup', $adminGroup);
        $this->assign('menuList', $menuList);
        $this->assign('groupAccess', $groupAccess);
        return $this->display('admin.perm.group');
    }

    /**
     * @param $id
     */
    public function postGroup($id,Request $request)
    {
        AdminAccess::where('cp_group_id', '=', $id)->delete();

        if($request->has('access_allow'))
        {
            foreach($request->input('access_allow') as $access)
            {
                $adminAccess = new AdminAccess();
                $adminAccess->cp_group_id = $id;
                $adminAccess->access = $access;
                $adminAccess->save();
            }
        }
        return redirect($this->redirectPath('/perm/group/'.$id))->with($this->statusVar, Lang::get('access.updateGroupPermSuccess'));
    }
}