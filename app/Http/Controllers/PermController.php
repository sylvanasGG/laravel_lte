<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Request;
use App\AdminGroup;
use App\AdminAccess;
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
            $new_cp_group_name = $request->has('new_cp_group_name');
            if (in_array($new_cp_group_name, array('系统管理员')) || AdminGroup::where('cp_group_name',$new_cp_group_name)->first())
            {
                $this->redirect('Perm/showGroupsList', '', 2, '该团队职务已经存在...');
            }
            $data['cp_group_name'] = strip_tags($new_cp_group_name);
            AdminGroup::create($data);
        }
        //更新职务
        if($request->has('name'))
        {
            foreach($request->input('name') as $cp_group_id => $cp_group_name)
            {
                $adminGroup =  AdminGroup::find($cp_group_id);
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
        return redirect($this->redirectPath())->with($this->statusVar, '更新团队职务成功');
    }

    /**
     * 视图：团队职务
     *
     * @param $id
     */
    public function getGroup($id)
    {
        $menuList = $this->getMenuList();
        $groupAll  = AdminGroup::orderBy('cp_group_id','asc')->get();
        //获取职务权限
        $adminAccessList = AdminAccess::where('cp_group_id','=',$id)->get();
        $groupAccess = array();
        foreach ($adminAccessList as $adminAccess)
        {
            $groupAccess[] = $adminAccess->access;
        }
        $this->assign('groupAll',$groupAll);
        $this->assign('menuList',$menuList);
        $this->assign('id',$id);
        $this->assign('groupAccess', $groupAccess);
        return $this->display('admin.perm.group');
    }

    /**
     * @param $id
     */
    public function postGroup($id)
    {
        $adminAccess = new AdminAccess();
        $adminAccess->where('cp_group_id='.$id)->delete();

        if(!empty($_POST['perm_allow']))
        {
            $perm_allow = $_POST['perm_allow'];
            foreach($perm_allow as $access)
            {
                $adminAccess = new AdminAccess();
                $data['cp_group_id'] = $id;
                $data['access'] = $access;
                $data['created_at'] = date('Y-m-d H:i:s',time());
                $data['updated_at'] = date('Y-m-d H:i:s',time());
                $adminAccess->add($data);
            }
        }
        $this->success('保存成功');
    }
}