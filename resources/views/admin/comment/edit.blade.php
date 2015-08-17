
@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑评论
        </h1>
        <ol class="breadcrumb">
            <li><a href="/comment/index"><i class="fa fa-dashboard"></i> 评论</a></li>
            <li class="active">编辑评论</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->
            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <form class="form-horizontal" name="editCommentForm" id="editCommentForm" action="/comment/edit/{{$comment->comment_id}}" method="post">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">用户</label>
                            <div class="col-sm-7">
                                <input class="form-control" name="nickname" value="{{ $comment->nickname }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-7">
                                <textarea name="content" class="form-control">{{ $comment->content }}</textarea>
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

