@extends('admin_layout')
@section('admin_content')
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê  sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php
                        $mess = Session::get('mess');
                        if($mess){
                            echo $mess;
                            Session::put('mess',null);
                        }
                    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Số lượng sản phẩm nhập</th>
            <th>Số lượng sản phẩm đã bán</th>
            <th>Thư viện ảnh</th>
            <th>Thuộc tính sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Hình sản phẩm</th>
            <th>Danh mục sản phẩm</th>
            <th>Thương hiệu sản phẩm</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_prodcut as $key => $pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$pro->product_name}}</td>
            <td>{{$pro->product_quantity}}</td>
            <td>{{$pro->product_sold}}</td>
            <td><a href="{{url('/add-gallery/'.$pro->product_id)}}">Thêm thư viện hình ảnh</a></td>
            <td><a href="{{url('/add-attr/'.$pro->product_id)}}">Thêm thuộc tính sản phẩm</a></td>
            <td>{{$pro->product_price}}</td>
            <td><img src="public/upload/product/{{$pro->product_image}}" height="100px" width="100px" /></td>
            <td>{{$pro->category_name}}</td>
            <td>{{$pro->brand_name}}</td>
            <td><span class="text-ellipsis">
              <?php
                  if($pro->product_status == 0){
                    ?>
                        <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span style="color:green;font-size:25px" class="fa fa-thumbs-up"></span></a>
                   <?php
                  }else{
                    ?>
                        <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span style="color:red;font-size:25px" class="fa fa-thumbs-down"></span></a>'
                    <?php
                  }
                ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i></a>
               <a onclick="return confirm('Bạn có thực sự muốn xóa?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active" ui-toggle-class=""> 
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
          <div style="text-align: center;width: 100%">{{$all_prodcut->links()}}</div>
    
  </div>
</div>

@endsection