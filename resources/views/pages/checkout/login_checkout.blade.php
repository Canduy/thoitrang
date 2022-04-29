@extends('welcome')
 @section('content')
<div class="acount-page">
				<div class="grid wide">
					<div class="row">
						<div class="col-6">
							<div class="form-container">
								<div class="form-btn">
									<span onclick="login()">Đăng nhập</span>
									<span onclick="register()">Đăng kí</span>
									<hr id="Ind">
								</div>
								<form action="{{URL::to('/login-customer')}}" method="post" class="form" id="LoginForm" >
									{{ csrf_field() }}
									<input type="text" name="email_account" placeholder="Tên đăng nhập">
									<input type="password" name="password_account" placeholder="Mật khẩu">
									<button type="submit" class="btn">Đăng nhập</button>
									<a style="color: var(--text-color)" href="">Quên mật khẩu?</a>
								</form>
								<form action="{{URL::to('/add-customer')}}" method="POST" class="form" id="RegForm">
									{{ csrf_field() }}
									<input type="text" name="customer_name" placeholder="Tên đăng nhập">
									<input type="email" name="customer_email" placeholder="Email">
									<input type="password" name="customer_password" placeholder="Mật khẩu">
									<input type="text" name="customer_phone" placeholder="Số điện thoại">
									<button type="submit" class="btn">Đăng ký</button>
									<button class="fb"><a href="#" class="footer__content--item"><i class="fa fa-facebook-square" aria-hidden="true"></i>Facebook</a></button>
									<button class="gg"><a href="#" class="footer__content--item"><i class="fa fa-google-plus-official" aria-hidden="true"></i>Google</a></button>
								</form>
							</div>
						</div>
					</div>
				</div>
</div>
@endsection