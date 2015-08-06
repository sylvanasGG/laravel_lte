<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>FIRSTBLOOD</title>
    <meta name="description" content="Laravel是一套简洁、优雅的PHP Web开发框架(PHP Web Framework) -- Laravel中文网" />
    <meta name="keywords" content="Laravel中文社区,php框架,laravel中文网,php framework,restful routing,laravel,laravel php">
    <!-- Bootstrap -->
    <link href="{{ asset("/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/asset/css/index.css") }}" rel="stylesheet" type="text/css" />
    <link href="https://res.wx.qq.com/mpres/htmledition/images/favicon218877.ico" rel="Shortcut Icon">
    <!--     <load href="__PUBLIC__/css/page.css" / >
     -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        a,a:hover{ text-decoration:none; color:#000000}
        ul li{
            list-style-type: none;
        }
        .nav-list{
            padding:4px 0;
            margin:0;
        }
        .nav-list li{
            display: inline-block;
            margin-right: 20px;
        }
    </style>
</head>
<body style="background-image: url('{{ asset("/asset/img/1.jpg") }}')">
<!--header start-->
<header class="container-fluid" style="margin-bottom: 0;padding-top: 10px;padding-bottom: 50px;">
    <div class="row">
        <!--标头-->
        <div class="col-sm-12" style="text-align: center">

            <h1 style="color: white"><span class="hide">Laravel - </span>FIRSTBLOOD</h1>
        </div>
        <div class="col-sm-12" style="text-align: center">
            <!--<a href="http://lol.qq.com/main.shtml" class="btn btn-default btn-doc" target="_blank">英雄联盟</a>-->
            <!--<a href="http://www.5eplay.com/game/cs" class="btn btn-default btn-doc" target="_blank">CS:GO</a>-->
            <!--<a href="http://www.pconline.com.cn/" class="btn btn-default btn-doc" target="_blank">数码科技</a>-->
            <!--&lt;!&ndash;<a href="http://www.golaravel.com/laravel/docs/4.1/" class="btn btn-default btn-doc" target="_blank">4.1 中文文档</a>&ndash;&gt;-->
            <!--&lt;!&ndash;<a href="http://www.golaravel.com/laravel/docs/4.0/" class="btn btn-default btn-doc" target="_blank">4.0 中文文档</a>&ndash;&gt;-->
            <!--<a href="http://www.golaravel.com/laravel/docs/" class="btn btn-default btn-doc" target="_blank">laravel文档</a>-->
            <!--<a href="http://v3.bootcss.com/" class="btn btn-default btn-doc" target="_blank">bootstrap文档</a>-->
        </div>
    </div>
</header>
<!--header end-->

<!-- start navigation -->
@include('home.header')
<!-- end navigation -->

<!--main content-->
<section class="content-wrap">
    <div class="container-fluid">
        <div class="row" >
            <main class="col-md-7 col-md-offset-1 main-content" style="margin-top:20px;">
                @yield('content')

            </main>
            <!--main right-->
            @include('home.rightMenu')
        </div><!--end row-->
    </div>
</section>
<!--end main content-->
@include('home.footer')

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span>Copyright &copy; <a href="http://www.golaravel.com/">FIRSTBLOOD</a></span> |
                <span><a href="http://www.miibeian.gov.cn/" target="_blank">京ICP备11008151号</a></span> |
                <span>京公网安备11010802014853</span>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset ("/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
<script src="{{ asset ("/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!--<script src="public/js/index.js"></script>-->
<script>
    $(function(){
        $(".main-right-content .post-content p a").addClass("btn btn-default btn-sm");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
</script>
</body>
</html>

