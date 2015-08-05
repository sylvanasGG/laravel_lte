
@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1>
            评论列表
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 评论</a></li>
            <li class="active">评论列表</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->
            <div class="box-header with-border">
                列表
            </div><!-- /.box-header -->
            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <table class="table table-striped">
                    <tr class="row">
                        <th class="col-lg-4">内容</th>
                        <th class="col-lg-1">用户</th>
                        <th class="col-lg-2">评论文章</th>
                        <th class="col-lg-2">邮箱</th>
                        <th class="col-lg-1">编辑</th>
                        <th class="col-lg-1">删除</th>
                    </tr>
                    @foreach($comments as $comment)
                        <tr class="row">
                            <td class="col-lg-1">
                                <span data-toggle="tooltip" data-original-title="{{ $comment->content }}">{{ str_limit($comment->content,50) }}</span>
                            </td>
                            <td class="col-lg-2">
                                {{ $comment->nickname }}
                            </td>
                            <td class="col-lg-1">
                                <a href="###"><span data-toggle="tooltip" data-original-title="{{ $comment->article->title }}">{{ str_limit($comment->article->title,10) }}</span></a>
                            </td>
                            <td class="col-lg-1">
                                {{ $comment->email }}
                            </td>
                            <td class="col-lg-1">
                                <a href="/comment/edit/{{ $comment->comment_id }}"><i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-original-title="编辑"></i></a>
                            </td>
                            <td class="col-lg-1">
                                <a href="javascript:void(0)" id="del" onclick="del(this)" rel="{{ $comment->id }}"><i class="fa fa-fw fa-remove" data-toggle="tooltip" data-original-title="删除"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
            <!--内容尾部-->
            <div class="box-footer clearfix">
                <div class="pull-right">
                    {!! $comments->render() !!}
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
                url: "/comment/delete",
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

