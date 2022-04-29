<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- =======================seo========================= --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$meta_desc}}"/>
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="author"  content="">
    <link rel="canonical" href="{{$url_canonical}}">
    {{-- ======================seo============================ --}}
    <title>{{$meta_title}}</title>
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
    <link rel="icon" href="{{asset('public/frontend/img/favicon.jpg')}}" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="{{asset('public/frontend/css/style2.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/grid.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/product.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/sweetalert.css')}}">
    <script src="{{asset('public/frontend/js/jQuery.js')}}"></script>
   <link rel="stylesheet" href="{{asset('public/frontend/css/lightSlider.css')}}">
   <script src="{{asset('public/frontend/js/lightSlider.js')}}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
</head>
<body>
    <div class="main">
        <div class="header__nav hide-on-mobile">
            <ul class="header__nav--list">
                <li class="header__nav--item">
                    <a href="#" class="header__nav--link">Địa chỉ:Quốc Oai- Hà Nội</a>
                </li>
            </ul>
            <?php
                    $customer_id = Session::get('customer_id');
                    if($customer_id!=NULL){ 
                ?>
                    <ul class="header__nav--list">
		                <li class="header__nav--item">
		                    <a href="{{URL::to('/logout-checkout')}}" class="header__nav--link">Đăng xuất</a>
		                </li>
            		</ul>
                                
                <?php
             		 }else{
                  ?>
                     <ul class="header__nav--list">
		                <li class="header__nav--item">
		                    <a href="{{URL::to('/login-checkout')}}" class="header__nav--link">Đăng nhập |</a>
		                </li>
		                <li class="header__nav--item">
		                    <a href="{{URL::to('/login-checkout')}}" class="header__nav--link">Đăng kí</a>
		                </li>
          			  </ul>
                  <?php 
                      }
                  ?>
           
            
            
        </div>
        <header>
            <div class="logo"><a href="{{URL::to('/trang-chu')}}" style="color: #333;text-decoration: none;">CLOTHING</a></div>
            <nav>
                <ul>
                    <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ </a></li>
                    
                    <li class="sub-menu"><a href="javascript: void(0)">Sản phẩm</a>
                        <ul>
                        @foreach($cate_product as $key => $cate_pro)
                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate_pro->category_product_slug)}}" class="sub-sub">{{$cate_pro->category_name}}</a></li>
                        @endforeach
                        </ul>
                    </li>

                    <li ><a href="{{URL::to('/lien-he')}}">Liên Hệ </a>
                    </li>
                    {{-- <li ><a href="#">FEEDBACK  </a> --}}
                    </li>
                    <li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng </a></li>
                    <!-- <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li> -->
                    <form action="{{URL::to('/search')}}">
                        {{ csrf_field() }}
                        <li class="search">    
                            <input type="text" name="keyword_submit" placeholder="tìm kiếm">
                            <input type="submit" name="search_item" value="tìm kiếm" placeholder="tìm kiếm" class="btn-outline-secondary">
                           {{--  <a class="search-btn" href="#"><i class="fa fa-search" aria-hidden="true"></i> </a> --}}
                        </li>
                    </form>
                </ul>
            </nav>
            <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
        </header>
        <div class="content">
            <!-- Slider 1 -->
            <div class="sliderr" id="slider1">
                <!-- Slides -->
                @foreach($slider as $key => $sli)
                <div style="background-image:url({{URL::to('public/upload/slider/'.$sli->slider_image)}})" width:100%></div>
                @endforeach
               {{--  <div style="background-image:url({{asset('public/frontend/img/slide2.jpg')}})" ></div>
                <div style="background-image:url({{asset('public/frontend/img/slide3.jpg')}})"></div> --}}
                <!-- <div style="background-image:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/30256/jungle.jpg)"></div>
                <div style="background-image:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/30256/1200_bodie-11.jpg)"></div> -->
                <!-- The Arrows -->
                <i class="left" class="arrows" style="z-index:2; position:absolute;"><svg viewBox="0 0 100 100">
                        <path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"></path>
                    </svg></i>
                <i class="right" class="arrows" style="z-index:2; position:absolute;"><svg viewBox="0 0 100 100">
                        <path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" transform="translate(100, 100) rotate(180) "></path>
                    </svg></i>
            </div>
             @yield('content')      
        </div>  
         <footer class="footer">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-4 m-6 c-12 ">
                        <div class="footer__content">
                            <h2 class="footer__content--heading">CLOTHING</h2>
                            <ul class="footer__content--list">
                                <li class="footer__content--item">Địa chỉ:Quốc Oai-Hà Nội</li>
                                <li class="footer__content--item">Số điện thoại:044848484</li>
                                <li class="footer__content--item">Email:Clothing@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col l-4 m-6 c-12">
                        <div class="footer__content">
                            <h2 class="footer__content--heading">Giờ mở cửa</h2>
                            <ul class="footer__content--list">
                                <li class="footer__content--item">Từ 8:00 đến 22:30 tất cả các ngày trong tuần</li>
                                <li class="footer__content--item">Số điện thoại:044848484</li>
                                <li class="footer__content--item">Email:Clothing@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col l-4 m-6 c-12">
                        <div class="footer__content">
                            <h2 class="footer__content--heading">Liên kết mạng xã hội: </h2>
                            {{-- <ul class="footer__content--social">
                                <li class="footer__content--item"><i class="fa fa-facebook-square" aria-hidden="true"></i></li>
                                <li class="footer__content--item"><i class="fa fa-instagram" aria-hidden="true"></i></li>
                            </ul> --}}
                            <ul class="footer__content--thankyou">
                                <li class="footer__content--item">Cảm ơn Quý khách hàng đã tin tưởng và lựa chọn sản phẩm của chúng tôi!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer> 
    </div>
   <script src="{{asset('public/frontend/js/main.js')}}"></script>
   <script src="{{asset('public/frontend/js/main21.js')}}"></script>
   <script src="{{asset('public/frontend/js/main1.js')}}"></script>
   <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
   <script>
       $(document).ready(function(){
              $('.choose').on('change',function(){
            var action = $(this).attr('id');

            var ma_id = $(this).val();

            var _token = $('input[name="_token"]').val();

            var result = '';
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }

            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method : 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},

                success:function(data){
                    $('#'+result).html(data);
                }

            });
        });
       });
   </script>
   {{--  ================================================--}}
   <script type="text/javascript">
       $(document).ready(function(){
        $('.caculate_delivery').click(function(){
            var matp = $('.city').val();
            var maqh = $('.province').val();
            var xaid = $('.wards').val();
            var _token = $('input[name="_token"]').val();
            if(matp == '' && maqh == '' && xaid == ''){
                alert('Lam on chon de tinh phi van chuyen');
            }else{
                  $.ajax({
                url : '{{url('/caculate-fee')}}',
                method : 'POST',
                data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},

                success:function(data){
                    location.reload();
                }

                });
            }
           
         });
       });
   </script>    
   {{-- cart --}}
 <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){

                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

                        }

                    });
                }

                
            });
        });
    </script>
   {{-- comfirm  --}}
   <script>
          $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,_token:_token,shipping_method:shipping_method,order_fee:order_fee},
                            success:function(){
                               swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                            }
                        });

                        window.setTimeout(function(){ 
                            location.reload();
                        } ,3000);

                      } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                      }
              
                });

               
            });
        });
   </script>
     <script type="text/javascript">
            $(document).ready(function(){
                $("#SelSize").change(function(){
                    var size = $(this).val();
                    $.ajax({
                       method:'GET',
                       url:'{{url('/get-size')}}',
                        data:{size:size},
                        success:function(resp){
                            // alert(resp);
                        },error:function(){
                            alert('error');
                        }
                    });
                });
            });
        </script>
</body>
</html>
