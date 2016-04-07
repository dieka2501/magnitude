<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkinEvent extends Model
{
	protected $table 		= "checkin_event";
	protected $primaryKey 	= "id";
	function get_idvisitor_all($idvisitor){
		return checkinEvent::join('kota_event',$this->table.'.id_kota','=','kota_event.idkota')->orderBy($this->primaryKey,'DESC')->where($this->table.'.id_visitor',$idvisitor)->get();
	}
    //
}
