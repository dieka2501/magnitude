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
	function getAllBusinessName(){
    	return business::select("business_name","id_business")->groupBy('id_business')->get();
        
    }
    //
}
