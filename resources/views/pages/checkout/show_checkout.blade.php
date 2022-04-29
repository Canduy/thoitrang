@extends('welcome')
 @section('content')
  <div class="content">
 		<div class="grid wide">
        		<div class="row">
        			<div class="col l-6">
        				<div class="pay">
			        		<h2 class="cart__heading">Thông tin thanh toán</h2>
			        		{{-- <div class="question">
				        		<p>Bạn đã có tài khoản?</p>
				        		<a href="login.html">Đăng nhập | Đăng ký</a>
			        		</div> --}}
			        		<form  method="post" class="infomation">
			        			{{ csrf_field() }}
			        			<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
			        			<input type="text" name="shipping_phone" class="shipping_phone"  placeholder="Số điện thoại">
			        			<input type="email" name="shipping_email" class="shipping_email" placeholder="Email">
			        			<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
			        		
			        			@if(Session::get('fee'))
                        <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                    @else 
                        <input type="hidden" name="order_fee" class="order_fee" value="30000">
                    @endif
									<div class="">
										 <div class="form-group">
		                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
		                                      <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
		                                            <option value="0">Qua chuyển khoản</option>
		                                            <option value="1">Tiền mặt</option>   
		                                    </select>
		                                </div>
									</div>
			        			<input type="button" name="send_order" class="send_order" value="Xác nhận đơn hàng" style="background: #ff9800;cursor: pointer;">
			        		</form>
			        		<form >
                                {{ csrf_field() }}
		                            <div class="form-group">
		                                <label for="exampleInputFile">Chọn thành phố</label>
		                                    <select class="form-control input-sm m-bot15 choose city" name="city" id="city">
		                                        <option value="">--Chọn thành phố--</option>
		                                        @foreach($city as $key => $ci)
		                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
		                                        @endforeach    
		                                    </select>
		                            </div>
		                             <div class="form-group">
		                                <label for="exampleInputFile">Chọn quận huyện</label>
		                                    <select class="form-control input-sm m-bot15 province choose" name="province" id="province">
		                                        <option value="">--chọn quận huyện--</option>
		                                    </select>
		                            </div>
		                             <div class="form-group">
		                                <label for="exampleInputFile">Chọn xã phường thị trấn</label>
		                                    <select class="form-control input-sm m-bot15 wards" name="wards" id="wards">
		                                        <option value="">--Chọn xã phường--</option>
		                                    </select>
		                            </div>
		                             {{-- <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button> --}}
                                 <input type="button" name="add_delivery" class="btn btn-info caculate_delivery" value="Tính phí vận chuyển" name="caculate_order"></button>
		                            {{-- <input type="button" name="add_delivery" class="btn btn-info caculate_delivery" value="Tính phí vận chuyển" name="caculate_order"></button> --}}

                        </form>
			        	</div>
		        	</div>
		        	<div class="col l-6">
	        			<div class="content__cart">
                    <h2 class="cart__heading">Xem Lại giỏ hàng</h2>
                </div>
              
                <form action="{{url('/update-cart')}}" method="POST">
                                {{ csrf_field() }}
                <table id="customers">
                      <tr>
                        <th style="text-align: center;">Thông tin chi tiết sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng giá</th>
                      </tr>
                   @if(Session::get('cart')==true)   
                      @php
                        $total = 0;
                      @endphp
                   @foreach(Session::get('cart') as $key => $cart)
                        @php
                          $subtotal = $cart['product_price']*$cart['product_qty'];
                          $total+=$subtotal;
                        @endphp
                      <tr>
                          <td>
                            <div class="cart__detail">
                              <a  href="#"><img src="{{asset('public/upload/product/'.$cart['product_image'])}}" alt="" ></a>
                              <div class="cart__detail--body">
                                <h3><a href="#">{{$cart['product_name']}}</a></h3>
                                <p>41</p>
                                <a href="{{url('/delete-product-cart/'.$cart['session_id'])}}">Xoá</a>
                              </div>
                            </div>
                          </td>
                          <td>{{number_format($cart['product_price'],0,',','.')}}đ</td>
                          <td>
                                <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
                              {{-- <input style="width: 50px; height: 30px;" value="{{$cart['product_qty']}}" min="1" type="number" name="cart_quantity"> --}}
                              {{-- <input type="hidden" value="{{$cart['product_qty']}}" name="rowId_cart" > --}}
                          </td>
                          <td>
                                {{number_format($subtotal,0,',','.')}}đ
                          </td>
                      </tr>
                    @endforeach
                   
                      <tr style="border: none;">
                        <td  colspan="4">
                              <input type="submit" class="add__cart" style="border: none;" value="Cập nhật" name="update_qty">
                               <a class="add__cart" style="font-size: 17px;text-decoration: none;" href="{{url('/delete-all-product-cart')}}">Xóa tất cả</a>
                        </td>
                             
                      </tr>
                       <tr style="border: none;">
                          <td>
                            <h3>Tổng tiền: {{number_format($total,0,',','.')}}đ </h3>
                          </td>

                      </tr>
                      @if(Session::get('fee'))
                        <tr style="border: none;"> 
                            <td>  
                                <a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>

                                  Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span></li> 
                                   <?php $total_after_fee = $total + Session::get('fee'); ?>
                            </td>
                         </tr>  
                         <tr style="border: none;">
                            <td> 
                              <h3> Thành tiền:
                                @php 
                                    if(Session::get('fee')){
                                      $total_after = $total_after_fee;
                                      echo number_format($total_after,0,',','.').'đ';
                                    }elseif(!Session::get('fee')){
                                      $total_after = $total_after_coupon;
                                      echo number_format($total_after,0,',','.').'đ';
                                    }
                                @endphp
                            </h3>
                            </td>
                         </tr>
                       @endif
                      @else
                      <tr>
                        <td colspan="6">
                          @php
                              echo 'Giỏ hàng hiện đang trống';
                          @endphp
                        </td>
                      </tr>
                      @endif
                  </form>
                </table>	
			        	
		        	</div>

		        </div>
		        <div class="back">
		        	<div class="back__cart">
			        	<i class="fa fa-angle-left" aria-hidden="true"></i>
			        	<a class="comback" href="{{url('/gio-hang')}}">Quay lại giỏ hàng</a>
			        </div>
			        
		        </div>
        	</div>
</div>
 @endsection