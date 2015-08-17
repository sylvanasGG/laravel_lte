
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
                <div class="row">
                    <div class="col-xs-4">
                        <div class="input-group input-group-sm">
                            <p>职务：<span>(设置当前管理团队成员的职务)</span></p>
                            <select name="gid" id="_gid" class="form-control">
                                @foreach ($groupAll as $group)
                                    <option value="{{ $group->cp_group_id }}" @if ($group->cp_group_id == $adminGroup->cp_group_id) selected="selected" @endif>{{ $group->cp_group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <form action="/perm/group/{{$adminGroup->cp_group_id}}" method="post">
                {!! csrf_field() !!}
                <div class="box-body">

                    <table class="table table-bordered">

                        <tbody id="menuList">
                        @foreach($menuList as $key=>$val)
                            <tr style="background-color:#eaf3fa">
                                <td>
                                    <div class="checkbox" style="margin: 0">
                                        <label><input type="checkbox" value="" onclick="PermCheckAll(this, 'access_{{ $key }}')">{{ $val['treeView']['name'] }}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td id="access_{{ $key }}">
                                    <div class="row">
                                        @foreach($val['treeViewMenu'] as $item)
                                            @if($item['name'] != '个人资料')
                                                <div class="col-sm-2" style="border-right: 1px solid #808080">
                                                    <div class="checkbox" style="margin: 0">
                                                        <label>

                                                            <input type="checkbox" value="{{$item['actionName']}}" name="access_allow[]" @if (in_array($item['actionName'], $groupAccess)) checked @endif>{{ $item['name'] }}

                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                        <tfoot>

                        </tfoot>
                    </table>

                </div>
                <div class="box-footer clearfix">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>

    </section><!-- /.content -->
    <script>
        $(function(){
            $("#_gid").change( function() {
                location.href = "/perm/group/" + $(this).val();
            });
        });
        /**
         * 权限全选
         */
        function PermCheckAll(obj, perms, t) {
            var t = !t ? 0 : t;
            var checkboxs = $("#"+perms).find(":checkbox");
            for(var i = 0; i < checkboxs.length; i++) {
                var e = checkboxs[i];
                if(e.type == 'checkbox') {
                    if(!t) {
                        if(!e.disabled) {
                            e.checked = obj.checked;
                        }
                    } else {
                        if(obj != e) {
                            e.style.visibility = obj.checked ? 'hidden' : 'visible';
                        }
                    }
                }
            }
        }
    </script>
@stop

