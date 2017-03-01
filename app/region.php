<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class region extends Model
{
    protected $table = "region";	
    protected $primaryKy = "id_region";

    function getAllRegionName(){
    	return region::select("region_name","id_region")->groupBy('id_region')->get();
        
    }
}
