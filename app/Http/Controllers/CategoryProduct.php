<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();

    	return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();

        $all_category_prodcut = DB::table('tbl_category_product')->get();

        $manager_category_product = view('admin.all_category_product')->with('all_category_prodcut',$all_category_prodcut);

    	return view('admin_layout')->with('admin.all_category_product',$manager_category_product);

    }
    public function save_category_product(Request $request) {
        $this->AuthLogin();

    	$date = array();

    	$date['category_name'] = $request->category_product_name;

        $date['category_desc'] = $request->category_product_desc;
    	$date['category_product_slug'] = $request->category_product_slug;

        $date['category_status'] = $request->category_product_status;
    	$date['category_keyword'] = $request->meta_keyword;

    	 DB::table('tbl_category_product')->insert($date);

    	Session::put('mess','Thêm thành công!');

    	return Redirect::to('/all-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);

        Session::put('mess','Không kích hoạt danh mục sản phẩm thành công!');

        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('mess','Kích hoạt danh mục sản phẩm thành công!');

        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
         $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }

    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();

        $data = array();

        $date['category_name'] = $request->category_product_name;
        $date['category_product_slug'] = $request->category_product_slug;
        
        $date['category_keyword'] = $request->meta_keyword;

        $date['category_desc'] = $request->category_product_desc;

         DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($date);

         Session::put('mess','Cập nhật danh mục sản phẩm thành công!');

        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();

         DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();

         Session::put('mess','Xoá danh mục sản phẩm thành công!');

        return Redirect::to('all-category-product');
    }
    // end function Admin page
    public function show_category_home($category_product_slug,Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.category_product_slug',$category_product_slug)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_product_slug',$category_product_slug)->limit(1)->get();
        foreach($category_name as $key => $val){
            $meta_desc = $val->category_desc;

            $meta_keywords = $val->category_keyword;

            $meta_title = $val->category_name;

            $url_canonical = $request->url();
        }

        $slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();

        return view('pages.category.show_category')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('category_by_id',$category_by_id)->with("category_name",$category_name)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}
