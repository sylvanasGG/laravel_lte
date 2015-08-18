
@extends('admin.app')

@section('content')
<script src="{{ asset ("/asset/layer/layer.js") }}"></script>
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
            <div class="box-header">
                <h4 class="main-title" style="border: none; background: #ffffff;">
                    <div style="float: right;">
                        <button type="button" class="btn btn-primary btn-xs" onclick="alertAddForm()">
                            <span class="glyphicon glyphicon-plus">添加联系记录</span>
                        </button>
                    </div>
                </h4>
            </div>
            <!--内容主体-->
            <div class="box-body" style="overflow-x: auto;">
                <div class="table-responsive" >
                    <form name="contactform" method="post"  id="contactform">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <table class="table table-bordered table-hover" style="margin: 0;padding: 0;" cellpadding="0" cellspacing="0">
                            <colgroup>
                                <col style="width: 50px;"/>
                                <col style="width: 160px;"/>
                                <col style="width: 400px;"/>
                                <col style="width: 80px;"/>
                                <col style="width: 190px;" span="2" />
                                <col style="width: 110px;"/>
                                <col style="width: 110px;" />
                                <col />
                            </colgroup>
                            <thead class="td-title-bg">
                            <tr style="background-color: #ffffff;">
                                <td>删除</td>
                                <td>联系时间</td>
                                <td>内容</td>
                                <td>类型</td>
                                <td>联系人</td>
                                <td>联系电话</td>
                                <td>下次联系</td>
                                <td>操作员</td>
                                <td>操作</td>
                            </tr>
                            </thead>
                        </table>
                        <div style="margin-top: 0;padding: 0;overflow-y:auto; overflow-x:hidden;max-height: 500px;">
                            <table class="table table-bordered table-hover" style="margin: 0;padding: 0;" cellpadding="0" cellspacing="0" id="addContactTr">
                                <colgroup>
                                    <col style="width: 50px;"/>
                                    <col style="width: 160px;"/>
                                    <col style="width: 400px;"/>
                                    <col style="width: 80px;"/>
                                    <col style="width: 190px;" span="2" />
                                    <col style="width: 110px;"/>
                                    <col style="width: 110px;" />
                                    <col />
                                </colgroup>

                                <tbody id="contactRecordList">
                                @if (count($contacts) > 0)
                                    @foreach ($contacts as $contactRecord)
                                        <tr class="hover">
                                            <td>
                                                <input type="checkbox" class="checkbox" name="deleteids[]" value="{{ $contactRecord->id }}" />
                                            </td>
                                            <td><span name="contact_time">{{ $contactRecord->contact_time }}</span></td>
                                            <td style="word-break:break-all;"><span name="content">{{ $contactRecord->content }}</span></td>
                                            <td><span name="contact_type">{{ \App\Contact::$CONTACT_TYPE[$contactRecord->contact_type] }}</span></td>
                                            <td><span name="contact_man">{{ $contactRecord->contact_man }}</span></td>
                                            <td><span name="contact_phone">{{ $contactRecord->contact_phone }}</span></td>
                                            <td><span name="contact_on">{{ \App\Contact::$CONTACT_ON[$contactRecord->contact_on] }}</span></td>
                                            <td><span name="username">{{ $contactRecord->username }}</span></td>
                                            <td>
                                                <a href="#" class="record-icon" data="{{ $contactRecord->id }}"  data-time="{{ $contactRecord->contact_time }}" data-content="{{ $contactRecord->content }}" data-lineType="{{ $contactRecord->contact_type }}" data-contact_man="{{ $contactRecord->contact_man }}" data-contact_phone="{{ $contactRecord->contact_phone }}" data-nextLine="{{ $contactRecord->contact_on }}" data-username="{{ $contactRecord->username }}" onclick="alertEditForm(this)">编辑</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <table class="table table-bordered table-hover" style="margin-top: 0;">
                                <tfoot>
                                <tr>
                                    <td colspan="10" style="text-align: center;">
                                        <div class="btn-group-sm"><button type="button" id="concactsubmit"  class="btn btn-primary">删除</button></div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                    </form>
                </div>
            </div><!-- /.box-body -->
            <!--内容尾部-->
            <div class="box-footer clearfix">
                <div class="pull-right">
                </div>
            </div>
        </div>

    </section><!-- /.content -->
<script>
    function alertAddForm()
    {
        var content1 = '<form action="" method="post" id="alertForm2" >'+

                '<input type="hidden" name="_token" value="{{ csrf_token() }}" />'+
                '<div class="modal-body">'+
                '<div class="float-info input-group-sm">'+
                '<label for="contact_time">联系时间 <b style="color:red">*</b>：</label>'+
                '<input type="text" name="contact_time" id="contact_time" class="contact_time form-control pop-w9 datebox" onfocus="WdatePicker({dateFmt:\'yyyy-MM-dd HH:mm:ss\',alwaysUseStartDate:true})"  value="" style="width: 200px;"><span id="contact_time_textErr" class="hidden a-error"></span>'+
                '</div>'+
                '<div class="float-info">'+
                '<label for="contact_type" >联系类型：</label>'+
                '<label><input checked="checked" name="contact_type" type="radio" value="1">打进</label>'+
                '<label><input name="contact_type" type="radio" value="0">打出</label>'+
                '</div>'+
                '<div class="float-info input-group-sm">'+
                '<label for="contact_man">联系人 <b style="color:red">*</b>：</label>'+
                '<input type="text" name="contact_man" id="contact_man" class="contact_man form-control pop-w9"  value="" style="width: 200px;">'+
                '</div>'+
                '<div class="float-info input-group-sm">'+
                '<label for="contact_phone">联系电话 <b style="color:red">*</b>：</label>'+
                '<input type="text" name="contact_phone" id="contact_phone" class="contact_phone form-control pop-w9"  value="" style="width: 200px;">'+
                '</div>'+
                '<div class="float-info input-group-sm">'+
                '<label for="content">内容 <b style="color:red">*</b>：</label>'+
                '<textarea rows="3" cols="3" name="content" id="content" class="content form-control" style="min-height:100px;"></textarea>'+
                '</div>'+
                '<div class="float-info input-group-sm">'+
                '<label for="contact_type">下次联系：</label>'+
                '<label><input checked="checked" name="contact_on" type="radio" value="1">是</label>'+
                '<label><input checked="checked" name="contact_on" type="radio" value="0">否</label>'+
                '</div>'+
                '</div>'+
                '<div class="modal-footer" style="padding: 10px 15px">'+
                '<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="layer.closeAll();">取消</button>'+
                '   '+
                '<button type="button" class="btn btn-primary btn-sm" name="contactSubmit" id="submitC" onclick="submitAddContact(this)">确定</button>'+
                '</div>'+
                '</form>';
        layer.open({
            type: 1,
            shade: false, //不显示遮罩
            maxmin:true,
            title:'添加联系记录',
            skin: 'layer-ext-moon', //加上边框
            area: ['550px', '460px'], //宽高
            content: content1
        });
    }

    /**
     * 编辑联系记录
     */
    function alertEditForm(e)
    {
        editNowTr = $(e).parent().parent();
        var data = $(e).attr('data');
        var contact_time = $(e).attr('data-time');
        var telephone = $(e).attr('data-telephone');
        var contact_man = $(e).attr('data-contact_man');
        var contact_phone = $(e).attr('data-contact_phone');
        var content = $(e).attr('data-content');
        var lineType = $(e).attr('data-lineType');
        var nextLine = $(e).attr('data-nextLine');
        var content2 = '<form action="" method="post" id="editForm" >'+

                '<input type="hidden" name="_token" value="{{ csrf_token() }}" />'+
                '<div class="modal-body">'+
                '<div class="float-info input-group-sm">'+
                '<label for="contact_time">联系时间 <b style="color:red">*</b>：</label>'+
                '<input type="text" name="contact_time" id="contact_time" class="contact_time form-control pop-w9 datebox" value="'+contact_time+'" onfocus="WdatePicker({dateFmt:\'yyyy-MM-dd HH:mm:ss\',alwaysUseStartDate:true})"  style="width: 200px;"><span id="contact_time_textErr" class="hidden a-error"></span>'+
                '</div>'+
                '<div class="float-info">'+
                '<label for="contact_type" >联系类型：</label>'+
                '<label><input checked="checked" name="contact_type" type="radio" value="1">打进</label>'+
                '<label><input name="contact_type" type="radio" value="0">打出</label>'+
                '</div>'+
                '<div class="float-info input-group-sm">'+
                '<label for="contact_man">联系人 <b style="color:red">*</b>：</label>'+
                '<input type="text" name="contact_man" id="contact_man" class="contact_man form-control pop-w9" value="'+contact_man+'" style="width: 200px;"><span id="contact_man_textErr" class="hidden a-error" ></span>'+
                '</div>'+
                '<div class="float-info input-group-sm">'+
                '<label for="contact_phone">联系电话 <b style="color:red">*</b>：</label>'+
                '<input type="text" name="contact_phone" id="contact_phone" class="contact_phone form-control pop-w9" value="'+contact_phone+'"  value="" style="width: 200px;"><span id="contact_phone_textErr" class="hidden a-error"></span>'+
                '</div>'+
                '<div class="float-info input-group-sm">'+
                '<label for="content">内容 <b style="color:red">*</b>：</label>'+
                '<textarea name="content" id="content" class="content form-control"  style="min-height:100px;" value="'+content+'">'+content+'</textarea><span id="content_textErr" class="hidden a-error"></span>'+
                '</div>'+
                '<div class="float-info input-group-sm">'+
                '<label for="contact_type">下次联系：</label>'+
                '<label><input checked="checked" name="contact_on" type="radio" value="1">是</label>'+
                '<label><input checked="checked" name="contact_on" type="radio" value="0">否</label>'+
                '</div>'+
                '</div>'+
                '<div class="modal-footer" style="padding: 10px 15px">'+
                '<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="layer.closeAll();">取消</button>'+
                '   '+
                '<button type="button" class="btn btn-primary btn-sm" name="contactSubmit" id="submitC" data-url="/orders/editContactRecord/'+data+'" onclick="submitEditContact(this)">确定</button>'+
                '</div>'+
                '</form>';
        layer.open({
            type: 1,
            shade: false, //不显示遮罩
            title:'编辑联系记录',
            skin: 'layer-ext-moon', //加上边框
            area: ['550px', '460px'], //宽高
            content: content2
        });
        //设置值
        $("#editForm input[name=contact_type][value="+lineType+"]").attr("checked", true);
        $("#editForm input[name=contact_on][value="+nextLine+"]").attr("checked", true);
    }

    /**
     * 删除联系记录
     */
    $('#concactsubmit').click(deleteContact);
    function deleteContact( e ) {
        e.preventDefault();
        var target = $( e.target );
        var div = $(this).parent().parent().parent().parent().parent().prev();
        var checkbox = div.find("input:checked");
        tinyLoading.show( target );
        $.ajax({
            url: "/orders/deleteContactRecord",
            type: "POST",
            data: $("#contactform").serializeArray(),
            dataType: "json",
            success: function( result ){
                tinyLoading.hide( target );
                if ( result.ret == 0 ) {
                    resultMsg({ target: target, msg: result.msg });
                    checkbox.parent().parent().remove();
                } else {
                    resultMsg({ target: target, msg: result.msg });
                }
            }
        });
    }

    //添加
    function submitAddContact(e)
    {
        $.ajax({
            url: "/orders/addContactRecord",
            type: "POST",
            data: $("#alertForm2").serializeArray(),
            dataType: "json",
            success: function( result ){
                //tinyLoading.hide( target );
                if ( result.ret == 0 ) {
                    //resultMsg({ target: target, msg: result.msg });
                    $('#myModal').modal('hide');
                    var lineType = result.data.contact_type == 0 ? "打入":"打出";
                    var nextLine = result.data.contact_on  == 0 ? "否": "是" ;
                    var contactTr = [
                        [
                            [1,'<input type="checkbox" class="checkbox" name="deleteids[]" value='+result.data.id+' />']
                            , [1, '<span name="contact_time">'+result.data.contact_time+'</span>']
                            , [1,'<span name="content">'+result.data.content+'</span>']
                            , [1,'<span name="telephone">'+result.data.telephone+'</span>']
                            , [1,'<span name="contact_type">'+lineType+'</span>']
                            , [1,'<span name="contact_man">'+result.data.contact_man+'</span>']
                            , [1,'<span name="contact_phone">'+result.data.contact_phone+'</span>']
                            , [1,'<span name="contact_on">'+nextLine+'</span>']
                            , [1,'<span name="username">'+result.data.username+'</span>']
                            , [1,'<a href="#" class="record-icon" onclick="alertEditForm(this)" data="'+result.data.id+'" data-time="'+result.data.contact_time+'" data-content="'+result.data.content+'"  data-telephone="'+result.data.telephone+'" data-lineType="'+result.data.contact_type+'" data-contact_man="'+result.data.contact_man+'" data-contact_phone="'+result.data.contact_phone+'" data-nextLine="'+result.data.contact_on+'" data-username="'+result.data.username+'">编辑</a>']
                        ]
                    ];
                    addRow('#addContactTr',0,contactTr);
                    layer.closeAll();
                } else {
                    if(result.target) {
                        Tips.show({
                            target: $( "#" + result.target ),
                            content: result.msg
                        });
                    } else {
                        alert(result.msg);
                    }
                }
            }
        });
    }
    //编辑
    function submitEditContact(e)
    {
        $.ajax({
            url: $(e).attr('data-url'),
            type: "POST",
            data: $("#editForm").serializeArray(),
            dataType: "json",
            success: function( result ){
                if ( result.ret == 0 ) {
                    $('#myModal').modal('hide');
                    editNowTr.find("[name='contact_time']").html(result.data.contact_time);
                    editNowTr.find("[name='telephone']").html(result.data.telephone);
                    if(result.data.contact_type == 1){
                        editNowTr.find("[name='contact_type']").html('打出');
                    } else{
                        editNowTr.find("[name='contact_type']").html('打入');
                    }
                    editNowTr.find("[name='contact_man']").html(result.data.contact_man);
                    if(result.data.contact_on == 1){
                        editNowTr.find("[name='contact_on']").html('是');
                    } else{
                        editNowTr.find("[name='contact_on']").html('否');
                    }
                    editNowTr.find("[name='contact_phone']").html(result.data.contact_phone);
                    editNowTr.find("[name='content']").html(result.data.content);
                    var aEdit = editNowTr.find('.record-icon');
                    aEdit.attr('data-time',result.data.contact_time);
                    aEdit.attr('data-telephone',result.data.telephone);
                    aEdit.attr('data-linetype',result.data.contact_type);
                    aEdit.attr('data-contact_man',result.data.contact_man);
                    aEdit.attr('data-nextline',result.data.contact_on);
                    aEdit.attr('data-contact_phone',result.data.contact_phone);
                    aEdit.attr('data-content',result.data.content);
                    layer.closeAll();
                } else {
                    if(result.target) {
                        Tips.show({
                            target: $( "#" + result.target ),
                            content: result.msg
                        });
                    } else {
                        alert(result.msg);
                    }
                }
            }
        });
    }
</script>
@stop

