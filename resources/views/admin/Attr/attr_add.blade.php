@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm mới thuộc tính
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
                                <form role="form" action="{{URL::to('/add-attr/'.$pro_id)}}" name="add_attribute" id="add_attribute" novalidate="novalidate" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{$product_details->product_id}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm: </label>
                                    <label><strong style="font-size: 15px;opacity: 0.5">{{$product_details->product_name}}</strong></label>
                                </div>
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div>
                                            <input required type="text" name="size[]" id="size" class="size" placeholder="Size"  />
                                            <input type="text" name="stock[]" id="stock" class="stock" placeholder="Stock"  />
                                            <a href="javascript:void(0);" class="add_button" title="Add field">Thêm</a>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="attr" class="btn btn-info">Thêm thuộc tính</button>
                            </form>
                            </div>
                        </div>
                   {{--       <table class="table table-striped b-t b-light">
                                <thead>
                                  <tr>
                                    <th>Attr ID</th>
                                    <th>Attr size</th>
                                    <th>Attr qty</th>
                                    <th></th>
                                    <th style="width:30px;"></th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <tr>
                                    <td>{{$product_details->atrr->attr_id}}</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                       <a onclick="return confirm('Bạn có thực sự muốn xóa?')" href="" class="active" ui-toggle-class=""> 
                                        <i class="fa fa-times text-danger text"></i></a>
                                    </td>
                                  </tr>
                                </tbody>
                         </table> --}}
                    </section>

            </div>
@endsection