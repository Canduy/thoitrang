@extends('welcome')
 @section('content')
 	<div class="grid wide">
                <div class="content__cart">
                    <h2 class="cart__heading">Giỏ hàng</h2>
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
                                <p>{{$v_content->options->size}}</p>
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
                <div class="comment">
                    <div class="note">
                            {{-- <h2>Chú thích cho shop</h2>
                            <textarea  rows="6" cols="80"></textarea> --}}
                        <div class="total__money">
                            <h3>Tổng tiền: {{Cart::subtotal(),0,'  , ','  . '}}vnđ </h3>
                            {{-- <h3>Thuế: {{Cart::tax().' '.'vnđ'}}  </h3> --}}
                            {{-- <h3>Phí vận chuyển:  </h3> --}}
                            {{-- <h3>Thành tiền: {{Cart::total().' '.' vnđ'}}  </h3> --}}
                             {{-- <a href="#"><h2>Cập nhật</h2></a> --}}
                            <?php
                                   $customer_id = Session::get('customer_id');
                                   $shipping_id = Session::get('shipping_id');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                  <a href="{{URL::to('/checkout')}}"><h2 style="font-size: 20px">Thanh toán</h2></a>
                                
                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                  <a href="{{URL::to('/payment')}}"><h2 style="font-size: 20px">Thanh toán</h2></a>
                                 <?php 
                                }else{
                                ?>
                                     <a href="{{URL::to('/login-checkout')}}"><h2 style="font-size: 20px">Thanh toán</h2></a>
                                <?php
                                 }
                                ?>
                           
                        </div>
                    </div>
                </div>
            </div>    
@endsection