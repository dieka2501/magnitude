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

    public function indexadmin()
    {
        $get_visitor        = count($this->visitor->get_visitor_today()); 
        $get_hall1          = count($this->checkin->get_checkin_today_hall1()); 
        $get_nusantara      = count($this->checkin->get_checkin_today_nusantara()); 
        $get_hall7          = count($this->checkin->get_checkin_today_hall7()); 
        $get_hall10         = count($this->checkin->get_checkin_today_hall10()); 
        $total_checkin      = count($this->checkin->get_checkin_today());
        $view['role']          = session('role');
        $view['visitor']       = $get_visitor;
        $view['checkin']       = $total_checkin;
        $view['hall1']         = $get_hall1;
        $view['nusantara']     = $get_nusantara;
        $view['hall7']         = $get_hall7;
        $view['hall10']        = $get_hall10;
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
