<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\visitor;
use App\checkinEvent;
use Mail;
class emailController extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        $this->ce       = new checkinEvent;
        $this->visitor  = new visitor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getce = $this->ce->get_checkin_today();
        foreach ($getce as $ces) {
            $getvisitor         = $this->visitor->get_id($ces->id_visitor);
            $detail['name']     = $getvisitor->nama_visitor;
            Mail::send('mail.thanks',$detail,function($m) use ($getvisitor){
                $m->from('no-reply@indobuildtech')
                    ->to($getvisitor->email,$getvisitor->nama_visitor)
                    ->subject('Terima Kasih Atas Kedatangannya');
            });
        }
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
