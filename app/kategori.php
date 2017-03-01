<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = "kategori";	
    protected $primaryKy = "id";
    function get_all(){
    	return kategori::orderBy('nama_kategori','ASC')->get();
    }
    function getAllKategoriName(){
    	return kategori::select("nama_kategori")->groupBy('nama_kategori')->get();
    }   
}
