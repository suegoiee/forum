@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap">
        <div class="container">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#categories">文章類別列表</a></li>
                    <li><a data-toggle="tab" href="#create_CP">新增鏈結</a></li>
                    <li><a data-toggle="tab" href="#create_category">新增文章類別</a></li>
                </ul>
                <div class="tab-content">
                    <div id="categories" class="tab-pane fade in active">
                        @foreach($categoryproducts as $categoryproduct)
                            @include('_partials._delete_categoryproduct_modal', [
                                'id' => 'delete'.$categoryproduct->id,
                                'route' => ['admin.deleteCategoryProduct.delete', $categoryproduct->id()],
                                'title' => '移除產品/文章鏈結'.$categoryproduct->id,
                                'body' => '<p>確定要刪除</p>',
                                'delete_id' => $categoryproduct->id(),
                            ])
                        @endforeach
                        <table id="example" class="table table-striped category_product_table"></table>
                    </div>
                    <div id="create_CP" class="tab-pane fade">
                        <div class="text-right mg-auto">
                            <span style="vertical-align: middle;">新增</span>
                            <input class="text-right" style="vertical-align: middle;" type="number" min="1" id="number_of_new_component" required="required"/>
                            <span style="vertical-align: middle;">&nbsp;位管理員</span>
                            <button class="btn new_component" id="new_component">新增</button>
                        </div>
                        <form action="/admin/newCategoryProduct" method="post" id="cp_table">
                            @csrf
                            <table class="table table-striped" id="master_table">
                                <tbody>
                                    <tr>
                                        <td>文章分類</td>
                                        <td>商品名稱</td>
                                        <td>刪除</td>
                                    </tr>
                                    <tr value="0" id="master_row0">
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="category_id0">
                                                    <input type="text" class="form-control categoryBar" placeholder="請輸文章分類名稱"  aria-label="search" required="required">
                                                    <input type="text" id="category_id0" name="category_id[]" aria-label="search" style="display:none" required="required">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="product_id0">
                                                    <input type="text" class="form-control productBar" placeholder="請輸入商品名稱" aria-label="search" required="required">
                                                    <input type="text" id="product_id0" name="product_id[]" aria-label="search" style="display:none" required="required">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <i class="fas fa-times cancel_new_participant" value="0" style="cursor:pointer;"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn" id="cp_table_submit" type="submit" form="cp_table">確定</button>
                        </form>
                    </div>
                    <div id="create_category" class="tab-pane fade">
                        <div class="text-right mg-auto">
                            <span style="vertical-align: middle;">新增</span>
                            <input class="text-right" style="vertical-align: middle;" type="number" min="1" id="number_of_new_category" required="required"/>
                            <span style="vertical-align: middle;">&nbsp;個文章類別</span>
                            <button class="btn new_component" id="new_component">新增</button>
                        </div>
                        <form action="/admin/category" method="post" id="category_table">
                            @csrf
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>文章分類名稱</td>
                                        <td>刪除</td>
                                    </tr>
                                </thead>
                                <tbody id="category_body">
                                    <tr value="0" id="master_row0">
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="category_id0">
                                                    <input type="text" name="name[]" class="form-control" placeholder="請輸入分類名稱" required="required">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <i class="fas fa-times cancel_new_participant" style="cursor:pointer;" value="0"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn" id="category_table_submit" type="submit" form="category_table">確定</button>
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
            var products = @json($products);
            var test = @json($test);
            var categoryproducts = @json($categoryproducts);
            var TableTitle = [];
            var TableData = [];
            TableTitle.push({ title: '文章類別' });
            TableTitle.push({ title: '商品名稱' });
            TableTitle.push({ title: '動作' });
            for (var i in categoryproducts) {
                var tmp = [];
                var removeButton = '<a class="btn-xs delete_permission" style="line-height: 0.5;" href="#" data-toggle="modal" data-target="#delete'+categoryproducts[i]['id']+'" value=""><img src="/images/icon/recycling-bin.svg" style="width:16px;"></a>';
                tmp.push(categoryproducts[i]['categories_relation']['name']);
                tmp.push(categoryproducts[i]['product_relation']['name']);
                tmp.push(removeButton);
                TableData.push(tmp);
            }

            $('.category_product_table').DataTable({
                data: TableData,
                columns: TableTitle,
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

            //searchPool(users, 'productBar', 'user_id');
            searchPool(tags, 'categoryBar', 'category_id');
            searchPool(products, 'productBar', 'product_id');
            $(document).on('click', "#new_component", function(){
                var new_component = parseInt($("#number_of_new_category").val());
                if($("#category_table tr:last").attr("value")){
                    var largest = parseInt($("#category_table tr:last").attr("value"))+1;
                }
                else{
                    var largest = 0;
                }
                for(var i = largest; i < largest + new_component; i++){
                    $("#category_body").append('<tr value="'+i+'" id="master_row'+i+'"><td><div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;"><div class="input-group mb-3" value="category_id'+i+'"><input type="text" name="name[]" class="form-control" placeholder="請輸入分類名稱" required="required"></div></div></td><td><div class="form-group"><i class="fas fa-times cancel_new_participant" style="cursor:pointer;" value="'+i+'"></i></div></td></tr>');
                }
                //searchPool(users, 'productBar', 'user_id');
                searchPool(products, 'productBar', 'product_id');
                searchPool(tags, 'categoryBar', 'category_id');
            });
        }
    </script>
@endsection
