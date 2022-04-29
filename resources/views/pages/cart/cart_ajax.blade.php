@extends('welcome')
 @section('content')
 	<div class="grid wide">
                <div class="content__cart">
                    <h2 class="cart__heading">Giỏ hàng</h2>
                </div>
                  @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
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

                                {{-- <p>41</p> --}}
                                
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
                              <input type="submit" style="color: black;padding: 10px;background: #ff9800;border-radius: 5px;text-align: center;" value="Cập nhật" name="update_qty">
                        </td>
                         <td colspan="4">
                              <a style="margin-top: 10px;color: black;padding: 10px;background: #ff9800;border-radius: 5px;text-align: center;text-decoration: none;font-size: 20px" href="{{url('/delete-all-product-cart')}}">Xóa tất cả</a>
                        </td>
                      </tr>
                       <tr style="border: none;">
                          <td>
                            <h3>Tổng tiền: {{number_format($total,0,',','.')}}đ </h3>
                          </td>
                      </tr>
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
                <div class="comment">
                    <div class="note">
                            {{-- <h2>Chú thích cho shop</h2>
                            <textarea  rows="6" cols="80"></textarea> --}}
                        <div class="total__money" style="float: left;">
                            {{-- <h3>Tổng tiền: {{number_format($total,0,',','.')}}đ </h3> --}}
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
                                  <a href="{{URL::to('/checkout')}}"><h2 style="font-size: 20px">Thanh toán</h2></a>
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