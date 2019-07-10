@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        <div class="container">
            <div class="container" style="padding-top: 30px;">
                <ul class="ad-nav" style="display: flex;">
                    <li class="active"><a style="margin: 0 15px;" data-toggle="tab" href="#home">管理員列表</a></li>
                    <li><a data-toggle="tab" href="#menu1">新增管理員</a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        @foreach($masters as $master)
                            @include('_partials._delete_permission_modal', [
                                'id' => 'delete'.$master->id,
                                'route' => ['admin.users.master.delete', $master->id()],
                                'title' => '移除管理員',
                                'body' => '<p>確定要刪除</p>',
                                'delete_id' => $master->id(),
                            ])
                        @endforeach
                        <table id="example" class="table table-striped master_list_table" style="text-align:center;"></table>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div class="text-right mg-auto">
                            <span style="vertical-align: middle;">新增</span>
                            <input class="text-right" style="vertical-align: middle; olor: #545454; outline: none; border: 2px solid #e9e9e9; border-radius: 5px;" type="number" min="1" id="number_of_new_master" required="required"/>
                            <span style="vertical-align: middle;">&nbsp;位管理員</span>
                            <button class="btn new_component" id="new_component" value="master">新增</button>
                        </div>
                        <form action="admin/permission" method="post" id="master_table">
                            @csrf
                            <table class="table table-striped" style="text-align:center;">
                                <thead>
                                    <tr>
                                        <td>使用者</td>
                                        <td>文章分類</td>
                                        <td>刪除</td>
                                    </tr>
                                </thead>
                                <tbody id="master_body">
                                    <tr value="0" id="master_row0">
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="user_id0">
                                                    <input type="text" class="form-control masterBar" style="float: initial;" placeholder="請輸入信箱或是名稱"  aria-label="search" required="required">
                                                    <input type="text" id="user_id0" name="user_id[]" aria-label="search" style="display:none" required="required">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="category_id0">
                                                    <input type="text" class="form-control categoryBar" style="float: initial;" placeholder="請輸入分類名稱" aria-label="search" required="required">
                                                    <input type="text" id="category_id0" name="category_id[]" aria-label="search" style="display:none" required="required">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="padding-left: 0; padding-right: 0; margin-top: 20px;">
                                                <i class="fas fa-times cancel_new_participant" value="master_row0" style="cursor:pointer;"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn" id="permission_table_submit" type="submit" style="margin: 15px 0; float: right;" form="master_table">確定</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload=function () {
            var masters = @json($masters);
            var users = @json($users);
            var tags = @json($tags);
            var TableTitle = [];
            var TableData = [];
            TableTitle.push({ title: '名稱' });
            TableTitle.push({ title: '信箱' });
            TableTitle.push({ title: '文章分類' });
            TableTitle.push({ title: '權限' });
            TableTitle.push({ title: '動作' });
            for (var i in masters) {
                var tmp = [];
                var removeButton = '<a class="btn-xs delete_permission" style="line-height: 0.5;" href="#" data-toggle="modal" data-target="#delete'+masters[i]['id']+'" value="'+masters[i]['permission_relation']['id']+'"><img src="/images/icon/recycling-bin.svg" style="width:16px;"></a>';
                tmp.push(masters[i]['permission_relation']['name']);
                tmp.push(masters[i]['permission_relation']['email']);
                tmp.push(masters[i]['categories_relation']['name']);
                tmp.push('管理員');
                tmp.push(removeButton);
                TableData.push(tmp);
            }
            forum_datatable('master_list_table', TableData, TableTitle);
            searchPool(users, 'masterBar', 'user_id');
            searchPool(tags, 'categoryBar', 'category_id');
            $(document).on('click', ".new_component", function(){
                var name = $(this).attr("value");
                var new_component = parseInt($("#number_of_new_"+name).val());
                if($("#"+name+"_table tr:last").attr("value")){
                    var largest = parseInt($("#master_table tr:last").attr("value"))+1;
                }
                else{
                    var largest = 0;
                }
                for(var i = largest; i < largest + new_component; i++){
                    $("#"+name+"_body").append('<tr id="'+name+'_row'+i+'" value="'+i+'"><td><div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;"><div class="input-group mb-3" value="user_id'+i+'"><input type="text" class="form-control '+name+'Bar" placeholder="請輸入信箱或是名稱" aria-label="search" required="required"><input type="text" id="user_id'+i+'" name="user_id[]" aria-label="search" style="display:none"></div></div></td><td><div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;"><div class="input-group mb-3" value="category_id'+i+'"><input type="text" class="form-control categoryBar" placeholder="請輸入分類名稱" aria-label="search" required="required"><input type="text" id="category_id'+i+'" name="category_id[]" aria-label="search" style="display:none"></div></div></td><td><div class="form-group"><i class="fas fa-times cancel_new_participant" value="'+name+'_row'+i+'" style="cursor:pointer;"></i></div></td></tr>');
                }
                searchPool(users, 'masterBar', 'user_id');
                searchPool(tags, 'categoryBar', 'category_id');
            });
        }
    </script>
@endsection
