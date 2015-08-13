
@extends('home.home')

@section('content')
    @include('_layouts.ueditor_home')
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
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><strong>评论</strong></a></li>
                     </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="conmments" style="background-color:#ffffff;">
                                <table class="table table-striped">
                                    <colgroup>
                                        <col  />
                                        <col style="width: 10%" />
                                    </colgroup>
                                    {{--<thead>--}}
                                    {{--<tr style="background-color: #49B544">--}}
                                    {{--<th colspan="4" style="text-align: center;color: #ffffff"><h5>评论</h5></th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    <tbody>
                                    @foreach($article->comment as $key=> $comment)
                                        <tr>
                                            <td colspan="2">
                                                <div class="nickname"><strong style="color: #3c8dbc">{{$comment->nickname}}</strong>&nbsp;&nbsp;&nbsp;{{$comment->created_at}}&nbsp;&nbsp;&nbsp;{{$key+1}}楼</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="word-break:break-all">{{$comment->content}}</td>
                                            <td><a href="#new" onclick="reply(this);" data-name="{{ $comment->nickname }}" style="color: #3c8dbc">回复</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>



                <div id="new" style="border-top: solid 5px #49B544;margin-top:20px;background-color: #ffffff;padding-bottom: 5px;padding-top: 5px;">
                    <form action="/release/comment/{{$article->article_id}}" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}


                        <div class="form-group">
                            {{--<label class="col-sm-2 control-label">评论</label>--}}
                            <div class="col-sm-offset-1 col-sm-10">
                                {{--<textarea name="content" id="newFormContent" class="form-control" rows="4" required="required" placeholder="评论"></textarea>--}}
                                <script id="editor" name="content" type="text/plain"></script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-10">
                                <button type="submit" class="btn btn-lg btn-success col-lg-12">发表</button>
                            </div>
                        </div>

                    </form>
                    <div style="text-align: center">
                        {{--<span ><a href="/auth/login" style="color: #3c8dbc">登录</a></span>/<a href="/home/register" style="color: #3c8dbc">注册</a><br>--}}
                        <!-- Button trigger modal -->
                        {{--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">--}}
                            {{--注册--}}
                        {{--</button>--}}
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">登录/注册</a>
                        <!-- 弹出框 -->
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="border-bottom:0px;">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{--<h4 class="modal-title" id="myModalLabel">Modal title</h4>--}}
                                    </div>
                                    <div class="modal-body">
                                        <!--标签页登录/注册-->
                                        <div>

                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs  nav-justified" role="tablist">
                                                <li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">登录</a></li>
                                                <li role="presentation" ><a href="#register" aria-controls="register" role="tab" data-toggle="tab">注册</a></li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="login">
                                                    <!--登录表单-->
                                                    <div style="margin-top: 10px;">
                                                    <form class="form-horizontal" id="loginForm" action="/home/login" method="post">
                                                        {!! csrf_field() !!}
                                                        <div class="form-group">
                                                            <label for="login_username" class="col-sm-2 control-label">用户名</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="login_username" name="username" placeholder="adCarry" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="login_password" class="col-sm-2 control-label">Password</label>
                                                            <div class="col-sm-10">
                                                                <input type="password" class="form-control" id="login_password" name="password" placeholder="Password" required min="6">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <button type="submit" class="btn btn-primary">登录</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                        </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="register">
                                                    <!--注册表单-->
                                                    <div style="margin-top: 10px;">
                                                    <form class="form-horizontal" action="/home/register" method="post" id="registerForm">
                                                        {!! csrf_field() !!}
                                                        <div class="form-group">
                                                            <label for="register_username" class="col-sm-2 control-label">用户名</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="register_username" name="username" placeholder="adCarry" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="login_password" class="col-sm-2 control-label">Password</label>
                                                            <div class="col-sm-10">
                                                                <input type="password" class="form-control" id="register_password" name="password" placeholder="Password"  minlength="6" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="register_email" class="col-sm-2 control-label">邮箱</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" name="email" id="register_email"  placeholder="123@qq.com" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="register_phone" class="col-sm-2 control-label">手机号</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="phone" id="register_phone"  placeholder="138...">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <button type="submit" class="btn btn-primary">注册</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {{--<div class="modal-footer">--}}
                                        {{--<button type="button" class="btn btn-primary">提交</button>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function reply(a) {
                        var obj = $(a);
                        var nickname = obj.attr('data-name');
                        var teatArea = $("#editor");
                        teatArea.val('@'+nickname+' ');
                    }

                    function submitRegister()
                    {

                    }
                </script>


            </div>
@stop

