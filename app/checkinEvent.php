<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class checkinEvent extends Model
{
	protected $table 		= "checkin_event";
	protected $primaryKey 	= "id";
	function __construct(){
		date_default_timezone_set('Asia/Jakarta');
	}
	function get_idvisitor_all($idvisitor){
		return checkinEvent::join('kota_event',$this->table.'.id_kota','=','kota_event.idkota')->orderBy($this->primaryKey,'DESC')->where($this->table.'.id_visitor',$idvisitor)->get();
	}
	function get_checkin_today(){
		return checkinEvent::where('date_checkin','like','%'.date('Y-m-d').'%')->get();
	}
	function get_not_checkin(){
		return checkinEvent::select(DB::raw('*,profile_visitor.id as id_pengunjung'))->join('profile_visitor','checkin_event.id_visitor','=','profile_visitor.id','right')->where('checkin_event.id_visitor',NULL)->get();
	}
	function get_join_visitor_page(){
		return checkinEvent::join('profile_visitor',$this->table.'.id_visitor','=','profile_visitor.id')->orderBy($this->table.'.id','DESC')->paginate(20);
	}
	function get_all(){
		return checkinEvent::all();
	}
	function get_all_join_visitor(){
		return checkinEvent::join('profile_visitor',$this->table.'.id_visitor','=','profile_visitor.id')->get();
	}
	function get_checkin_today_hall1(){
		return checkinEvent::where('date_checkin','like','%'.date('Y-m-d').'%')->where('gate','like','Hall1')->get();
	}
	function get_checkin_today_nusantara(){
		return checkinEvent::where('date_checkin','like','%'.date('Y-m-d').'%')->where('gate','like','HallNusantara')->get();
	}
	function get_checkin_today_hall7(){
		return checkinEvent::where('date_checkin','like','%'.date('Y-m-d').'%')->where('gate','like','Hall7')->get();
	}
	function get_checkin_today_hall10(){
		return checkinEvent::where('date_checkin','like','%'.date('Y-m-d').'%')->where('gate','like','Hall10')->get();
	}
    //
}
