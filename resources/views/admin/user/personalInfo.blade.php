
@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1>
            个人资料
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 用户</a></li>
            <li class="active">个人资料</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->

            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <form class="form-horizontal" name="personalUserForm" id="personalUserForm" action="/user/personal-info/{{$user->id}}" method="post">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="username" name="username" placeholder="用户名" value="{{ $user->username }}" minlength="2" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" id="password" name="password" placeholder="不修改则为原密码" minlength="6"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control" id="email" name="email" placeholder="邮箱" value="{{ $user->email }}" required />
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-7">
                                <button type="submit" class="btn btn-info">提交</button>
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

