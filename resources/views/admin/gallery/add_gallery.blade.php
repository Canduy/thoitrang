@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thư viện ảnh
                        </header>
                    <?php
                        $mess = Session::get('mess');
                        if($mess){
                            echo $mess;
                            Session::put('mess',null);
                        }
                    ?>
                    <form action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3" align="right">
                                
                            </div>
                            <div class="col-md-6">
                                <input type="file" id="file" class="form-control" name="file[]" accept="image/*" multiple >
                                <span id="error"></span>
                            </div>
                            <div class="col-md-3" >
                                <input type="submit" name="upload"  value="Tải ảnh" class="btn btn-success">
                            </div>
                        </div>
                    </form>    
                        <div class="panel-body">
                        
                                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                        <form>
                                   {{ csrf_field() }}
                            
                            <div id="gallery_load">
                                 {{-- <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Tên hình ảnh</th>
                                        <th>Hình ảnh</th>
                                        <th>Quản lí</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                      </tr>
                                    </tbody>
                                  </table> --}}
                            </div>  
                            </div>
                        </form>    
                    </section>

            </div>
@endsection