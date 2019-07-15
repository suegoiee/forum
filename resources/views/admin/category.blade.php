@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        <div class="container">
            <div class="container" style="padding-top: 30px;">
                <ul class="ad-nav" style="display: flex;">
                    <li class="active"><a style="margin: 0 15px;" data-toggle="tab" href="#categories">文章類別列表</a></li>
                    <li><a style="margin: 0 15px;" data-toggle="tab" href="#category_product">文章鏈結列表</a></li>
                    <li><a style="margin: 0 15px;" data-toggle="tab" href="#create_category">新增文章類別</a></li>
                    <li><a style="margin: 0 15px;" data-toggle="tab" href="#create_CP">新增鏈結</a></li>
                </ul>
                <div class="tab-content">
                    <div id="categories" class="tab-pane fade in active">
                        @foreach($tags as $tag)
                            @include('_partials._delete_modal', [
                                'id' => 'delete'.$tag->id,
                                'route' => ['admin.Category.delete', $tag->slug()],
                                'title' => '移除文章類別'.$tag->name,
                                'body' => '<p>確定要刪除'.$tag->slug().'嗎?</p>'
                            ])
                        @endforeach
                        <table id="example" class="table table-striped categories_table"></table>
                    </div>
                    <div id="category_product" class="tab-pane fade">
                        @foreach($categoryproducts as $categoryproduct)
                            @include('_partials._delete_categoryproduct_modal', [
                                'id' => 'deleteCP'.$categoryproduct->id,
                                'route' => ['admin.deleteCategoryProduct.delete', $categoryproduct->id()],
                                'title' => '移除產品/文章鏈結',
                                'body' => '<p>確定要刪除</p>',
                                'delete_id' => $categoryproduct->id(),
                            ])
                        @endforeach
                        <table id="example" class="table table-striped category_product_table"></table>
                    </div>
                    <div id="create_CP" class="tab-pane fade">
                        <div class="text-right mg-auto">
                            <span style="vertical-align: middle;">新增</span>
                            <input class="text-right" style="vertical-align: middle;" type="number" min="1" id="number_of_new_CPrelation" required="required"/>
                            <span style="vertical-align: middle;">&nbsp;個鏈結</span>
                            <button class="btn new_component" id="new_component" value="CPrelation">新增</button>
                        </div>
                        <form action="/admin/newCategoryProduct" method="post" id="CPrelation_table">
                            @csrf
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>文章分類</td>
                                        <td>商品名稱</td>
                                        <td>刪除</td>
                                    </tr>
                                </thead>
                                <tbody id="CPrelation_body">
                                    <tr value="0" id="CPrelation_row0">
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="CPrelation_id0">
                                                    <input type="text" class="form-control categoryBar" placeholder="請輸文章分類名稱"  aria-label="search" required="required">
                                                    <input type="text" id="CPrelation_id0" name="category_id[]" aria-label="search" style="display:none" required="required">
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
                                                <i class="fas fa-times cancel_new_participant" value="CPrelation_row0" style="cursor:pointer;"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn" id="CPrelation_table_submit" type="submit" form="CPrelation_table">確定</button>
                        </form>
                    </div>
                    <div id="create_category" class="tab-pane fade">
                        <div class="text-right mg-auto">
                            <span style="vertical-align: middle;">新增</span>
                            <input class="text-right" style="vertical-align: middle;" type="number" min="1" id="number_of_new_category" required="required"/>
                            <span style="vertical-align: middle;">&nbsp;個文章類別</span>
                            <button class="btn new_component" id="new_component" value="category">新增</button>
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
                                    <tr value="0" id="category_row0">
                                        <td>
                                            <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
                                                <div class="input-group mb-3" value="category_id0">
                                                    <input type="text" name="name[]" class="form-control" placeholder="請輸入分類名稱" required="required">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <i class="fas fa-times cancel_new_participant" style="cursor:pointer;" value="category_row0"></i>
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
            var products = @json($products);
            var tags = @json($tags);
            var categoryproducts = @json($categoryproducts);
            var CPTitle = [];
            var CPData = [];
            var CategoryTitle = [];
            var CategoryData = [];
            CPTitle.push({ title: '文章類別' });
            CPTitle.push({ title: '商品名稱' });
            CPTitle.push({ title: '動作' });
            for (var i in categoryproducts) {
                if(categoryproducts[i]['categories_relation'] != null){
                    var tmp = [];
                    var removeButton = '<a class="btn-xs delete_permission" style="line-height: 0.5;" href="#" data-toggle="modal" data-target="#deleteCP'+categoryproducts[i]['id']+'" value=""><img src="/images/icon/recycling-bin.svg" style="width:16px;"></a>';
                    tmp.push(categoryproducts[i]['categories_relation']['name']);
                    tmp.push(categoryproducts[i]['product_relation']['name']);
                    tmp.push(removeButton);
                    CPData.push(tmp);
                }
            }
            CategoryTitle.push({ title: '文章類別' });
            CategoryTitle.push({ title: '類別屬性' });
            CategoryTitle.push({ title: '動作' });
            for (var i in tags) {
                var tmp = [];
                var removeButton = '<a class="btn-xs delete_permission" style="line-height: 0.5;" href="#" data-toggle="modal" data-target="#delete'+tags[i]['id']+'" value=""><img src="/images/icon/recycling-bin.svg" style="width:16px;"></a>';
                tmp.push(tags[i]['name']);
                if(tags[i]['category_product_relation'].length == 0){
                    tmp.push('一般');
                }
                else{
                    tmp.push('付費');
                }
                tmp.push(removeButton);
                CategoryData.push(tmp);
            }
            forum_datatable('category_product_table', CPData, CPTitle);
            forum_datatable('categories_table', CategoryData, CategoryTitle);
            searchPool(tags, 'categoryBar', 'category_id');
            searchPool(products, 'productBar', 'product_id');
            $(document).on('click', ".new_component", function(){
                var name = $(this).attr("value");
                var new_component = parseInt($("#number_of_new_"+name).val());
                if($("#"+name+"_table tr:last").attr("value")){
                    var largest = parseInt($("#"+name+"_table tr:last").attr("value"))+1;
                }
                else{
                    var largest = 0;
                }
                if(name == 'category'){
                    for(var i = largest; i < largest + new_component; i++){
                        $("#"+name+"_body").append('<tr value="'+i+'" id="'+name+'_row'+i+'"><td><div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;"><div class="input-group mb-3" value="'+name+'_id'+i+'"><input type="text" name="name[]" class="form-control" placeholder="請輸入分類名稱" required="required"></div></div></td><td><div class="form-group"><i class="fas fa-times cancel_new_participant" style="cursor:pointer;" value="'+name+'_row'+i+'"></i></div></td></tr>');
                    }
                }
                else if(name == 'CPrelation'){
                    for(var i = largest; i < largest + new_component; i++){
                        $("#"+name+"_body").append('<tr value="'+i+'" id="'+name+'_row'+i+'"><td><div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;"><div class="input-group mb-3" value="'+name+'_id'+i+'"><input type="text" class="form-control categoryBar" placeholder="請輸文章分類名稱"  aria-label="search" required="required"><input type="text" id="'+name+'_id'+i+'" name="category_id[]" aria-label="search" style="display:none" required="required"></div></div></td><td><div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;"><div class="input-group mb-3" value="product_id'+i+'"><input type="text" class="form-control productBar" placeholder="請輸入商品名稱" aria-label="search" required="required"><input type="text" id="product_id'+i+'" name="product_id[]" aria-label="search" style="display:none" required="required"></div></div></td><td><div class="form-group"><i class="fas fa-times cancel_new_participant" value="'+name+'_row'+i+'" style="cursor:pointer;"></i></div></td></tr>');
                    }
                }
                searchPool(products, 'productBar', 'product_id');
                searchPool(tags, 'categoryBar', 'category_id');
            });
        }
    </script>
@endsection
