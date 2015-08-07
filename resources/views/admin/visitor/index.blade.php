
@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1>
            用户列表
            <a href="/visitor/add" class="btn btn-primary btn-sm">添加用户</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 用户</a></li>
            <li class="active">用户列表</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!--内容头部-->
            <div class="box-header">
                <form action="/visitor/index" method="get">
                    <table class="table">
                        <colgroup>
                            <col style="width: 300px;" />
                            <col style="width: 300px;" />
                            <col style="width: 200px;" />
                            <col style="width: 100px;" />
                            <col />
                        </colgroup>
                        <tbody>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">用户名</span>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1" name="username" value="{{ $username }}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">邮箱</span>
                                    <input type="email" class="form-control" aria-describedby="basic-addon1" name="email" value="{{ $email }}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">手机</span>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1" name="phone" value="{{ $phone }}">
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
                        <th class="col-lg-1">ID</th>
                        <th class="col-lg-4">用户名</th>
                        <th class="col-lg-3">email</th>
                        <th class="col-lg-2">手机</th>
                        <th class="col-lg-1">编辑</th>
                        <th class="col-lg-1">删除</th>
                    </tr>
                    @foreach($visitors as $visitor)
                        <tr class="row">
                            <td class="col-lg-1">
                                {{ $visitor->visitor_id }}
                            </td>
                            <td class="col-lg-4">
                                {{ $visitor->username }}
                            </td>
                            <td class="col-lg-3">
                                {{ $visitor->email }}
                            </td>
                            <td class="col-lg-2">
                                {{ $visitor->phone }}
                            </td>
                            <td class="col-lg-1">
                                <a href="/visitor/edit/{{ $visitor->visitor_id }}"><i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-original-title="修改"></i></a>
                            </td>
                            <td class="col-lg-1">
                                <a href="javascript:void(0)" id="del" onclick="del(this)" rel="{{ $visitor->visitor_id }}"><i class="fa fa-fw fa-remove" data-toggle="tooltip" data-original-title="删除"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
            <!--内容尾部-->
            <div class="box-footer clearfix">
                <div class="pull-right">
                    {!! $visitors->render() !!}
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
                url: "/visitor/delete",
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

