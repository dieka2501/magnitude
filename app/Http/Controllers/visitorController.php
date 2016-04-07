<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\visitor;
use App\checkinBooth;
use App\checkinEvent;

class visitorController extends Controller
{
    function __construct(){
        $this->middleware('auth');
        $this->visitor = new visitor;
        $this->ce      = new checkinEvent;
        $this->cb      = new checkinBooth;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $getvisitor     = $this->visitor->get_page();
        $view['list']   = $getvisitor;
        $view['url']    = "visitor/excel";
        $view['notip']  = session('notip');
        // var_dump($getvisitor);die;
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
        $view['notip']          = session('notip');
        $view['visitor']        = $getvisitor;
        $view['event']          = $event;
        $view['booth']          = $booth;

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
