<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class position extends Model
{
	protected $table 		= "position";
	protected $primaryKey   = "id_posisition";
	function add($data){
		return position::insertGetId($data);
	}
	function get_name($name){
		return position::where('position_name',$name)->first();
	}
	function getAllPositionName(){
    	return position::select("position_name","id_posisition")->groupBy('id_posisition')->get();
        
    }
    //
}
