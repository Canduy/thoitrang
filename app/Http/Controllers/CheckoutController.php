<?php


namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart; 
use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\City;
use App\Province;
use App\Wards;
use App\feeShip;
use App\oder;
use App\Shipping;
use App\order_details;
class CheckoutController extends Controller
{
    // check dang nhap
     public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dash');
        }else{
            return Redirect::to('Admin')->send();
        }
    }

    public function comfirm_order(Request $request){
        $data = $request->all();

        $shipping = new Shipping();

        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_method = $data['shipping_method'];

        $shipping->save();
        $shipping_id = $shipping->shipping_id;

         $checkout_code = substr(md5(microtime()),rand(0,26),5);

  
         $order = new oder;
         $order->customer_id =  Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;

         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $order->created_at = now();
         $order->save();

         // order detail
         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new order_details;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sale_quantity = $cart['product_qty'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
         }
         Session::forget('cart');
         Session::forget('fee');
    }

    public function select_delivery_home(Request $request){
        $data = $request->all();

        if($data['action']){
                $output = '' ;
            if($data['action']=='city'){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output.='<option>--Chọn quận huyện--</option>';
                foreach($select_province as $key => $province){
                    $output .='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>' ;
                }
                
            }else{
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>--Chọn xã phường--</option>';
                foreach($select_wards as $key => $ward){
                    $output .='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>' ;
                }
            }
        }
        echo $output;
    }
// Tinh phi van chuyen
    public function caculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = feeShip::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            foreach($feeship as $key =>$fee){
                Session::put('fee',$fee->fee_money);
                Session::save();
            }
        }
    }
// xoa phi van chuyen
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }
    // public function view_order($orderId){
    //     $this->AuthLogin();

    //     $order_by_id = DB::table('tbl_order')
    //     ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
    //     ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
    //     ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')->
    //     select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_detail.*')->where('tbl_order.order_id', $orderId)->get();

    //     $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);

    //     return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
    // }
    public function login_checkout(Request $request){
        $meta_desc = "Đăng nhập đăng kí"; 
        $meta_keywords = "Đăng nhập,đăng kí";
        $meta_title = "Đăng nhập đăng kí";
        $url_canonical = $request->url();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

	$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

	$slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
		return view('pages.checkout.login_checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }
    public function add_customer(Request $request){

    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
    	$data['customer_phone'] = $request->customer_phone;

    	$customer_id = DB::table('tbl_customer')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);

    	return Redirect::to('/checkout');
    }
    public function checkout(Request $request){
         $meta_desc = "Thanh toán"; 
        $meta_keywords = "Thanh toan don hang";
        $meta_title = "Thanh toán";
        $url_canonical = $request->url();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

		$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

		$slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
        $city = City::orderby('matp','ASC')->get();

		return view('pages.checkout.show_checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('slider',$slider)->with('city',$city)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }
    public function save_checkout_customer(Request $request){

    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);

    	return Redirect::to('/payment');
    }
    // public function payment(){
    // 	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

    //     $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

    //     $slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
    //     $city = City::orderby('matp','ASC')->get();

    //     return view('pages.checkout.payment')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('slider',$slider)->with('city',$city);
    // }
    public function logout_checkout(){
    	Session::flush();
    	 return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
    	if($result){
    		Session::put('customer_id',$result->customer_id);
    		return Redirect::to('/checkout');
    	}else{
    		return Redirect::to('/login-checkout');

    	}

    }

    public function order_place(Request $request){
        // insert payment
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lí';

        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // insert order
        $check_code = substr(md5(microtime()),rand(0,26),6);
         $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::subtotal();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['order_status'] = 1;
        $order_data['order_code'] = $check_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order_data['created_at'] = now();

        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        // insert order detail
          $order_d_data = array();
          $content = Cart::content();
          foreach($content as $v_content){
            $order_d_data['order_code'] = $check_code ;
            $order_d_data['product_id'] = $v_content->id ;
            $order_d_data['product_name'] = $v_content->name ;
            $order_d_data['product_price'] = $v_content->price ;
            $order_d_data['product_sale_quantity'] = $v_content->qty ;
             DB::table('tbl_order_detail')->insert($order_d_data);
        }

             if($data['payment_method']==1){
                Cart::destroy();
               $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

                $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

                $slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
                return view('pages.checkout.handcash')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('slider',$slider);
             }else{
                Cart::destroy();
                echo 'atm';
             }
        // return Redirect::to('/payment');
    }

 
}
