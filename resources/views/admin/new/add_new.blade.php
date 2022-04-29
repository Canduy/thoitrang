@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm  tin tức
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
                                <form role="form" action="{{URL::to('/save-new')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                               <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả </label>
                                    <textarea style="resize: none" rows= "5"   class="form-control" name="new_desc" id="exampleInputPassword1" placeholder="Mô tả tin tức"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows= "5"   class="form-control" name="new_content" id="exampleInputPassword1" placeholder="Nội dung sản phẩm"></textarea>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="new_image" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                        <select class="form-control input-sm m-bot15" name="new_status">
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