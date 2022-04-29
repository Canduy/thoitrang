@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa  Slider
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
                                @foreach($edit_slider as $key => $edit)
                                <form role="form" action="{{URL::to('/upload-slider/'.$edit->slider_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" name="slider_name" value="{{$edit->slider_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh Slider</label>
                                    <input type="file" name="slider_image" value="" class="form-control" id="exampleInputEmail1" >
                                    <img src="{{URL::to('public/upload/slider/'.$edit->slider_image)}}" alt="" width="300px" height="100px">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả Slider</label>
                                    <textarea style="resize: none" rows= "5"   class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm">{{$edit->slider_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                        <select class="form-control input-sm m-bot15" name="slider_status">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiện</option>
                                        </select>
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-info">Sửa</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection