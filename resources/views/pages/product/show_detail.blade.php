@extends('welcome')
 @section('content')
 @foreach($detail_product as $key => $relate)
   <div class="Product">
            <div class="grid wide">
                <div class="row product__page">
                    <div class="col l-4">
                        <div class="detail__product">
                            <img src="{{URL::to('public/upload/product/'.$relate->product_image)}}" id="product_img">
                            <div class="detail__row">
                                @foreach($gallery as $key => $gal)
                                    <div class="detail__img">
                                        <img class="small-img" src="{{URL::to('public/upload/gallery/'.$gal->gallery_image)}}" alt="{{$gal->gallery_name}}">
                                    </div>
                                @endforeach
                                {{-- <div class="detail__img">
                                    <img class="small-img" src="{{asset('public/frontend/img/highlight8.jpg')}}">
                                </div>
                                <div class="detail__img">
                                    <img class="small-img" src="{{asset('public/frontend/img/highlight9.jpg')}}">
                                </div>
                                <div class="detail__img">
                                    <img class="small-img" src="{{asset('public/frontend/img/highlight10.jpg')}}">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col l-8">
                        <div class="detail__document">
                            <div class="name_product">
                                <h2>{{$relate->product_name}}</h2>
                                <span>Thương hiệu: {{$relate->brand_name}} | Mã SP: {{$relate->product_id}}</span>
                            </div>
                            <div class="price__product">
                                <h2>{{number_format($relate->product_price,0,',','.')}}đ</h2>
                               {{--  <h3>840,000</h3> --}}
                            </div>
                            {{-- <form action="{{URL::to('/save-cart')}}" method="post"> --}} 
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{$relate->product_id}}" class="cart_product_id_{{$relate->product_id}}">
                                    <input type="hidden" value="{{$relate->product_name}}" class="cart_product_name_{{$relate->product_id}}">
                                  
                                    <input type="hidden" value="{{$relate->product_quantity}}" class="cart_product_quantity_{{$relate->product_id}}">
                                    
                                    <input type="hidden" value="{{$relate->product_image}}" class="cart_product_image_{{$relate->product_id}}">
                                    <input type="hidden" value="{{$relate->product_price}}" class="cart_product_price_{{$relate->product_id}}">
                                    {{-- <input type="hidden" value="1" class="cart_product_qty_{{$relate->product_id}}"> --}}
                                    
                                    <div class="Size">
                                        {{-- <select id="SelSize" name="size">
                                                <option value="">Select</option>
                                            @foreach($attr as $key => $size)
                                                <option value="{{$size->attr_size}}">{{$size->attr_size}}</option>

                                            @endforeach
                                        </select> --}}
                                   {{--      <select>
                                            <option>Màu sắc</option>
                                            <option>trắng</option>
                                            <option>đen</option>
                                            <option>vàng</option>
                                        </select> --}}
                                        <input name="qty" type="number" min="1" class="cart_product_qty_{{$relate->product_id}}"  value="1" />
                                        <input type="hidden"  name="product_hidden" value="{{$relate->product_id}}">
                                    </div>
                                    <input type="button" value="Thêm giỏ hàng" class="add__cart add-to-cart" data-id_product="{{$relate->product_id}}" name="add-to-cart">
                                    {{-- <input type="submit" class="add__cart add-to-cart" value="Thêm vào giỏ hàng"> --}}
                            </form>
                            <div class="detail__product--document">
                                <h2>Chi tiết sản phẩm</h2>
                                <p>
                                    @if($relate->product_quantity <= 0)
                                        Tình trạng:hết hàng
                                @else
                                        Tình trạng:còn hàng
                            
                            @endif
                                </p>
                            </div>
                            <div class="desc__product">
                                <h2>Mô tả sản phẩm</h2>
                                <p>{{$relate->product_desc}}</p>
                            </div>
                        </div>
                    </div>
                </div>
    @endforeach
                <section class="slider">
                        <div class="slider__product">
                            <h2>Sản phẩm liên quan</h2>
                        </div>
                        <ul id="autoWidth" class="cs-hidden">
                        <!--1------------------------------------>  
                        @foreach($relate_product as $key => $relate)
                              <li class="item-a">
                            <!--box-slider--------------->
                                <div class="box">
                                <!--img-box---------->
                                <form action="">
                                    @csrf
                                    <input type="hidden" value="{{$relate->product_id}}" class="cart_product_id_{{$relate->product_id}}">
                                    <input type="hidden" value="{{$relate->product_name}}" class="cart_product_name_{{$relate->product_id}}">
                                  
                                    <input type="hidden" value="{{$relate->product_quantity}}" class="cart_product_quantity_{{$relate->product_id}}">
                                    
                                    <input type="hidden" value="{{$relate->product_image}}" class="cart_product_image_{{$relate->product_id}}">
                                    <input type="hidden" value="{{$relate->product_price}}" class="cart_product_price_{{$relate->product_id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$relate->product_id}}">
                                       <a href="{{URL::to('/chi-tiet-san-pham/'.$relate->product_slug)}}">
                                            <div class="slide-img" style="background-image: url({{URL::to('public/upload/product/'.$relate->product_image)}});">
                                               
                                            <!--overlayer---------->
                                               {{--  <div class="overlay">
                                                <a href="#" class="buy-btn">Buy Now</a> 
                                                </div> --}}
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-warning add-to-cart" data-id_product="{{$relate->product_id}}" name="add-to-cart">Thêm vào giỏ hàng</button>
                                
                                </form>
                            
                                <!--detail-box--------->
                                <div class="detail-box">
                                <!--type-------->
                                <div class="type">
                                <a href="#">{{$relate->product_name}}</a>
                                </div>
                                <!--price-------->
                                <a href="#" class="price">{{$relate->product_price}}</a>
                                    
                                </div>
                                
                                </div>      
                            </li>
                       @endforeach
                      
                    </ul>
            </section>
            </div>
        </div>
@endsection