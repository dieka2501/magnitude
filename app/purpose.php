<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purpose extends Model
{
    protected $table            = "purpose";	
    protected $primaryKey       = "id_purpose";

    function getAllPurposeName(){
    	return purpose::select("purpose_name","id_purpose")->groupBy('id_purpose')->get();
    }   
}
