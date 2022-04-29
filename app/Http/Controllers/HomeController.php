<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function page_error(){
        return view('errors.404');
    }
    public function contact(Request $request){
        $meta_desc = "Địa chỉ liên hệ của shop"; 
        $meta_keywords = "Liên hệ";
        $meta_title = "Liên hệ";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();
        $product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','ASC')->limit(12)->get();
        $slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
        return view('pages.contact')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product',$product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function index(Request $request){

        $meta_desc = "Chuyên bán những mẫu quần áo mới nhất trên thị trường";

        $meta_keywords = "quần áo , phu kien quần áo";

        $meta_title = "Mẫu quần áo hot trên thị trường";

        $url_canonical = $request->url();

    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

		$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

        $product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','ASC')->paginate(8);

		$all_prodcut_one = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->
        join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('category_name','Sản phẩm mua 1 tặng 1')->
        orderby('product_id','asc')->get();

        $slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
		$new = DB::table('tbl_new')->where('new_status','0')->orderby('new_id','ASC')->limit(12)->get();

    	return view('pages.home')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product',$product)->with('slider',$slider)->with('all_prodcut_one',$all_prodcut_one)->with('new',$new)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function search(Request $request){

        $meta_desc = "Tìm kiếm"; 
        $meta_keywords = "Tìm kiếm";
        $meta_title = "Tìm kiếm";
        $url_canonical = $request->url();

    	$keyword = $request->keyword_submit;
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();
		$slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
		$search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->paginate(8);

    	return view('pages.product.search_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('slider',$slider)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }
}
