<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class business extends Model
{
	protected $table 			= 'business';
	protected $primaryKey 		= 'id_business';
	function add($data){
		return business::insertGetId($data);
	}
	function get_name($name){
		return business::where('business_name',$name)->first();
	}
    //
}
