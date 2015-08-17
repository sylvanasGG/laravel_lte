
@extends('admin.app')

@section('content')
<script src="{{ asset ("/asset/js/My97DatePicker/WdatePicker.js") }}"></script>
    <section class="content-header">
        <h1>
            文章列表
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 文章</a></li>
            <li class="active">文章列表</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->
            <div class="box-header">
                <form action="/article/index" method="get">
                    <table class="table">
                        <colgroup>
                            <col style="width: 300px" />
                            <col style="width: 250px;" />
                            <col style="width: 200px;" />
                            <col />
                            <col style="width: 100px;"/>
                        </colgroup>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">标题</span>
                                        <input type="text" class="form-control"  aria-describedby="basic-addon1" name="title" value="{{$title}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">作者</span>
                                        <input type="text" class="form-control" aria-describedby="basic-addon1" name="author" value="{{$author}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">类型</span>
                                        {!! Form::select('article_type', array('' => '--请选择--')+App\Article::$ARTICLE_TYPE, $article_type, array('class' => 'form-control', 'id' => 'article_type')) !!}
                                    </div>
                                </td>
                                <td>
                                <div class="input-group">
                                    <span class="input-group-addon">最后更新时间</span>
                                    <input type="text" class="form-control" name="update_at_start" value="{{ $update_at_start }}" onfocus="WdatePicker({startDate:'%y-%M-%d 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})" >
                                    <span class="input-group-addon">至</span>
                                    <input type="text" class="form-control" name="update_at_end" value="{{ $update_at_end }}" onfocus="WdatePicker({startDate:'%y-%M-%d 23:59:59',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})" >
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
                        <th class="col-lg-2">标题</th>
                        <th class="col-lg-1">作者</th>
                        <th class="col-lg-1">文章类型</th>
                        <th class="col-lg-1">文章图片</th>
                        <th class="col-lg-4">文章内容</th>
                        <th class="col-lg-2">最后更新时间</th>
                        <th class="col-lg-1" style="text-align:center">编辑 | 删除</th>
                    </tr>
                    @foreach($articles as $article)
                        <tr class="row">
                            <td class="col-lg-2">
                                <span data-toggle="tooltip" data-original-title="{{ $article->title }}">{{ str_limit($article->title,10) }}</span>
                            </td>
                            <td class="col-lg-1">
                                {{ $article->author }}
                            </td>
                            <td class="col-lg-1">
                                {{ App\Cores\Core_Article::$ARTICLE_TYPE[$article->article_type] }}
                            </td>
                            <td class="col-lg-1">
                                <a href="{{ $article->article_photo }}">图片</a>
                            </td>
                            <td class="col-lg-4">
                                <a href="/home/article/{{ $article->article_id }}" target="_blank">{{ str_limit(strip_tags($article->content),50) }}</a>
                            </td>
                            <td class="col-lg-2">
                                {{ $article->updated_at }}
                            </td>
                            <td class="col-lg-1" style="text-align:center">
                                <a href="/article/edit/{{ $article->article_id }}"><i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-original-title="编辑"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" id="del" onclick="del(this)" rel="{{ $article->article_id }}"><i class="fa fa-fw fa-remove" data-toggle="tooltip" data-original-title="删除"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
            <!--内容尾部-->
            <div class="box-footer clearfix">
                <div class="pull-right">
                    {!! $articles->render() !!}
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
                url: "/article/delete",
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

