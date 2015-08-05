
@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1>
            添加文章
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 文章</a></li>
            <li class="active">添加文章</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->
            <div class="box-header with-border">
                添加
            </div><!-- /.box-header -->
            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <form class="form-horizontal" name="registerForm" id="registerForm" action="/user/add" method="post">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">文章类型</label>
                            <div class="col-sm-7">
                                {{--{!! Form::select('article_type', array('' => '--请选择--')+App\Article::$ARTICLE_TYPE, '', array('class' => 'form-control', 'id' => 'article_type', 'required' => 'true')) !!}--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">文章标题</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" id="password" name="password" placeholder="密码" minlength="6" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">文章头部图片</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control" id="email" name="email" placeholder="邮箱" value="" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cp_group_id" class="col-sm-2 control-label">文章内容</label>
                            <div class="col-sm-7">

                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-7">
                                <button type="submit" class="btn btn-info">添加</button>
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

