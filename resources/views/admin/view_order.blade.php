@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin người mua
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
            <th>Tên người mua</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            {{-- <th></th> --}}
            {{-- <th style="width:30px;"></th> --}}
          </tr>
        </thead>
        <tbody>
          <tr>
              <td>{{$customer->customer_name}}</td>
              <td>{{$customer->customer_phone}}</td>
              <td>{{$customer->customer_email}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin vận chuyển
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
            <th>Tên người nhận hàng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Hình thức thanh toán</th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td>{{$shipping->shipping_name}}</td>
              <td>{{$shipping->shipping_address}}</td>
              <td>{{$customer->customer_phone}}</td>
              <td>
                <?php
                    if($shipping->shipping_method == 1)
                      echo 'Tiền mặt';
                    else{
                      echo 'Chuyển khoản';
                    }
                ?>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br><br>
      <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
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
            <th>Số thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng sản phẩm trong kho còn</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            <th></th>
           
          </tr>
        </thead>
        <tbody>
          @php 
            $i = 0;
            $total = 0;
          @endphp
          @foreach($order_details as $key => $details)
              @php 
                $i++;
                $subtotal = $details->product_price*$details->product_sale_quantity;
                $total+=$subtotal;
            @endphp
          <tr class="color_qty_{{$details->product_id}}">
                <td>{{$i}}</td>
                <td>{{$details->product_name}}</td>
                <td>{{$details->Product->product_quantity}}</td>
                <td>
                  <input type="number" min="1" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_sale_quantity}}" name="product_sale_quantity">

                  <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">

                  <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">

                  <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
                  @if($order_status!=2) 
                       <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}} " name="update_quantity_order">Cập nhật</button>
                  @endif
                </td>
                <td>{{number_format($details->product_price,0,',','.')}}đ</td>
                <td>{{number_format($subtotal,0,',','.')}}đ</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="6">Tổng đơn hàng: {{number_format($total,0,',','.')}}đ</td>
          </tr>
          <tr>
            <td colspan="6">  Phí ship : {{number_format($details->product_feeship,0,',','.')}}đ </td>

          </tr>
          <tr>
            <td colspan="6">
              Thành tiền:   
              @php 
                   $total_after = $total + $details->product_feeship;
                   echo number_format($total_after,0,',','.').'đ';
              @endphp
            </td>
          </tr>
          <tr>
            <td colspan="6">
             @foreach($order as $key => $or)
                @if($or->order_status==1)
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @elseif($or->order_status==2)
                <form>
                  @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @else
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}"  value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @endif
                @endforeach
            </td>
          </tr>
        </tbody>
      </table>
      <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
    </div>
    
  </div>
</div>
@endsection

