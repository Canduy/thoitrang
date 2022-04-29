<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dash');
        }else{
            return Redirect::to('Admin')->send();
        }
    }
    public function index() {
    	return view('Admin_Login');
    }
    public function showdash(){
        $this->AuthLogin();
    	return view('admin.dash');
    }
    public function dash(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);
    	$result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
    	if($result){
    		Session::put('admin_name',$result->admin_name);
    		Session::put('admin_id',$result->admin_id);
    		return Redirect::to('/dash');
    	}else{
    		Session::put('mess','Email hoặc mật khẩu không đúng vui lòng nhập lại');
    		return Redirect::to('/Admin');

    	}
    }
      public function logout(){
        $this->AuthLogin();
    	Session::put('admin_name',null);
    	Session::put('admin_id',null);
    	return Redirect::to('/Admin');

    }
}
