<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProdcut extends Controller
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
    public function add_brand_product(){
        $this->AuthLogin();
    	return view('admin.add_brand');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_prodcut = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_prodcut',$all_brand_prodcut);
    	return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);

    }
    public function save_brand_product(Request $request) {
        $this->AuthLogin();
    	$date = array();
    	$date['brand_name'] = $request->brand_product_name;
    	$date['brand_desc'] = $request->brand_product_desc;
    	$date['brand_status'] = $request->brand_product_status;

    	 DB::table('tbl_brand')->insert($date);
    	Session::put('mess','Thêm thành công!');
    	return Redirect::to('/add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('mess','Không kích hoạt thương hiệu sản phẩm thành công!');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('mess','Kích hoạt thương hiệu sản phẩm thành công!');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
         $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = array();
        $date['brand_name'] = $request->brand_product_name;
        $date['brand_desc'] = $request->brand_product_desc;
         DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($date);
         Session::put('mess','Cập nhật thương sản phẩm thành công!');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
         DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
         Session::put('mess','Xoá thương hiệu sản phẩm thành công!');
        return Redirect::to('all-brand-product');
    }
}
