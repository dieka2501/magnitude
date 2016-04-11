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
	function get_position(){
		return visitor::select('jabatan')->distinct()->orderBy('jabatan','ASC')->get();
	}
	function get_region(){
		return visitor::select('region')->distinct()->orderBy('region','ASC')->get();
	}
	function get_country(){
		return visitor::select('country')->distinct()->orderBy('country','ASC')->get();
	}
	function get_lob(){
		return visitor::select('bidang')->distinct()->orderBy('bidang','ASC')->get();
	}
	function get_interest(){
		return visitor::select('interest_product')->distinct()->orderBy('interest_product','ASC')->get();
	}
	function get_search($position,$region,$country,$lob,$interest){

		$position = ($position != "" )? $position: "%";
		$region   = ($region != "" )? $region: "%";
		$country  = ($country != "" )? $country: "%";
		$lob  	  = ($lob != "" )? '%'.$lob.'%': "%";
		$interest = ($interest != "" )? '%'.$interest.'%': "%";
		return visitor::orderBy('id','DESC')
						->where('jabatan','like',$position)	
						->where('region','like',$region)
						->where('country','like',$country)
						->where('bidang','like',$lob)
						->where('interest_product','like',$interest)	
						->paginate(20);
	}
    //
}
