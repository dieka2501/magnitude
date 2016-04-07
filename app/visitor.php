<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use DB;
class visitor extends Model
{
	protected $table = "profile_visitor";
	protected $primaryKey = "id";
	function get_page(){
		return visitor::orderBy('id','DESC')->paginate(20);
	}
	function get_nama($nama){
		return visitor::where('nama_visitor','like',$nama)->first();
	}
	function get_email($email){
		return visitor::where('email',$email)->first();
	}
	function get_phone($phone){
		return visitor::where('phone',$phone)->first();
	}
	function add($data){
		return visitor::insertGetId($data);
	}
	function get_id($id){
		return visitor::where($this->primaryKey,$id)->first();
	}
    //
}
