@extends('welcome')
 @section('content')
 @foreach($detail_new as $key => $d_new)
 	 <div class="grid wide">
                <div class="title__news">
                    <h2 style="font-size: 20px">{{$d_new->new_desc}}</h2>
                </div>
                <div class="row news__detail">
                    <div class="col l-8">    
                        <div class="title__news">
                            <div class="news__text">
                               {{$d_new->new_content}}
                            </div>
                            <div class="news__img">
                                <img src="{{URL::to('public/upload/new/'.$d_new->new_image)}}">
                            </div>
                        </div>
                    </div>
                   {{--  <div class="col l-4">
                        <div class="fanpage">
                            <div class="title__fanpage">
                                <h2>Sneaker</h2>
                                <p>10T lượt thích</p>
                            </div>
                            <div class="link__fb">
                                 <a href="#" class="footer__content--item"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> Thích trang
                            </div>
                            <div class="content__fanpage">
                                <div class="content__fanpage--img" style="background-image: url( asset/img/nike15.jpg);"></div>
                                <div class="content__fanpage--img" style="background-image: url( asset/img/nike15.jpg);"></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
@endforeach
 @endsection 