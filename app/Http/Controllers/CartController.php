<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart; 
use Illuminate\Http\Request;
use Session;
use DB;
use App\Attr;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{
	// cart ajax
	public function delete_all_product_cart(){
		$cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
	}
	public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;

                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){

                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:blue">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thành công</p>';

                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        $message.='<p style="color:red">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thất bại</p>';
                    }

                }

            }

            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng thất bại');
        }

	}
	public function delete_product_cart($session_id){
		   $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
	}
	public function gio_hang(Request $request){

        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();

		$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

		$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

		$slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
			return view('pages.cart.cart_ajax')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
	}
	public function add_cart_ajax(Request $request){
        // Session::forget('cart');

		$data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }

        Session::save();



}
	// end cart ajax
 //    public function save_cart(Request $request){
 //    $productId = $request->product_hidden;

	// $quantity = $request->qty;

	// $product_infor = DB::table('tbl_product')->where('product_id',$productId)->first();


	// $data['id'] = $product_infor->product_id;
	// $data['qty'] = $quantity;
	// $data['name'] = $product_infor->product_name;
	// $data['price'] = $product_infor->product_price;
	// $data['weight'] = $product_infor->product_price;
	// $data['options']['image'] = $product_infor->product_image;
	// $data['options']['size'] = '41';
	// Cart::add($data);
	// return Redirect::to('/show-cart');
	// // Cart::destroy();
	// }
	// public function show_cart(){

	// $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

	// $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

	// $slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
	// 	return view('pages.cart.show_cart')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('slider',$slider);
	// }

	// public function delete_cart($rowId){
	// 	Cart::update($rowId,0);
	// 	return Redirect::to('/show-cart');

	// }
	// public function update_cart_quantity(Request $request){
	// 	$rowId = $request->rowId_cart;
	// 	$qty = $request->cart_quantity;
	// 	Cart::update($rowId,$qty);
	// 	return Redirect::to('/show-cart');
		
	// }

}
