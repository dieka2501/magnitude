<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\visitor;
use PDF;
use QrCode;
use Mail;
class verifyController extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('verify.index');
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
    public function store(Request $request,Response $response,visitor $visitor)
    {
        if($request->has('email')){
            $email          = $request->input('email');
            $getemail       = $visitor->get_email($email);
            if(count($getemail) > 0){
                $verify['verify']       = 1;
                $verify['updated_at']   = date('Y-m-d H:i:s');
                $visitor->edit_by_email($email,$verify);
                $view['name']           = "Dikdik Kusdinar";
                $view['perusahaan']     = "Data Driven Asia";
                $view['posisi']         = "Product Manager";
                $view['id']             = "1";
                $detail['name']         =  $getemail->nama_visitor;

                QrCode::size(100)->format('png')->generate($view['id'],public_path().'/qrcode/'.str_replace(" ","", $view['name']).'.png');
                // $pdf = App::make('dompdf.wrapper');
                $pdf  = PDF::loadView('pdf.index',$view)->setPaper('A4');
                $pdf->save(public_path().'/pdf/'.str_replace(" ","", $view['name']).'.pdf');
                Mail::send('mail.verify',$detail,function($message) use ($getemail){
                    $message->from('no-reply@indobuildtect.com')->to($getemail->email,$getemail->nama_visitor)->subject('Terima Kasih Telah Melakukan Verifikasi Email')->attach(config('app.url').'public/pdf/'.str_replace(" ","", $getemail->nama_visitor).'.pdf');
                });
                $status = TRUE;
                $alert  = "Terima kasih telah melakukan verifikasi. Silakan memeriksa email anda";
                    
            }else{
                $status = FALSE;
                $alert  = "Email tidak terdaftar, silahkan lakukan registrasi terlebih dahulu.";    
            }
        }else{
            $status = FALSE;
            $alert  = "Email harus diisi.";
        }
        return response()->json(['status'=>$status,'alert'=>$alert]);
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
