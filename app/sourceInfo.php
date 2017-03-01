<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sourceInfo extends Model
{
	protected $table 			= 'source_info';
	protected $primaryKey 		= 'id_info';
	function add($data){
		return sourceInfo::insertGetId($data);
	}
	function get_name($name){
		return sourceInfo::where('info_name',$name)->first();
	}
	function getAllSourceInfoName(){
    	return sourceInfo::select("info_name","id_info")->groupBy('id_info')->get();
    }   
    //
}
