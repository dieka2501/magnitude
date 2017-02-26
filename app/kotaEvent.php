<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kotaEvent extends Model
{
	protected $table = "kota_event";
	protected $primaryKey 	= "idkota";
	function get_page(){
		return kotaEvent::orderBy($this->primaryKey)->paginate(20);
	}
    //
}
