<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkinBooth extends Model
{
	protected $table 		= "checkin_booth";
	protected $primaryKey 	= "idcheckin";
	function get_idvisitor_all($idvisitor){
		return checkinBooth::join('kota_event',$this->table.'.id_kota','=','kota_event.idkota')
							->join('profile_exibitor',$this->table.'.id_exibitor','=','profile_exibitor.id')
							->orderBy($this->primaryKey,'DESC')->where($this->table.'.id_visitor',$idvisitor)->get();
	}
    //
}
