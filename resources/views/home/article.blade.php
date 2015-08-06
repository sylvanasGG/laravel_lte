
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

                <div class="conmments" style="background-color:#ffffff;">
                    <table class="table table-striped">
                        <colgroup>
                            <col style="width: 10%" />
                            <col style="width: 20%" />
                            <col  />
                            <col style="width: 10%" />
                        </colgroup>
                        {{--<thead>--}}
                            {{--<tr style="background-color: #49B544">--}}
                                {{--<th colspan="4" style="text-align: center;color: #ffffff"><h5>评论</h5></th>--}}
                            {{--</tr>--}}
                        {{--</thead>--}}
                       <tbody>
                       @foreach($article->comment as $comment)
                        <tr>
                            <td><div class="nickname" data="{{$comment['nickname']}}"><strong>{{$comment->nickname}}</strong></div></td>
                            <td>{{$comment->created_at}}</td>
                            <td style="word-break:break-all">{{$comment->content}}</td>
                            <td><a href="#new" onclick="reply(this);">回复</a></td>
                        </tr>
                           @endforeach
                       </tbody>
                    </table>

                </div>

                <div id="new" style="border-top: solid 5px #49B544;margin-top:20px;background-color: #ffffff;padding-bottom: 5px;padding-top: 5px;">
                    <form action="/release/comment/{{$article->article_id}}" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}


                        <div class="form-group">
                            {{--<label class="col-sm-2 control-label">评论</label>--}}
                            <div class="col-sm-offset-2 col-sm-9">
                                <textarea name="content" id="newFormContent" class="form-control" rows="4" required="required" placeholder="评论"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <button type="submit" class="btn btn-lg btn-success col-lg-12">发表</button>
                            </div>
                        </div>

                    </form>
                    <div style="text-align: center">
                        <span ><a href="/auth/login" style="color: #3c8dbc">登录</a></span>/<a href="/home/register" style="color: #3c8dbc">注册</a><br>
                    </div>
                </div>

                <script>
                    function reply(a) {
                        var obj = $(a);
                        var nickname = obj.parent().parent().find(".nickname").attr('data');
                        var teatArea = $("#newFormContent");
                        teatArea.val('@'+nickname+' ');
                    }
                </script>


            </div>
@stop

