@extends('welcome')
 @section('content')
  <div class="content">
 		<div class="grid wide">
        		<div class="row">
        			<div class="col l-6">
        				<div class="pay">
			        		<h2 class="cart__heading">Thanh toán giỏ hàng</h2>
			        	
			        		<div class="method">
			        			<div class="method__pay--COD">
			        				{{-- <input id="option" type="radio" name="option1" value="">
			        				<label>Giao hàng</label> --}}
				        			<div class="Option__select">
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
				                                 
				                                <input type="button" name="add_delivery" class="btn btn-info caculate_delivery" value="Tính phí vận chuyển" name="caculate_order"></button>
				                            </form>
				                          

			        				</div>
			        			</div>
			        			
			        		</div>
			        		<form method="POST" action="{{URL::to('/order-place')}}">	
			        		{{ csrf_field() }}			        		
			        			<div class="method">
				        			<div class="method__pay--COD">
				        				<input id="option" type="radio" name="payment_option" value="1">
				        				<label>Thanh toán khi giao hàng (COD)</label>
				        			</div>
				        			<div class="method__pay">
				        				<input id="option" type="radio" name="payment_option" value="2">
				        				<label>Thanh toán qua thẻ ngân hàng</label>
				        			</div>
				        			
				        		</div>
			        					<input type="submit" name="send_order_place" value="Đặt hàng" style="background: #ff9800;cursor: pointer;margin-top: 20px">

			        		</form>
			        	</div>
		        	</div>
		        	<div class="col l-6">
        				<div class="content__cart">
                    <h2 class="cart__heading">Xem lại giỏ hàng</h2>
                </div>
                <?php
                	$content = Cart::content();
               
                ?>
            
                <table id="customers">
                      <tr>
                        <th style="text-align: center;">Thông tin chi tiết sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng giá</th>
                      </tr>
                      @foreach($content as $v_content)
                      <tr>
                          <td>
                            <div class="cart__detail">
                              <a  href="#"><img src="{{URL::to('public/upload/product/'.$v_content->options->image)}}" alt="" ></a>
                              <div class="cart__detail--body">
                                <h3><a href="#">{{$v_content->name}}</a></h3>
                                <p>42</p>
                                <a href="{{URL::to('/delete-cart/'.$v_content->rowId)}}">Xoá</a>
                              </div>
                            </div>
                          </td>
                          <td>{{number_format($v_content->price).' '.'vnđ'}}</td>
                          <td>
                            <form action="{{URL::to('/update-cart-quantity')}}" method="POST">
                                {{ csrf_field() }}
                              <input style="width: 50px; height: 30px;" value="{{$v_content->qty}}" min="1" type="number" name="cart_quantity">
                              <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" >
                              <input type="submit" value="Cập nhật" name="update_qty">
                            </form>
                          </td>
                          <td>
                            <?php
                                  $subtotal = $v_content->price * $v_content->qty;
                                  echo number_format($subtotal).' '.'vnđ';
                              ?>
                          </td>
                      </tr>

                      @endforeach
                </table>
                		<h3>Tổng tiền: {{Cart::subtotal(),0,'  , ','  . '}}vnđ </h3>
                			@if(Session::get('fee'))
                			<div class="sum" style="display: flex;align-items: center;">
                				<a href="{{url('/del-fee')}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                				<h3>Phí vận chuyển:<span>{{number_format(Session::get('fee'),0,',','.')}}vnđ</span></h3>
                			</div>	
                			@endif
			        	      
		        	</div>

		        </div>
		       {{--  <div class="back">
		        	<div class="back__cart">
			        	<i class="fa fa-angle-left" aria-hidden="true"></i>
			        	<a class="comback" href="cart.html">Quay lại giỏ hàng</a>
			        	<div class="order">
			        		<a href="#">Đặt hàng</a>
			        	</div>
			        </div>
			        
		        </div> --}}
        	</div>
</div>
 @endsection