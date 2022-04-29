@extends('welcome')
 @section('content')
 <!-- product slide -->
            <section class="slider">
                        <div class="slider__product">
                            <h2>Sản phẩm mua 1 tặng 1</h2>
                        </div>
                        <ul id="autoWidth" class="cs-hidden">
                        <!--1------------------------------------>  
                        @foreach($all_prodcut_one as $key => $proo)
                      <li class="item-a">
                    <!--box-slider--------------->
                        <div class="box">
                        <!--img-box---------->
                        <form>
                               @csrf
                            <input type="hidden" value="{{$proo->product_id}}" class="cart_product_id_{{$proo->product_id}}">
                            <input type="hidden" value="{{$proo->product_name}}" class="cart_product_name_{{$proo->product_id}}">
                          
                            <input type="hidden" value="{{$proo->product_quantity}}" class="cart_product_quantity_{{$proo->product_id}}">
                            
                            <input type="hidden" value="{{$proo->product_image}}" class="cart_product_image_{{$proo->product_id}}">
                            <input type="hidden" value="{{$proo->product_price}}" class="cart_product_price_{{$proo->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$proo->product_id}}">
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$proo->product_slug)}}">
                                <div class="slide-img" style="background-image: url({{URL::to('public/upload/product/'.$proo->product_image)}});">
                                   
                                <!--overlayer---------->
                                   {{--  <div class="overlay">
                                    <a href="#" class="buy-btn">Buy Now</a> 
                                    </div> --}}
                                </div>
                            </a>
                                <button type="button" class="btn btn-warning add-to-cart" data-id_product="{{$proo->product_id}}" name="add-to-cart">Thêm vào giỏ hàng</button>
                        </form>
                            <!--detail-box--------->
                            <div class="detail-box">
                            <!--type-------->
                            <div class="type">
                            <a href="#">{{$proo->product_name}}</a>
                            
                            </div>
                            <!--price-------->
                            <a href="#" class="price">{{number_format($proo->product_price,0,',','.')}}đ</a>
                                
                            </div>
                        
                        </div>      
                    </li>
                       @endforeach
                      
                    </ul>
            </section>
                   <!-- endslide -->
            <!-- highlight -->
            <div class="content__highlight">
                <div class="slider__product highlight">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
                <div class="grid wide">
                    <div class="row row__top">
                         @foreach($product as $key => $pro)
                        <div class="col l-3 m-6 c-6">
                            <div class="highlight__product">
                                 <form>
                               @csrf
                                <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                                <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                              
                                <input type="hidden" value="{{$pro->product_quantity}}" class="cart_product_quantity_{{$pro->product_id}}">
                                
                                <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                                <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                                <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_slug)}}">
                                    <div class="slide-img" style="background-image: url({{URL::to('public/upload/product/'.$pro->product_image)}});">
                                   
                                <!--overlayer---------->
                                   {{--  <div class="overlay">
                                    <a href="#" class="buy-btn">Buy Now</a> 
                                    </div> --}}
                                </div>
                            </a>
                                <button type="button" class="btn btn-warning add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">Thêm vào giỏ hàng</button>
                        </form>
                                <div class="highlight__product--body">
                                    <div class="body__heading">
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_slug)}}" style="text-decoration: none;color: #333;font-size: 10px"><h3 style="font-size: 15px">{{$pro->product_name}}</h3></a>
                                    </div>
                                    <div class="body__price">
                                        <p class="body__price--new">{{number_format($pro->product_price,0,',','.')}}đ</p>
                                        <p class="body__price--old"></p>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                         @endforeach
                      <div style="text-align: center;width: 100%">{{$product->links()}}</div>

                    </div>
                </div>
            </div>
            <!--end highlight -->
            
            <!-- New -->
            {{-- <div class="content__new">
                <div class="slider__product new ">
                    <h2>Tin tức nổi bật</h2>
                </div>
                <div class="grid wide">
                    <div class="row">
                        @foreach($new as $key => $news)
                            <div class="col l-4">
                                <div class="new__feed">
                                    <div class="new__feed--img">
                                        <a style="text-decoration: none;color: #333" href="{{URL::to('/chi-tiet-tin-tuc/'.$news->new_id)}}"><img src="public/upload/new/{{$news->new_image}}" alt="" width="100%"></a>
                                    </div>
                                    <div class="new__fedd--body">
                                        <a style="text-decoration: none;color: #333" href="{{URL::to('/chi-tiet-tin-tuc/'.$news->new_id)}}"><h3 style="font-size: 15px" class="fedd--body__heding">{{$news->new_desc}}</h3></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach    
                    </div>
                </div>
            </div> --}}
            <!-- end New -->
@endsection