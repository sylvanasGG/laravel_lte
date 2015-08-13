
@extends('admin.app')

@section('content')
    @include('_layouts.ueditor_admin')
    <script>
        ue.ready(function(){
            var content = $("#contID").val();
            ue.setContent(content);
        })
    </script>
    <section class="content-header">
        <h1>
            文章编辑
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 文章</a></li>
            <li class="active">文章编辑</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->
            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <form class="form-horizontal" name="editArticleForm" id="editArticleForm" action="/article/edit/{{$article->article_id}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">文章类型</label>
                            <div class="col-sm-7">
                                {!! Form::select('article_type', array('' => '--请选择--')+App\Article::$ARTICLE_TYPE, $article->article_type, array('class' => 'form-control', 'id' => 'article_type', 'required' => 'true')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">文章标题</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">文章头部图片</label>
                            <div class="col-sm-7">
                                <input type="file" name="article_photo" /><a href="{{$article->article_photo }}">{{$article->article_photo }}</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cp_group_id" class="col-sm-2 control-label">文章内容</label>
                            <div class="col-sm-7">
                                <script id="editor" name="content" type="text/plain"></script>
                            </div>
                        </div>
                        <textarea hidden="hidden" id="contID" >{{$article->content}}</textarea>
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

