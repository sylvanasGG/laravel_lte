
@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1>
            用户列表
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 用户</a></li>
            <li class="active">用户编辑</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->
            <div class="box-header with-border">
                修改
            </div><!-- /.box-header -->
            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <form class="form-horizontal" name="registerForm" id="registerForm" action="/user/add" method="post">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="username" name="username" placeholder="用户名" value="" minlength="2" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" id="password" name="password" placeholder="密码" minlength="6" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control" id="email" name="email" placeholder="邮箱" value="" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cp_group_id" class="col-sm-2 control-label">管理组</label>
                            <div class="col-sm-7">
                                <select name="cp_group_id" id="cp_group_id" class="form-control" required>
                                    <option value="">--请选择--</option>
                                    @foreach($groupAll as $group)
                                        <option value="{{ $group->cp_group_id }}">{{ $group->cp_group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-7">
                                <button type="submit" class="btn btn-info">添加用户</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
            <!--内容尾部-->
            <div class="box-footer clearfix">

            </div>
        </div>

    </section><!-- /.content -->
@stop

