<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class oder extends Model
{
     public $timestamps = false;
   protected $fillable = ['customer_id', 'shipping_id','order_code','order_status'];
    protected $primaryKey = 'order_id';
 	protected $table = 'tbl_order';
 	public function Customer(){
 		return $this->belongsTo('App\Customer','customer_id');
 	}
}
