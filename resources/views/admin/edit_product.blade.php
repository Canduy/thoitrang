@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật sản phẩm
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
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/upload-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" value="{{$pro->product_price}}" id="exampleInputEmail1" placeholder="Giá sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control" id="exampleInputEmail1" value="{{$pro->product_slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                    <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1"  value="{{$pro->product_quantity}}" placeholder="Số lượng sản phẩm">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                                    <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" alt="" width="100px" height="100px">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows= "5"   class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm">{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows= "5"   class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Nội dung sản phẩm">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh mục sản phẩm</label>
                                        <select class="form-control input-sm m-bot15" name="product_cate">
                                            @foreach($cate_product as $key => $cate)
                                                @if(@$cate->category_id==$pro->category_id)
                                                    <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                @else
                                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                @endif

                                            
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương hiệu</label>
                                        <select class="form-control input-sm m-bot15" name="product_brand">
                                            @foreach($brand_product as $key => $brand)
                                                @if(@$brand->category_id==$pro->category_id)
                                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                @else
                                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                @endif    
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                        <select class="form-control input-sm m-bot15" name="product_status">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiện</option>
                                        </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection