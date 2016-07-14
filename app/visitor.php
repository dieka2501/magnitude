<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
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

	function get_advance_filter($position,$region,$country,$lob,$interest_product ,$purpose ,$source,$email){
		$sqlposition 	= "`jabatan` like '%' AND ";
		$sqlregion		= "`region` like '%' AND ";
		$sqlinterest	= "`interest_product` like '%' AND";
		$sqlcountry		= "`country` like '%' AND ";
		$sqllob			= "`bidang` like '%' AND "; 
		$sqlpurpose		= "`purpose` like '%' AND ";
		$sqlsource		= "`source_information` like '%' AND ";
		$sqlemail		= "`email` like '%'";
		$cposition 		= count($position);
		// var_dump($position);die;
		if($position[0]!=""){
			$sqlposition 	= "(";
			for ($pstn=0; $pstn < $cposition ; $pstn++) { 
				if(isset($position[$pstn+1])){
					$sqlposition 	.= " `jabatan` = '".$position[$pstn]."' OR ";		
				}else{
					$sqlposition 	.= " `jabatan` = '".$position[$pstn]."'";
				}
			}
			$sqlposition 	.= ") AND ";
		}
		

		$cregion 		= count($region);
		// var_dump($region);die;
		// $sqlregion 		= "";
		if($region[0]!=""){
			$sqlregion 		= "(";
			for ($rgn = 0; $rgn < $cregion ; $rgn++) { 
				if(isset($region[$rgn+1])){
					$sqlregion 	.= "`region` = '".$region[$rgn]."' OR ";		
				}else{
					$sqlregion 	.= "`region` = '".$region[$rgn]."'";
				}
			}
			$sqlregion 		.= ") AND ";	
		}
		
		if($country[0]!=""){
			$ccountry 		= count($country);
			$sqlcountry 	= "(";
			for ($ctn=0; $ctn < $ccountry; $ctn++) { 
				if(isset($country[$ctn+1])){
					$sqlcountry 	.= "`country` ='".$country[$ctn]."' OR ";		
				}else{
					$sqlcountry 	.= "`country` ='".$country[$ctn]."'";
				}
			}
			$sqlcountry 	.= ") AND ";	
		}
		
		if($lob[0]!=""){
			$clob 	 		= count($lob);
			$sqllob 		= "(";
			for ($cacahlob=0; $cacahlob < $clob; $cacahlob++) { 
				if(isset($country[$cacahlob+1])){
					$sqllob 	.= "`bidang` like '%".$lob[$cacahlob]."%' OR ";		
				}else{
					$sqllob 	.= "`bidang` like '%".$lob[$cacahlob]."%'";
				}
			}
			$sqllob 		.= ") AND ";	
		}
		

		
		if($interest_product[0]!=""){
			$cinterest 		= count($interest_product);
			$sqlinterest 	= "(";
			for ($intr=0; $intr < $cinterest; $intr++) { 
				if(isset($interest_product[$intr+1])){
					$sqlinterest 	.= "`interest_product` like '%".$interest_product[$intr]."%' OR ";		
				}else{
					$sqlinterest 	.= "`interest_product` like '%".$interest_product[$intr]."%' ";
				}
			}
			$sqlinterest 	.= ") AND";	
		}
		

		
		if($purpose != ""){
			if(strpos($purpose, ",") !== FALSE){
				$exppurpose 	= explode(',',$purpose);
				$cpurpose 		= count($exppurpose);
				$sqlpurpose 	= "(";
				for ($pps=0; $pps < $cpurpose; $pps++) { 
					if(isset($purpose[$pps+1])){
						$sqlpurpose 	.= "`purpose` like '%".$exppurpose[$pps]."%' OR ";		
					}else{
						$sqlpurpose 	.= "`purpose` like '%".$exppurpose[$pps]."%'";
					}
				}
				$sqlpurpose 	.= ") AND ";	
			}else{
				$sqlpurpose 	= "(`purpose` like '%".$purpose."%' ) AND ";
			}
				
		}
		

		
		if($source !=  ""){
			$expsource 		= explode(',', $source);
			$csource 		= count($expsource);
			$sqlsource 		= "(";
			for ($scr=0; $scr < $csource; $scr++) { 
				if(isset($expsource[$scr+1])){
					$sqlsource 	.= "`source_information` like '%".$expsource[$scr]."%' OR ";		
				}else{
					$sqlsource 	.= "`source_information` like '%".$expsource[$scr]."%'";
				}
			}
			$sqlsource 		.= ") AND ";	
		}
		

		
		if($email != ""){
			$expemail 		= explode(',', $email);
			$cemail 		= count($expemail);
			$sqlemail 		= "(";
			for ($ml=0; $ml < $cemail; $ml++) { 
				if(isset($expemail[$ml+1])){
					$sqlemail 	.= "`email` like '%".$expemail[$ml]."%' OR ";		
				}else{
					$sqlemail 	.= "`email` like '%".$expemail[$ml]."%'";
				}
			}
			$sqlemail 		.= ")";	
		}
		

		$query = "SELECT * FROM profile_visitor WHERE ".$sqlposition.$sqlregion.$sqlinterest.$sqlcountry.$sqllob.$sqlpurpose.$sqlsource.$sqlemail." ORDER BY nama_visitor ASC";
		// echo $query;
		// return DB::select($query);
		return visitor::whereRaw($sqlposition.$sqlregion.$sqlinterest.$sqlcountry.$sqllob.$sqlpurpose.$sqlsource.$sqlemail)->paginate(20);
		// return DB::statement($query);
	}

	function get_count(){
		return visitor::count();
	}
	function get_visitor_today(){
		return visitor::where('created_at','like','%'.date('Y-m-d').'%')->get();
	}
    //
}
