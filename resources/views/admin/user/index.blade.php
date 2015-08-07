
@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1>
            管理员列表
            <a href="/user/add" class="btn btn-primary btn-sm">添加管理员</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 管理员</a></li>
            <li class="active">管理员列表</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->
            <div class="box-header">
                <form action="/user/index" method="get">
                    <table class="table">
                        <colgroup>
                            <col style="width: 300px;" />
                            <col style="width: 300px;" />
                            <col style="width: 100px;" />
                            <col />
                        </colgroup>
                        <tbody>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">姓名</span>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1" name="username" value="{{ $username }}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">管理组</span>
                                    {!! Form::select('cp_group_id', array('' => '--请选择--')+App\Cores\Core_User::$CP_GROUP, $cp_group_id, array('class' => 'form-control', 'id' => 'cp_group_id')) !!}
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <button class="btn btn-primary" type="submit">搜索</button>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <table class="table table-striped">
                    <tr class="row">
                        <th class="col-lg-1">ID</th>
                        <th class="col-lg-2">姓名</th>
                        <th class="col-lg-4">email</th>
                        <th class="col-lg-2">管理组</th>
                        <th class="col-lg-1">编辑</th>
                        <th class="col-lg-1">权限分配</th>
                        <th class="col-lg-1">删除</th>
                    </tr>
                    @foreach($users as $user)
                        <tr class="row">
                            <td class="col-lg-1">
                                {{ $user->id }}
                            </td>
                            <td class="col-lg-2">
                                {{ $user->username }}
                            </td>
                            <td class="col-lg-4">
                                {{ $user->email }}
                            </td>
                            <td class="col-lg-2">
                                {{ $user->adminGroup->cp_group_name }}
                            </td>
                            <td class="col-lg-1">
                                <a href="/user/edit/{{ $user->id }}"><i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-original-title="修改"></i></a>
                            </td>
                            <td class="col-lg-1">
                                <a href=""><i class="fa fa-fw fa-cogs" data-toggle="tooltip" data-original-title="权限分配"></i></a>
                            </td>
                            <td class="col-lg-1">
                                <a href="javascript:void(0)" id="del" onclick="del(this)" rel="{{ $user->id }}"><i class="fa fa-fw fa-remove" data-toggle="tooltip" data-original-title="删除"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
            <!--内容尾部-->
            <div class="box-footer clearfix">
                <div class="pull-right">
                    {!! $users->render() !!}
                </div>
            </div>
        </div>

    </section><!-- /.content -->
    <script>
        function del(e)
        {
            if(!confirm('确定要删除吗？'))
            {
                return false;
            }
            var obj = $(e);
            var id = obj.attr("rel");
            $.ajax({
                url: "/user/delete",
                type: "get",
                data: {"id":id},
                dataType: "json",
                success: function( result ){
                    if ( result.ret == 0 ) {
                        obj.parent().parent().remove();
                        alert(result.msg);
                    }
                }
            });
        }
    </script>
@stop

