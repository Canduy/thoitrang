<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    public $timestamps = false;
   protected $fillable = ['order_id', 'product_id', 'product_name','product_price','product_sale_quantity','order_code','product_feeship'];
    protected $primaryKey = 'order_detail_id';
 	protected $table = 'tbl_order_detail';

 	public function Product(){
 		return $this->belongsTo('App\Product','product_id');
 	}
 	
}
