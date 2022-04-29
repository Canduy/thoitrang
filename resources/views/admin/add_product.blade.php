@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm  sản phẩm
                        </header>
                    <?php
                        $mess = Session::get('mess');
                        if($mess){
                            echo $mess;
                            Session::put('mess',null);
                        }
                    ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="product_name" class="form-control " id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();"> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                    <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows= "5"   class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows= "5"   class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Nội dung sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh mục sản phẩm</label>
                                        <select class="form-control input-sm m-bot15" name="product_cate">
                                            @foreach($cate_product as $key => $cate)
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương hiệu</label>
                                        <select class="form-control input-sm m-bot15" name="product_brand">
                                            @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                              {{--   <div class="form-group">
                                    <label for="exampleInputFile">Size</label>
                                    <input type="checkbox" name="size[]" id="36" value="36" name="product_size">
                                        <label for="36">36</label>
                                    <input type="checkbox" name="size[]" id="37" value="37" name="product_size">
                                        <label for="37">37</label>
                                    <input type="checkbox" name="size[]" id="38" value="38" name="product_size">
                                        <label for="38">38</label>
                                    <input type="checkbox" name="size[]" id="39" value="39" name="product_size">
                                        <label for="39">39</label>
                                    <input type="checkbox" name="size[]" id="40" value="40" name="product_size">
                                        <label for="40">40</label>
                                    <input type="checkbox" name="size[]" id="41" value="41" name="product_size">
                                         <label for="41">41</label>
                                    <input type="checkbox" name="size[]" id="42" value="42" name="product_size">
                                        <label for="42">42</label>
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                        <select class="form-control input-sm m-bot15" name="product_status">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiện</option>
                                        </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection