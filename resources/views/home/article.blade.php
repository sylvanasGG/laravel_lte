
@extends('home.home')

@section('content')

            <article id="" class="post tag-laravel tag-laravel-5-1 tag-xin-ban-ben-fa-bu" style="margin-bottom:20px;">

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
                    <p>{!! $article->content !!}</p>
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



            <div id="comments" style="margin-bottom: 100px;">

                <div class="conmments" >
                    @foreach($article->comment as $comment)
                        <div class="one" style="border-top: solid 5px #49B544; padding: 0px 20px;background-color:#ffffff">
                            <div class="nickname" data="{{$comment->nickname}}">

                                    <h3>{{$comment->nickname}}</h3>
                                <h6>{{$comment->created_at}}</h6>
                            </div>
                            <div class="content">
                                <p style="padding: 20px;">
                                    {{$comment->content}}
                                </p>
                            </div>
                            <div class="reply" style="text-align: right; padding: 5px;">
                                <a href="#new" onclick="reply(this);">回复</a>
                            </div>
                        </div>

                        @endforeach
                </div>

                <div id="new" style="border-top: solid 5px #49B544;margin-top:20px;background-color: #ffffff;padding-bottom: 5px;">
                    <form action="/home/comment/{{$article->article_id}}" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            {{--<label class="col-sm-2 control-label">用户名</label>--}}
                            <div class="col-sm-offset-2 col-sm-9">
                                <input type="text" name="nickname" class="form-control" required="required" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            {{--<label class="col-sm-2 control-label">邮箱地址</label>--}}
                            <div class="col-sm-offset-2 col-sm-9">
                                <input type="email" name="email" class="form-control" placeholder="邮箱地址">
                            </div>
                        </div>

                        <div class="form-group">
                            {{--<label class="col-sm-2 control-label">评论</label>--}}
                            <div class="col-sm-offset-2 col-sm-9">
                                <textarea name="content" id="newFormContent" class="form-control" rows="2" required="required" placeholder="评论"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <button type="submit" class="btn btn-lg btn-success col-lg-12">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>

                <script>
                    function reply(a) {
                        var nickname = a.parentNode.parentNode.firstChild.nextSibling.getAttribute('data');
                        var textArea = document.getElementById('newFormContent');
                        textArea.innerHTML = '@'+nickname+' ';
                    }
                </script>


            </div>
@stop

