<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class logtime extends Model
{
	protected $table = 'logtime';
	protected $primaryKey = "id_logtime";
	function __construct(){
		date_default_timezone_set('Asia/Jakarta');
	}
	function get_idvisitor($iduser){
			return logtime::select(DB::Raw('*,TIMESTAMPDIFF(SECOND,logtime_start,logtime_end) as selisih'))->where('user_id',$iduser)->get();
	}
    //
}
