<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class useradmin extends Model
{
    protected $table = 	"login";
    function get_login($username,$password){
    	return DB::table($this->table)->where('email',$username)->where('password',$password)->first();
    }
    function get_email($email){
    	return DB::table($this->table)->where('email',$email)->first();
    }
}
