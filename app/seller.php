<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class seller extends Model
{
    protected $table = 'seller';
    
    function get_page(){
    	return DB::table($this->table)->paginate(20);
    }
    function add($data){
    	return DB::table($this->table)->insertGetId($data);
    }
    function get_id($id){
    	return DB::table($this->table)->where('iduser',$id)->first();
    }
    function edit($id,$data){
    	return DB::table($this->table)->where('iduser',$id)->update($data);
    }
    function del($id){
    	return DB::table($this->table)->where('iduser',$id)->delete();
    }
}

