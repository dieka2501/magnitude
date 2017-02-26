<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class exibitor extends Model
{
	protected $table = "profile_exibitor";
	protected $primaryKey = "id";
	function get_page(){
		return exibitor::orderBy($this->primaryKey,'DESC')->paginate(20);
	}
	function get_count(){
		return exibitor::count();
	}
	function add($data){
		return exibitor::insertGetId($data);
	}
	function get_id($id){
		return exibitor::find($id);
	}
	function edit($data,$id){
		return exibitor::where('id',$id)->update($data);
	}
	function del($id){
		return exibitor::where('id',$id)->delete();
	}

    //
}
