<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Wards;
use App\feeShip;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class DeliveryController extends Controller
{
    // Phí shippp
    public function delivery(Request $request){
    	$city = City::orderBy('matp','asc')->get();
    	return view('admin.delivery.add_delivery')->with('city',$city);
    }
    // select tinh thanh pho
    public function select_delivery(Request $request){
    	$data = $request->all();

    	if($data['action']){
    			$output = '' ;
    		if($data['action']=='city'){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    			$output.='<option>--Chọn quận huyện--</option>';
    			foreach($select_province as $key => $province){
    				$output .='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>' ;
    			}
    			
    		}else{
    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>--Chọn xã phường--</option>';
    			foreach($select_wards as $key => $ward){
    				$output .='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>' ;
    			}
    		}
    	}
    	echo $output;
    }
    // them phi ship
    public function insert_delivery(Request $request){
    	$data = $request->all();

    	$fee_ship = new feeShip();

    	$fee_ship->fee_matp = $data['city'];
    	$fee_ship->fee_maqh = $data['province'];
    	$fee_ship->fee_xaid = $data['wards'];
    	$fee_ship->fee_money = $data['fee_ship'];

    	$fee_ship->save();
    }
// Hien thi danh sach phi ship
    public function select_feeship(){
    	$feeship = feeShip::orderby('fee_id','desc')->get();

    	$output = '';
    	$output.= '<div class="table-responsive">
    		<table class="table table-bordered">
    			<thead>
    				<tr>
    					<th>Tên thành phố</th>
    					<th>Tên quận huyện</th>
    					<th>Tên xã phường</th>
    					<th>Phí Ship</th>
    				</tr>
    			</thead>
    			<tbody>
    			';
    			foreach($feeship as $key => $fee){
    				$output.= '
    				<tr>
    					<td>'.$fee->City->name_city.'</td>
    					<td>'.$fee->Province->name_quanhuyen.'</td>
    					<td>'.$fee->Wards->name_xaphuong.'</td>
    					<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="feeship_edit">'.number_format($fee->fee_money,0,',','.').'</td>

    				</tr>
    				';
    			}
    	$output.= '	
    			</tbody>

    			</table></div>
    	';
    	echo $output;
    }
    // update phi ship
    public function update_delivery(Request $request){
    	$data = $request->all();
    	$fee_ship = feeShip::find($data['feeship_id']);

    	$fee_money = rtrim($data['fee_money'],'.');
    	
    	$fee_ship->fee_money = $fee_money;

    	$fee_ship->save();

    }
}
