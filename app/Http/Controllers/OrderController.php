<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\City;
// use App\Province;
// use App\Wards;
// use App\feeShip;
use App\Shipping;
use App\oder;
use App\order_details;
use App\payment;
use App\Customer;
use App\Product;
use Session;
use DB;
use PDF;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class OrderController extends Controller
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

    public function update_qty(Request $request){
    	$data = $request->all();

    	$order_details = order_details::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
   		
   		$order_details->product_sale_quantity = $data['order_qty'];

   		$order_details->save();
    }

    public function update_order_qty(Request $request){

    	// update order status
    	$data = $request->all();

    	$order = oder::find($data['order_id']);
    	$order->order_status = $data['order_status'];

    	$order->save();

    	// 
    	if($order->order_status==2){
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity - $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold + $qty;
								$product->save();
						}
				}
			}
		}elseif($order->order_status!=2 && $order->order_status!=3){
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity + $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold - $qty;
								$product->save();
						}
				}
			}
		}

    }

    public function order_code($order_code){
    	$order = oder::where('order_code',$order_code)->first();
		$order->delete();
		 Session::put('message','X??a ????n h??ng th??nh c??ng');
        return redirect()->back();
    }
    // 
      public function manager_order(){
        $this->AuthLogin();

        // $all_order = oder::orderby('created_at','DESC')->paginate(5);
     	$all_order = oder::with('Customer')->orderby('created_at','DESC')->paginate(5);
    	return view('admin.manager_order')->with(compact('all_order'));
    }
    // 
    public function view_order($order_code){
    	$order_details = order_details::with('Product')->where('order_code',$order_code)->get();
    	$order = oder::where('order_code',$order_code)->get();

    	foreach($order as $key => $ord){
    		$customer_id = $ord->customer_id;
    		$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
    	}
    	$customer = Customer::where('customer_id',$customer_id)->first();
    	$shipping = Shipping::where('shipping_id',$shipping_id)->first();

    	$order_details = order_details::with('Product')->where('order_code',$order_code)->get();
    	return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','order','order_status'));
    }
    // in don hang
    	public function print_order($checkout_code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		
		return $pdf->stream();
	}
	public function print_order_convert($checkout_code){
		$order_details = order_details::where('order_code',$checkout_code)->get();
		$order = oder::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = order_details::with('product')->where('order_code', $checkout_code)->get();

		

		$output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><center>C??ng ty TNHH Sneaker DVT</center></h1>
		<h4><center>?????c l???p - T??? do - H???nh ph??c</center></h4>
		<p>Ng?????i ?????t h??ng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>T??n kh??ch ?????t</th>
						<th>S??? ??i???n tho???i</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$customer->customer_name.'</td>
						<td>'.$customer->customer_phone.'</td>
						<td>'.$customer->customer_email.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Ship h??ng t???i</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>T??n ng?????i nh???n</th>
						<th>?????a ch???</th>
						<th>Sdt</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$shipping->shipping_name.'</td>
						<td>'.$shipping->shipping_address.'</td>
						<td>'.$customer->customer_phone.'</td>
						<td>'.$shipping->shipping_email.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>????n h??ng ?????t</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>T??n s???n ph???m</th>
						<th>S??? l?????ng</th>
						<th>Gi?? s???n ph???m</th>
						<th>Gi??</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;
				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_price*$product->product_sale_quantity;
					$total+=$subtotal;
					

		$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						
						<td>'.$product->product_sale_quantity.'</td>
						<td>'.number_format($product->product_price,0,',','.').'??'.'</td>
						<td>'.number_format($subtotal,0,',','.').'??'.'</td>

						
					</tr>';
				}

		$output.= '<tr>
				<td colspan="4">
					<p>T???ng ti???n s???n ph???m : '.number_format($total,0,',','.').'??'.'</p>
				</td>
		</tr>';
		
		$output.= '<tr>
				<td colspan="4">
					<p>ph?? ship : '.number_format($product->product_feeship,0,',','.').'??'.'</p>
				</td>
		</tr>';
		
		$output.= '<tr>
				<td colspan="4">
					<p>Thanh to??n : '.number_format($total+$product->product_feeship,0,',','.').'??'.'</p>
				</td>
		</tr>';

		$output.='				
				</tbody>
			
		</table>

		<p>K?? t??n</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Ng?????i l???p phi???u</th>
						<th width="800px">Ng?????i nh???n</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';


		return $output;

	}
}
