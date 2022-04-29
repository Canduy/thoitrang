<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class GalleryController extends Controller
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
    public function add_gallery($product_id){
		$this->AuthLogin();


    	$pro_id = $product_id;


    	return view('admin.gallery.add_gallery')->with('pro_id',$pro_id);
    }
    public function update_gallery_name(Request $request){
		$this->AuthLogin();

    	$gal_id = $request->gal_id;
    	$gal_text = $request->gal_text;
    	$gallery = Gallery::find($gal_id);
    	$gallery->gallery_name = $gal_text;
    	$gallery->save();
    }
     public function insert_gallery(Request $request,$pro_id){
		$this->AuthLogin();

     	// $product_id = $request->pro_id;
     	$get_image = $request->file('file');
     	if($get_image){
     		foreach($get_image as $image){
     			$get_name_img = $image->getClientOriginalName();
     			$name_image = current(explode('.',$get_name_img));
     			$new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
     			$image->move('public/upload/gallery/',$new_image);
     			$data=$request->all();
     			$gallery = new Gallery();


     			$gallery->gallery_name = $new_image;
     			$gallery->gallery_image = $new_image;
     			$gallery->product_id = $pro_id;
     			$gallery->save();
     		} 
     	}
     	Session::put('mess','Theem thu vien anh thanh cong');
     	return Redirect()->back();
     }


     public function delete_gallery(Request $request){
		$this->AuthLogin();

    	$gal_id = $request->gal_id;
     	$gallery = Gallery::find($gal_id);
     	unlink('public/upload/gallery/'.$gallery->gallery_image);
     	$gallery->delete();
     }

     public function update_gallery(Request $request){
		$this->AuthLogin();

    	$get_image = $request->file('file');
    	$gal_id = $request->gal_id;
     	if($get_image){
     		
     			$get_name_img = $get_image->getClientOriginalName();
     			$name_image = current(explode('.',$get_name_img));
     			$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
     			$get_image->move('public/upload/gallery/',$new_image);

     			$gallery =  Gallery::find($gal_id);
     			unlink('public/upload/gallery/'.$gallery->gallery_image);
     			$gallery->gallery_image = $new_image;
     			$gallery->save();
     	}

     }

    public function select_gallery(Request $request){
		$this->AuthLogin();
    	
    	// echo $request->pro_id;
    	$product_id = $request->pro_id;
    	$gallery = Gallery::where('product_id',$product_id)->get();
    	$galary_count = $gallery->count();
    	$output = '
    		<form>
    				'.csrf_field().'
    		<table class="table">
                                    <thead>
                                      <tr>
                                        <th>Thứ tự</th>
                                        <th>Tên hình ảnh</th>
                                        <th>Hình ảnh</th>
                                        <th>Quản lí</th>
                                      </tr>
                                    </thead>
                                    <tbody>

    	';
    	if($galary_count>0){
    		$i=0;
    		foreach($gallery as $key => $gal){
    			$i++;
    			$output.='
    		
    				<tr>
                                          <td>'.$i.'</td>
                                          <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                                          <td>
                                          	<img src = "'.url('public/upload/gallery/'.$gal->gallery_image).'" width="120" height="120">
                                          	<input type="file" class="file_image" style="width:40%" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" name="file" accept="image/*" >
                                          </td>
                                          <td>
                                          	<button type="button" data-gal_id="'.$gal->gallery_id.'" class="btn btn-xs btn-danger delete-gallery">Xóa
                                          </td>
                                      </tr>

    			';
    		}
    	}else{
    		$output.='
    				<tr>
                                          <td colspan="4">Sản phẩm chưa có thư viện</td>
                                        
                                      </tr>

    			';
    	}
    	$output.='
    				</tbody>
    				</table>
    				</form>

    			';
    	echo $output;
     }
    
}
