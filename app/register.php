<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class register extends Model
{
    protected $table = "login";
    function add($data){
    	return DB::table($this->table)->insertGetID($data);
    }
    function get_email($email){
    	return DB::table($this->table)->where('email',$email)->first();
    }
    function edit($id,$data){
    	return DB::table($this->table)->where('id',$id)->update($data);
    }
    function del($id){
    	return DB::table($this->table)->where('id',$id)->delete();
    }
}
