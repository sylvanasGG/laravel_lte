
@extends('admin.app')

@section('content')
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
            <div class="box-header with-border">
                列表
            </div><!-- /.box-header -->
            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <table class="table table-striped">
                    <tr class="row">
                        <th class="col-lg-1">ID</th>
                        <th class="col-lg-2">标题</th>
                        <th class="col-lg-1">作者</th>
                        <th class="col-lg-1">文章类型</th>
                        <th class="col-lg-1">文章图片</th>
                        <th class="col-lg-4">文章内容</th>
                        <th class="col-lg-1">编辑</th>
                        <th class="col-lg-1">删除</th>
                    </tr>
                    @foreach($articles as $article)
                        <tr class="row">
                            <td class="col-lg-1">
                                {{ $article->article_id }}
                            </td>
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
                                {{ str_limit(strip_tags($article->content),50) }}
                            </td>
                            <td class="col-lg-1">
                                <a href="/article/edit/{{ $article->id }}"><i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-original-title="编辑"></i></a>
                            </td>
                            <td class="col-lg-1">
                                <a href="javascript:void(0)" id="del" onclick="del(this)" rel="{{ $article->id }}"><i class="fa fa-fw fa-remove" data-toggle="tooltip" data-original-title="删除"></i></a>
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
@stop

