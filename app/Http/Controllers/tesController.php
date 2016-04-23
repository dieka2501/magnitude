<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use QrCode;
class tesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $view['name']           = "Dikdik Kusdinar";
        $view['perusahaan']     = "Data Driven Asia";
        $view['posisi']         = "Product Manager";
        $view['id']             = "1";
        QrCode::size(100)->format('png')->generate($view['id'],public_path().'/qrcode/'.str_replace(" ","", $view['name']).'.png');
        // $pdf = App::make('dompdf.wrapper');
        $pdf  = PDF::loadView('pdf.index',$view)->setPaper('A4');
        return $pdf->save(public_path().'/pdf/'.str_replace(" ","", $view['name']).'.pdf')->stream();
        // return view('pdf.index',$view);
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
