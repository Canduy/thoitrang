@extends('welcome')
 @section('content')
<div class="content__highlight">
                <div class="slider__product highlight">
                    {{-- @foreach($category_name as $key => $cate_name)
                    <h2>{{$cate_name->category_name}}</h2>
                    @endforeach --}}<h2>Kết quả tìm kiếm</h2>
                </div>
                <div class="grid wide">
                    <div class="row row__top">
                         @foreach($search_product as $key => $pro)
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
                                 {{-- <div class="btn-buy" style="background: #333;display: inline-block;padding: 5px;border-radius: 5px;margin: 5px 0;text-align: center;">
                                    <a href="#" style="text-decoration: none;color: #fff">Thêm vào giỏ hàng</a>
                                 </div> --}}
                                <div class="highlight__product--body">
                                    <div class="body__heading">
                                         <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_slug)}}" style="text-decoration: none;color: #333;" ><h3 style="font-size: 15px">{{$pro->product_name}}</h3></a>                                  
                                    </div>
                                    <div class="body__price">
                                        <p class="body__price--new">550,000đ</p>
                                        <p class="body__price--old">{{($pro->product_price).' '.'VNĐ'}}</p>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                         @endforeach
                      <div style="text-align: center;width: 100%">{{$search_product->links()}}</div>
                         
                    </div>
                </div>
</div>
@endsection