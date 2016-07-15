<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\checkinEvent;
use Auth;
class checkinEventController extends Controller
{
    protected $layout = '';
    function __construct(){
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        $this->ce = new checkinEvent;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date_reg           = date_create(session('date_register'));
        $valid_until        = session('valid_until');
        date_add($date_reg,date_interval_create_from_date_string($valid_until.' days'));
        $date_exp   = date_format($date_reg,'d F Y');
        $getpage = $this->ce->get_join_visitor_page();
        $view['list']       = $getpage;
        $view['notip']      = session('notip');
        $view['datacount']  = 0;
        view()->share('username', session('username'));
        view()->share('date_exp', $date_exp);
        return view('checkinEvent.list',$view);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
