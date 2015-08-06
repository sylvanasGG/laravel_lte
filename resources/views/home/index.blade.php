
@extends('home.home')

@section('content')
    @if(isset($articles))
        @foreach($articles as $article)
        <article id="{$val['id']}" class="post tag-laravel tag-laravel-5-1 tag-xin-ban-ben-fa-bu" style="margin-bottom:20px;">

            <div class="post-head">
                <h1 class="post-title"><a href="">{{$article->title}}</a></h1>
                <div class="post-meta">
                    <span class="author">作者：<a href="#" style="color: #f4645f">{{$article->author}}</a></span> &bull;
                    <time class="post-date"  title="{$val['updated_at']}">{{$article->updated_at}}</time>
                </div>
            </div>
            <div class="featured-media">
                <!--<a href="#"><img src="{$val['article_photo']}" alt="图片" style="height:200px;"></a>-->
            </div>
            <div class="post-content">
                <p>{{ str_limit(strip_tags($article->content),200) }}</p>
            </div>
            <div class="post-permalink">
                <a href="/home/article/{{ $article->article_id }}" class="btn btn-default">阅读全文</a>
            </div>

            <footer class="post-footer clearfix">
                <div class="pull-left tag-list">
                    <i class="fa fa-folder-open-o"></i>
                    <a href="">{{App\Cores\Core_Article::$ARTICLE_TYPE[$article->article_type]}}</a><a href="/tag/laravel-5-1/"></a><a href="/tag/xin-ban-ben-fa-bu/"></a>
                </div>
                <div class="pull-right share">
                </div>
            </footer>
        </article>
        @endforeach
        <div class="col-sm-4 col-sm-offset-8" style="margin-bottom: 20px;">

        </div>
    @else
        <article class="post tag-laravel tag-laravel-5-1 tag-xin-ban-ben-fa-bu">
            <div class="post-head">
                <h1 class="post-title">抱歉，暂时没有相关文章</h1>
            </div>
        </article>
    @endif
    <div class="pull-right" style="margin-bottom: 10px;">
            {!! $articles->render() !!}
        </div>



@stop

