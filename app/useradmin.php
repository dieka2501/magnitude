<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent;

class useradmin extends Model
{
    protected $table = 	"user";
    function get_login($username,$password){
    	return DB::table($this->table)->where('email',$username)->where('password',$password)->first();
    }
    function get_email($email){
    	return useradmin::where('email',$email)->first();
    }
    function get_username($username){
    	return useradmin::where('username',$username)->first();
    }
}
