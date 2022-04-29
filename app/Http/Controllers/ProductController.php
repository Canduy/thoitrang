<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Session;
use DB;
use App\Attr;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
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
	public function add_product(){
		$this->AuthLogin();

		$cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

		$brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
		$this->AuthLogin();

        $all_prodcut = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->
        join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->
        orderby('product_id','asc')->paginate(8);

        $manager_product = view('admin.all_product')->with('all_prodcut',$all_prodcut);

    	return view('admin_layout')->with('admin.all_product',$manager_product);

    }
    public function save_product(Request $request) {
    	$this->AuthLogin();

    	$data = array();

        $data['product_name'] = $request->product_name;

    	$data['product_quantity'] = $request->product_quantity;

    	$data['product_price'] = $request->product_price;

    	$data['product_desc'] = $request->product_desc;

        $data['product_slug'] = $request->product_slug;

        $data['product_content'] = $request->product_content;

        $data['category_id'] = $request->product_cate;

        $data['brand_id'] = $request->product_brand;

        $data['product_status'] = $request->product_status;
        // $data['product_size'] = $request->product_size;

        // $getsize = $request->product_size;

        // if($getsize){
        //     foreach($getsize as $key => $size){

        //     }
        // }

        // $data['product_image'] = $request->product_status;
        $get_img = $request->file('product_image');

    	if($get_img){
    		$get_name_img = $get_img->getClientOriginalName();

    		$new_name = current(explode('.',$get_name_img));

    		$new_image = $new_name.rand(0,99).'.'.$get_img->getClientOriginalExtension();

    		$get_img->move('public/upload/product',$new_image);

    		$data['product_image'] = $new_image;

    		 DB::table('tbl_product')->insert($data);

	    	Session::put('mess','Thêm thành công!');
	    	return Redirect::to('all-product');
    	}
    		$data['product_image'] ='';

    	 DB::table('tbl_product')->insert($data);
    	Session::put('mess','Thêm thành công!');
    	return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
    	$this->AuthLogin();

        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);

        Session::put('mess','Không kích hoạt  sản phẩm thành công!');

        return Redirect::to('all-product');

    }
    public function active_product($product_id){
    	$this->AuthLogin();

        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);

        Session::put('mess','Kích hoạt  sản phẩm thành công!');

        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
    	$this->AuthLogin();

    	$cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

		$brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

         $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }

    public function update_product(Request $request,$product_id){
    	$this->AuthLogin();

        $data = array();

    	$data['product_name'] = $request->product_name;
        
        $data['product_quantity'] = $request->product_quantity;

    	$data['product_price'] = $request->product_price;

    	$data['product_desc'] = $request->product_desc;

        $data['product_slug'] = $request->product_slug;
        
        $data['product_content'] = $request->product_content;

        $data['category_id'] = $request->product_cate;

        $data['brand_id'] = $request->product_brand;

        $data['product_status'] = $request->product_status;

        $get_img = $request->file('product_image');
        if($get_img){
    		$get_name_img = $get_img->getClientOriginalName();

    		$new_name = current(explode('.',$get_name_img));

    		$new_image = $new_name.rand(0,99).'.'.$get_img->getClientOriginalExtension();

    		$get_img->move('public/upload/product',$new_image);

    		$data['product_image'] = $new_image;

    		 DB::table('tbl_product')->where('product_id',$product_id)->update($data);

	    	Session::put('mess','cập nhật thành công!');

	    	return Redirect::to('all-product');
    	}

    	 DB::table('tbl_product')->where('product_id',$product_id)->update($data);
    	Session::put('mess','Cập nhật thành công!');
    	return Redirect::to('all-product');
    }
    public function delete_product($product_id){
    	$this->AuthLogin();

         DB::table('tbl_product')->where('product_id',$product_id)->delete();

         Session::put('mess','Xoá  sản phẩm thành công!');
         
        return Redirect::to('all-product');
    }
    // end admin page
    public function detail_product($product_slug,Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

        

        $detail_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->
        join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->
        where('tbl_product.product_slug',$product_slug)->get();

        foreach($detail_product as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            //seo 
                $meta_desc = $value->product_desc;
                $meta_keywords = $value->product_slug;
                $meta_title = $value->product_name;
                $url_canonical = $request->url();
                //--seo
        }

        // gallery
        $gallery = Gallery::where('product_id',$product_id)->orderBy('gallery_id','DESC')->limit(4)->get();
        $attr = Attr::where('product_id',$product_id)->orderBy('attr_id','asc')->limit(5)->get();
        
        $relate_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->
        join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->
        where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_slug',[$product_slug])->orderby(DB::raw('RAND()'))->get();

        $slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();

        return view('pages.product.show_detail')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('detail_product',$detail_product)->with('relate_product',$relate_product)->with('slider',$slider)->with('gallery',$gallery)->with('attr',$attr)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function get_size(Request $request){
        $data = $request->all();
        
        // echo "<pre>"; print_r($data); die;
    }
}
