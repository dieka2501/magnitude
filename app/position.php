<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class position extends Model
{
	protected $table 		= "position";
	protected $primaryKey   = "id_position";
	function add($data){
		return position::insertGetId($data);
	}
	function get_name($name){
		return position::where('position_name',$name)->first();
	}
    //
}
