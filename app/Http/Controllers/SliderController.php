<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class SliderController extends Controller
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
    public function add_slider(){
        $this->AuthLogin();

    	return view('admin.Slider.add_slider');
    }
    public function all_slider(){
        $this->AuthLogin();

        $all_slider = DB::table('tbl_slider')->get();

        $manager_slider = view('admin.Slider.all_slider')->with('all_slider',$all_slider);

    	return view('admin_layout')->with('admin.Slider.all_slider',$manager_slider);

    }
    public function save_slider(Request $request) {
        $this->AuthLogin();

    	    	$data = array();

    	$data['slider_name'] = $request->slider_name;

    	$data['slider_desc'] = $request->slider_desc;

        $data['slider_status'] = $request->slider_status;
        // $data['slider_image'] = $request->slider_status;
        $get_img = $request->file('slider_image');

    	if($get_img){
    		$get_name_img = $get_img->getClientOriginalName();

    		$new_name = current(explode('.',$get_name_img));

    		$new_image = $new_name.rand(0,99).'.'.$get_img->getClientOriginalExtension();

    		$get_img->move('public/upload/slider',$new_image);

    		$data['slider_image'] = $new_image;

    		 DB::table('tbl_slider')->insert($data);

	    	Session::put('mess','Thêm thành công!');
	    	return Redirect::to('all-slider');
    	}
    		$data['slider_image'] ='';

    	 DB::table('tbl_slider')->insert($data);
    	Session::put('mess','Thêm thành công!');
    	return Redirect::to('all-slider');
    }
    public function unactive_slider($slider_id){
        $this->AuthLogin();

        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);

        Session::put('mess','Không kích hoạt slider thành công!');

        return Redirect::to('all-slider');
    }
 	public function active_slider($slider_id){
        $this->AuthLogin();

        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);

        Session::put('mess',' kích hoạt slider thành công!');

        return Redirect::to('all-slider');
    }
    public function edit_slider($slider_id){
        $this->AuthLogin();
         $edit_slider = DB::table('tbl_slider')->where('slider_id',$slider_id)->get();
        $manager_slider = view('admin.Slider.edit_slider')->with('edit_slider',$edit_slider);
        return view('admin_layout')->with('admin.Slider.edit_slider',$manager_slider);
    }

    public function update_slider(Request $request,$slider_id){
        $this->AuthLogin();

    	 $data['slider_name'] = $request->slider_name;

    	$data['slider_desc'] = $request->slider_desc;

        $data['slider_status'] = $request->slider_status;
        // $data['slider_image'] = $request->slider_status;
        $get_img = $request->file('slider_image');
        if($get_img){
    		$get_name_img = $get_img->getClientOriginalName();

    		$new_name = current(explode('.',$get_name_img));

    		$new_image = $new_name.rand(0,99).'.'.$get_img->getClientOriginalExtension();

    		$get_img->move('public/upload/slider',$new_image);

    		$data['slider_image'] = $new_image;

    		 DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);

	    	Session::put('mess','cập nhật thành công!');

	    	return Redirect::to('all-slider');
    	}

    	 DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
    	Session::put('mess','Cập nhật thành công!');
    	return Redirect::to('all-slider');
    }
    public function delete_slider($slider_id){
        $this->AuthLogin();
        
         DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();

         Session::put('mess','Xoá slider thành công!');

        return Redirect::to('all-slider');
    }

}
