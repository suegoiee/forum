@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap">
        <div class="container">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">管理員列表</a></li>
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
                        <table id="example" class="table table-striped"></table>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div class="text-right mg-auto">
                            <span style="vertical-align: middle;">新增</span>
                            <input class="text-right" style="vertical-align: middle;" type="number" min="1" id="number_of_new_component" required="required"/>
                            <span style="vertical-align: middle;">&nbsp;位管理員</span>
                            <button class="btn new_component" id="new_component">新增</button>
                        </div>
                        <form action="admin/permission" method="post" id="permission_table">
                            @csrf
                            <table class="table table-striped" id="master_table">
                                <tbody>
                                    <tr>
                                        <td>使用者</td>
                                        <td>文章分類</td>
                                        <td>刪除</td>
                                    </tr>
                                    <tr value="0">
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="user_id0">
                                                    <input type="text" class="form-control searchBar" placeholder="請輸入信箱或是名稱"  aria-label="search" required="required">
                                                    <input type="text" id="user_id0" name="user_id[]" aria-label="search" style="display:none" required="required">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="category_id0">
                                                    <input type="text" class="form-control categoryBar" placeholder="請輸入分類名稱" aria-label="search" required="required">
                                                    <input type="text" id="category_id0" name="category_id[]" aria-label="search" style="display:none" required="required">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <i class="fas fa-times cancel_new_participant" value="new_participant0" style="cursor:pointer;"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn" id="permission_table_submit" type="submit" form="permission_table">確定</button>
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
            console.log(masters);
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

            $('#example').DataTable({
                data: TableData,
                columns: TableTitle,
                "order": [[3, "desc"]],
                "pagingType": "full_numbers",
                "oLanguage": {
                    "sInfoThousands": ",",
                    "sLengthMenu":
                        '顯示 _MENU_ 筆',
                    "sSearch":
                        '搜尋',
                    "sZeroRecords": 
                        "沒有符合條件的結果",
                    "sInfoFiltered":
                        "",
                    "sInfoEmpty":
                        "",
                    "oPaginate": {
                        "sPrevious": "<",
                        "sFirst": "|<",
                        "sNext": ">",
                        "sLast": ">|"
                    },
                    "sInfo": "共 _TOTAL_ 筆資料 (_START_ 至 _END_)"
                }
            });

            stockPool(users, 'searchBar', 'user_id');
            stockPool(tags, 'categoryBar', 'category_id');
            $(document).on('click', "#new_component", function(){
                var new_component = parseInt($("#number_of_new_component").val());
                if($("#master_table tr:last").attr("value")){
                    var largest = parseInt($("#master_table tr:last").attr("value"))+1;
                }
                else{
                    var largest = 0;
                }
                for(var i = largest; i < largest + new_component; i++){
                    $("#master_table").append('<tr id="master_row'+i+'" value="'+i+'"><td><div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;"><div class="input-group mb-3" value="user_id'+i+'"><input type="text" class="form-control searchBar" placeholder="請輸入信箱或是名稱" aria-label="search" required="required"><input type="text" id="user_id'+i+'" name="user_id[]" aria-label="search" style="display:none"></div></div></td><td><div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;"><div class="input-group mb-3" value="category_id'+i+'"><input type="text" class="form-control categoryBar" placeholder="請輸入分類名稱" aria-label="search" required="required"><input type="text" id="category_id'+i+'" name="category_id[]" aria-label="search" style="display:none"></div></div></td><td><div class="form-group"><i class="fas fa-times cancel_new_participant" value="'+i+'" style="cursor:pointer;"></i></div></td></tr>');
                }
                stockPool(users, 'searchBar', 'user_id');
                stockPool(tags, 'categoryBar', 'category_id');
            });
        }
    </script>
@endsection
