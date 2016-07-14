<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\visitor;
use App\kategori;
use App\checkinBooth;
use App\checkinEvent;
use App\logtime;

class visitorController extends Controller
{
    function __construct(){
        $this->middleware('auth');
        $this->visitor      = new visitor;
        $this->ce           = new checkinEvent;
        $this->cb           = new checkinBooth;
        $this->logtime      = new logtime;
        $this->kategori     = new kategori;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $position          = $request->input('position');
        $region            = $request->input('region');
        $country           = $request->input('country');
        $lob               = $request->input('lob');
        $interest          = $request->input('interest_product');
        $purpose           = $request->input('purpose');
        $source            = $request->input('source');
        $email             = $request->input('email');
        if($request->has('position') || $request->has('region') || $request->has('country') || $request->has('lob') || $request->has('interest_product') || $request->has('purpose') ||  $request->has('source') || $request->has('email') ){
            
            // $getvisitor                          = $this->visitor->get_search($position,$region,$country,$lob,$interest,$purpose,$source,$email);    
            $getvisitor                          = $this->visitor->get_advance_filter($position,$region,$country,$lob,$interest,$purpose,$source,$email);    
            // var_dump($lob);
            // echo "satu";
        }else{
            $getvisitor                          = $this->visitor->get_page();    
            // echo "dua";
        }
        // var_dump(count($getvisitor));
        
        $getjabatan                          = $this->visitor->get_position();
        $getregion                           = $this->visitor->get_region();
        $getcountry                          = $this->visitor->get_country();
        $getlob                              = $this->visitor->get_lob();
        $getinterest                         = $this->kategori->get_all();
        // var_dump($getjabatan);die;
        $arr_position['']                    = "All Position";
        foreach ($getjabatan as $jabatans) {
            if($jabatans->jabatan != "" && $jabatans->jabatan != "0" && $jabatans->jabatan != "-" ){
                $arr_position[strtolower($jabatans->jabatan)] = strtoupper($jabatans->jabatan);
            }
            
        }
        $arr_region                    = [''=>'All Region/City'];
        foreach ($getregion as $regions) {
            if($regions->region != "" && $regions->region != "0" && $regions->region != "-"){
                $arr_region[strtolower($regions->region)] = strtoupper($regions->region);
            }
            
        }
        $arr_country                    = [''=>'All Country'];
        foreach ($getcountry as $countrys) {
            if($countrys->country != "" && $countrys->country != "0" && $countrys->country != "-"){
                $arr_country[strtolower($countrys->country)] = strtoupper($countrys->country);
            }
            
        }
        $arr_lob                    = [''=>'All Line Of Business'];
        foreach ($getlob as $lobs) {
            if($lobs->bidang != "" && $lobs->bidang != "0" && $lobs->bidang != "-" ){
                if(strpos($lobs->bidang, ",") != FALSE){
                    $explodebidang = explode(',', $lobs->bidang);
                    foreach ($explodebidang as $expbidang) {
                        if(array_search($expbidang, $arr_lob) === false ){
                            $arr_lob[strtolower($expbidang)] = strtoupper($expbidang);    
                        }
                    }
                }else{
                    $arr_lob[strtolower($lobs->bidang)] = strtoupper($lobs->bidang);    
                }
                
            }
            
        }
        $arr_interest                    = [''=>'All Interest Product'];
        foreach ($getinterest as $interests) {
            $arr_interest[strtolower($interests->nama_kategori)] = strtoupper($interests->nama_kategori);    
        }
        // var_dump($arr_position);die;
        $view['list']                        = $getvisitor;
        $view['url']                         = "business/excel";
        $view['notip']                       = session('notip');
        $view['arr_position']                = $arr_position;
        $view['position']                    = $request->input('position');
        $view['arr_region']                  = $arr_region;
        $view['region']                      = $request->input('region');
        $view['arr_country']                 = $arr_country;
        $view['country']                     = $request->input('country'); 
        $view['arr_lob']                     = $arr_lob;
        $view['lob']                         = $request->input('lob'); 
        $view['arr_interest_product']        = $arr_interest;
        $view['interest_product']            = $request->input('interest_product'); 
        $view['purpose']                     = $purpose;
        $view['source']                      = $source; 
        $view['email']                       = $email; 
        $view['datacount']                   = $this->visitor->get_count(); 
        return view('visitor.list',$view);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function history($id)
    {   
        $getvisitor             = $this->visitor->get_id($id);
        $event                  = $this->ce->get_idvisitor_all($id);
        $booth                  = $this->cb->get_idvisitor_all($id);
        $logtime                = $this->logtime->get_idvisitor($id);
        $view['notip']          = session('notip');
        $view['visitor']        = $getvisitor;
        $view['event']          = $event;
        $view['booth']          = $booth;
        $view['logtime']        = $logtime;

        return view('visitor.detail',$view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
