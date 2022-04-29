<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
     public $timestamps = false;
   protected $fillable = ['attr_size', 'attr_quantity', 'product_id'];
    protected $primaryKey = 'attr_id';
 	protected $table = 'tbl_atttrproduct';
}
