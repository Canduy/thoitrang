<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class NewController extends Controller
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
    public function add_new(){
        $this->AuthLogin();

    	return view('admin.new.add_new');
    }
    public function all_new(){
    	 $this->AuthLogin();

        $all_new = DB::table('tbl_new')->get();

        $manager_new = view('admin.new.all_new')->with('all_new',$all_new);

    	return view('admin_layout')->with('admin.new.all_new',$manager_new);

    }
    public function save_new(Request $request){
    	$this->AuthLogin();
    	$data = array();

    	$data['new_desc'] = $request->new_desc;

    	$data['new_content'] = $request->new_content;

        $data['new_status'] = $request->new_status;
        // $data['product_image'] = $request->product_status;
        $get_img = $request->file('new_image');

    	if($get_img){
    		$get_name_img = $get_img->getClientOriginalName();

    		$new_name = current(explode('.',$get_name_img));

    		$new_image_new = $new_name.rand(0,99).'.'.$get_img->getClientOriginalExtension();

    		$get_img->move('public/upload/new',$new_image_new);

    		$data['new_image'] = $new_image_new;

    		 DB::table('tbl_new')->insert($data);

	    	Session::put('mess','Thêm thành công!');
	    	return Redirect::to('all-new');
    	}
    		$data['new_image'] ='';

    	 DB::table('tbl_new')->insert($data);
    	Session::put('mess','Thêm thành công!');
    	return Redirect::to('all-new');
    }
   public function unactive_new($new_id){
    	$this->AuthLogin();

        DB::table('tbl_new')->where('new_id',$new_id)->update(['new_status'=>1]);

        Session::put('mess','Không kích hoạt  sản phẩm thành công!');

        return Redirect::to('all-new');

    }
    public function active_new($new_id){
    	$this->AuthLogin();

        DB::table('tbl_new')->where('new_id',$new_id)->update(['new_status'=>0]);

        Session::put('mess','Kích hoạt  sản phẩm thành công!');

        return Redirect::to('all-new');
    }
    public function delete_new($new_id){
    	$this->AuthLogin();

         DB::table('tbl_new')->where('new_id',$new_id)->delete();

         Session::put('mess','Xoá  sản phẩm thành công!');
         
        return Redirect::to('all-new');
    }
    public function edit_new($new_id){
    	$this->AuthLogin();
    	 $edit_new = DB::table('tbl_new')->where('new_id',$new_id)->get();

        $manager_new = view('admin.new.edit_new')->with('edit_new',$edit_new);

        return view('admin_layout')->with('admin.new.edit_new',$manager_new);
    }
    public function update_new(Request $request,$new_id){
    		$this->AuthLogin();

        $data = array();

    	
    	$data['new_desc'] = $request->new_desc;

    	$data['new_content'] = $request->new_content;

        $data['new_status'] = $request->new_status;

        $get_img = $request->file('new_image');
        if($get_img){
    		$get_name_img = $get_img->getClientOriginalName();

    		$new_name = current(explode('.',$get_name_img));

    		$new_image = $new_name.rand(0,99).'.'.$get_img->getClientOriginalExtension();

    		$get_img->move('public/upload/new',$new_image);

    		$data['new_image'] = $new_image;

    		 DB::table('tbl_new')->where('new_id',$new_id)->update($data);

	    	Session::put('mess','cập nhật thành công!');

	    	return Redirect::to('all-new');
    	}

    	 DB::table('tbl_new')->where('new_id',$new_id)->update($data);
    	Session::put('mess','Cập nhật thành công!');
    	return Redirect::to('all-new');
    }
    // ====================================
    public function show_detail_new($new_id,Request $request){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','ASC')->get();

		$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','ASC')->get();


       $detail_new = DB::table('tbl_new')->where('tbl_new.new_id',$new_id)->get();
       foreach($detail_new as $key => $new){

        $meta_desc = $new->new_desc;
        $meta_keywords = "Tin tức về sneaker";
        $meta_title = "Tin tức mới";
        $url_canonical = $request->url();
       }
        $slider = DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','ASC')->limit(12)->get();
    	 return view('pages.new.show_detail_new')->with('slider',$slider)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('detail_new',$detail_new)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }
}
