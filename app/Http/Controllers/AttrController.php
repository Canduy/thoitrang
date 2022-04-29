<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Attr;
use App\Product;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AttrController extends Controller
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
    public function add_attr($product_id,Request $request){
		$this->AuthLogin();

        $product_details = Product::with('attr')->where('product_id',$product_id)->first();
    	$pro_id = $product_id;

        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['size'] as $key => $val){
                if(!empty($val)){
                    $attr = new Attr;
                    $attr->attr_size = $val;
                    $attr->product_id = $pro_id;
                    $attr->attr_quantity = $data['stock'][$key];
                    $attr->save();
                }
             
            }
            Session::put('mess','Thêm thuộc tính thành công');
        }
    	return view('admin.attr.attr_add')->with(compact('pro_id','product_details'));
    }
    public function insert_attr(Request $request, $product_id){
		$this->AuthLogin();
		$attr_size = new Attr();
		$attr_size->attr_name = $request->attr_name;
		$attr_size->attr_value = $request->attr_value;
		$attr_size->product_id = $product_id;
		$attr_size->save();
     	return Redirect()->back();

    }
}
