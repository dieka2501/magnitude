<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use DB;
class visitor extends Model
{
	protected $table = "profile_visitor";
	protected $primaryKey = "id";
	function __construct(){
		date_default_timezone_set('Asia/Jakarta');
	}
	function get_page(){
		return visitor::orderBy('id','DESC')->paginate(20);
	}

	function get_all(){
		return visitor::all();
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
	function edit_by_email($email,$data){
		return visitor::where('email',$email)->update($data);
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
	function get_search($position,$region,$country,$lob,$interest,$purpose,$source,$email){

		$position = ($position != "" )? $position: "%";
		$region   = ($region != "" )? $region: "%";
		$country  = ($country != "" )? $country: "%";
		$lob  	  = ($lob != "" )? '%'.$lob.'%': "%";
		$interest = ($interest != "" )? '%'.$interest.'%': "%";
		$purpose  = ($purpose != "" )? '%'.$purpose.'%': "%";
		$source   = ($source != "" )? '%'.$source.'%': "%";
		$email   = ($email != "" )? '%'.$email.'%': "%";
		return visitor::orderBy('id','DESC')
						->where('jabatan','like',$position)	
						->where('region','like',$region)
						->where('country','like',$country)
						->where('bidang','like',$lob)
						->where('interest_product','like',$interest)	
						->where('purpose','like',$purpose)	
						->where('source_information','like',$source)	
						->where('email','like',$email)	
						->paginate(20);
	}
	function get_count(){
		return visitor::count();
	}
	function get_visitor_today(){
		return visitor::where('created_at','like','%'.date('Y-m-d').'%')->get();
	}
    //
}
