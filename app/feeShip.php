<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feeShip extends Model
{
    public $timestamps = false;
   protected $fillable = [
   	'fee_matp', 'fee_maqh', 'fee_xaid','fee_money'
   ];
    protected $primaryKey = 'fee_id';
 	protected $table = 'tbl_feeship';

 	public function City(){
 		return $this->belongsTo('App\City','fee_matp');
 	}
 	public function Province(){
 		return $this->belongsTo('App\Province','fee_maqh');
 	}
 	public function Wards(){
 		return $this->belongsTo('App\Wards','fee_xaid');
 	}
}
