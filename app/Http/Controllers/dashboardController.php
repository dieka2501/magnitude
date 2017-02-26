<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\visitor;
use App\checkinEvent;

class dashboardController extends Controller
{
    function __construct(){
        $this->middleware('auth');
        $this->visitor = new visitor;
        $this->checkin = new checkinEvent;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function indexadmin(Request $request)
    {
        // View::share('username',session('username'));
        
        // var_dump($request->session()->all());
        // $get_visitor        = count($this->visitor->get_visitor_today()); 
        $date_reg           = date_create(session('date_register'));
        $valid_until        = session('valid_until');
        date_add($date_reg,date_interval_create_from_date_string($valid_until.' days'));
        $date_exp   = date_format($date_reg,'d F Y');
        $pos = 0;
        $reg = 0;
        $lob = 0;
        $get_hall1          = count($this->checkin->get_checkin_all_hall1()); 
        $get_nusantara      = count($this->checkin->get_checkin_all_nusantara()); 
        $get_hall7          = count($this->checkin->get_checkin_all_hall7()); 
        $get_hall10         = count($this->checkin->get_checkin_all_hall10()); 
        $get_top_pos        = $this->visitor->get_top_position();
        $get_top_region     = $this->visitor->get_top_region();
        $get_top_lob        = $this->visitor->get_top_lob();
        // $total_checkin      = count($this->checkin->get_checkin_today());
        $view['role']          = session('role');
        // $view['visitor']       = $get_visitor;
        //untuk coba coba
        if(count($get_top_pos) > 10){
            foreach ($get_top_pos as $top_pos) {
                $view['top_pos_jumlah'.$pos]       = $top_pos->jumlah;
                $view['top_pos'.$pos]              = $top_pos->jabatan;
                $pos++;
            }    
        }else{
            for ($ipos=0; $ipos < 3 ; $ipos++) { 
                $view['top_pos_jumlah'.$ipos]       = 0;
                $view['top_pos'.$ipos]              = "Belum ada data";
            }
            
        }
        
        //sdsdsd
        if(count($get_top_region) > 10){
            foreach ($get_top_region as $top_region) {
                $view['top_reg_jumlah'.$reg]       = $top_region->jumlah;
                $view['top_reg'.$reg]              = $top_region->region;
                $reg++;
            }    
        }else{
            for ($ireg=0; $ireg < 5 ; $ireg++) { 
                $view['top_reg_jumlah'.$ireg]       = 0;
                $view['top_reg'.$ireg]              = "Belum ada data";
            }
        }   
        
        //sdsdsdsd
        if(count($get_top_lob) > 10){
            foreach ($get_top_lob as $top_lob) {
                $view['top_lob_jumlah'.$lob]       = $top_lob->jumlah;
                $view['top_lob'.$lob]              = $top_lob->bidang;
                $lob++;
            }    
        }else{
            for ($ilob=0; $ilob < 5; $ilob++) { 
                $view['top_lob_jumlah'.$ilob]       = 0;
                $view['top_lob'.$ilob]              = "Belum ada data";
            }
        }
        
        
        $view['hall1']         = $get_hall1;
        $view['nusantara']     = $get_nusantara;
        $view['hall7']         = $get_hall7;
        $view['hall10']        = $get_hall10;
        view()->share('date_exp', $date_exp);
        view()->share('username', session('username'));
        return view('dashboard.indexadmin',$view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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

    public function logout(){
        // var_dump(session()->flush());
        // if(session()->flush()){
            session()->flush();
            return redirect('/login');  
        // }else{
        //     return redirect('/admin');
        // }
    }
}
