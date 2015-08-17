
@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1>
            后台首页
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                头部
            </div><!-- /.box-header -->
            <div class="box-body" style="overflow-x: auto;">
                <form action="/perm/groupList" method="post">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <colgroup>
                                <col style="width: 10%" />
                                <col style="width: 20%" />
                                <col  />

                            </colgroup>
                            <thead>
                            <tr>
                                <td><strong>删除</strong></td>
                                <td><strong>职务名称</strong></td>
                                <td><strong>操作</strong></td>
                            </tr>
                            </thead>
                            <tbody id="memberList">
                            @foreach($groupAll as $group)
                                <tr>
                                    <td>
                                        <input name="delete[]" value="{{ $group->cp_group_id }}" class="checkbox" type="checkbox">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input name="name[{{$group->cp_group_id}}]" value="{{ $group->cp_group_name }}" class="form-control">

                                        </div>
                                    </td>
                                    <td><a href="/perm/group/{{$group->cp_group_id}}">编辑</a></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>新增</td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <input name="new_cp_group_name" class="form-control" value="" type="text" placeholder="职务名称">
                                    </div>
                                </td>
                                <td></td>
                            </tr>

                            </tbody>

                            <tfoot>
                            <tr>
                                <td>
                                    <label for="selectAll"><input type="checkbox" id="selectAll" name="slectALL" class="select-all" value="">全选</label>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="pull-left">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="pull-right">
                    尾部
                </div>
            </div>
        </div>

    </section><!-- /.content -->
@stop
    
