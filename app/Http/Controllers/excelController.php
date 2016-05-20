<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\visitor;
use App\checkinEvent;
use App\curl;
class excelController extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        $this->visitor = new visitor;
        $this->curl    = new curl;
        $this->ce      = new checkinEvent;
        $this->url     = config('app.url_mailblast')."public/api/receiver/create";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $path = public_path().'/fileexcel/';
        if($request->hasFile('files')){
            $files      = $request->file('files');
            $ext        = $files->getClientOriginalExtension();
            $filename   = $files->getClientOriginalName();
            if($ext == 'xls' || $ext == 'xlsx'){
                if($files->move($path,$filename)){
                    Excel::filter('chunk')->load($path.$filename)->chunk(200,function($result){
                        // var_dump($result);die;
                        foreach ($result as $res) {
                            $nama                   = ($res->nama != null)?$res->nama : "";
                            $perusahaan             = ($res->perusahaan != null)?$res->perusahaan : "";
                            $jabatan                = ($res->jabatan != null)?$res->jabatan : "";
                            $tujuan                 = ($res->tujuan != null)?$res->tujuan : "";
                            $nature_business        = ($res->nature_business != null)?$res->nature_business : "";
                            $email                  = ($res->email != null)?$res->email : "";
                            $region                 = ($res->kota != null)?$res->kota : "";
                            $country                = ($res->negara != null)?$res->negara : ""; 
                            $phone                  = ($res->telepon != null)?$res->telepon : ""; 
                            $alamat                 = ($res->alamat != null)?$res->alamat : ""; 
                            $bidang                 = ($res->bidang != null)?$res->bidang : ""; 
                            $interest_product       = ($res->interest_product != null)?$res->interest_product : ""; 
                            $source_information     = ($res->source_information != null)?$res->source_information : ""; 
                            
                            if(true){
                                if((count($this->visitor->get_email($email))==0 && count($this->visitor->get_phone($phone))==0) || ($email == "" || $phone == "") ){
                                    if(is_string(filter_var($email,FILTER_VALIDATE_EMAIL))){
                                        $insert['nama_visitor']         = str_replace([",","/",'"'], "",$nama);
                                        $insert['perusahaan']           = str_replace([",","/",'"'], "",$perusahaan);
                                        $insert['jabatan']              = str_replace([",","/",'"'], "",$jabatan);
                                        $insert['purpose']              = str_replace([",","/",'"'], "",$tujuan);
                                        $insert['nature_business']      = str_replace([",","/",'"'], "",$nature_business);
                                        $insert['email']                = $email;
                                        $insert['region']               = str_replace([",","/",'"'], "",$region);
                                        $insert['country']              = str_replace([",","/",'"'], "",$country);
                                        $insert['phone']                = str_replace([",","/",'"'], "",$phone);
                                        $insert['alamat']               = str_replace([",","/",'"'], "",$alamat);
                                        $insert['bidang']               = str_replace([",","/",'"'], "",$bidang);
                                        $insert['interest_product']     = str_replace([",","/",'"'], "",$interest_product);
                                        $insert['source_information']   = str_replace([",","/",'"'], "",$source_information);
                                        $insert['created_at']           = date('Y-m-d H:i:s');
                                        // echo $nama."<br>";
                                        $ids = $this->visitor->add($insert);
                                        // $ids = 0;
                                        if($ids > 0){
                                            $curl['name']                   = $insert['nama_visitor'];
                                            $curl['email']                  = $insert['perusahaan'];
                                            $curl['region']                 = $insert['region'];
                                            $curl['position']               = $insert['jabatan'];
                                            $curl['country']                = $insert['country'];
                                            $curl['lob']                    = $insert['bidang'];
                                            $curl['interest_product']       = $insert['interest_product'];
                                            $curl['purpose']                = $insert['purpose'];
                                            $curl['phone']                  = $insert['phone'];
                                            $curl['source']                 = $insert['source_information'];
                                            $curl['address']                = $insert['alamat'];
                                            $curl['company']                = $insert['perusahaan'];
                                            $encode             = json_encode($curl);
                                            $this->curl->post($this->url,$encode);

                                        }
                                    }
                                }
                            }
                        }
                    });
                    $request->session()->flash('notip','Data berhasil diupload.');
                    return redirect('admin/visitor');        
                }else{
                    $request->session()->flash('notip','Error dalam upload file, silakan ulangi.');
                    return redirect('admin/visitor');        
                }
            }else{
                $request->session()->flash('notip','File harus berupa Excel');
                return redirect('admin/visitor');    
            }
        }else{
            $request->session()->flash('notip','File tidak terupload');
            return redirect('admin/visitor');
        }
        //
    }

    function eksport_checkin(){
        $getdata = $this->ce->get_all_join_visitor();
        if(count($getdata) >0){
            $checkindata        = [];
            foreach ($getdata as $datas) {
                $checkindata[] = array('Visitor Name'=>$datas->nama_visitor,
                                        'Company'=>$datas->perusahaan,
                                        'Position'=>$datas->jabatan,
                                        'Email'=>$datas->email,
                                        'Purpose'=>$datas->purpose,
                                        'Country'=>$datas->country,
                                        'Region/City'=>$datas->region,
                                        'Phone'=>$datas->phone,
                                        'Address'=>$datas->alamat,
                                        'Line Of Business'=>$datas->bidang,
                                        'Interest Product'=>$datas->interest_product,
                                        'Source Of Information'=>$datas->source_information,
                                        'Date And Time Check In'=>$datas->date_checkin,
                                        'Gate'=>$datas->gate);
            }
            $checkindata[]      = array('Total Visitor Check In',count($getdata));
            Excel::create('visitor_checkin',function($excel) use ($checkindata){
                $excel->sheet('Visitor Check In',function($sheet) use ($checkindata){
                    // var_dump($excel);die;
                    $sheet->fromArray($checkindata);    
                });
                
            })->download('xlsx');
            Session::flash('notip',"<div class='alert alert-success'>Export Data Check In Berhasil.</div>");
            return redirect('/admin/event/checkin');   
        }
        
    }

    function export_visitor(){
        $getdata = $this->visitor->get_all();
        if(count($getdata) >0){
            $checkindata        = [];
            foreach ($getdata as $datas) {
                $checkindata[] = array('Visitor Name'=>$datas->nama_visitor,
                                        'Company'=>$datas->perusahaan,
                                        'Position'=>$datas->jabatan,
                                        'Email'=>$datas->email,
                                        'Purpose'=>$datas->purpose,
                                        'Country'=>$datas->country,
                                        'Region/City'=>$datas->region,
                                        'Phone'=>$datas->phone,
                                        'Address'=>$datas->alamat,
                                        'Line Of Business'=>$datas->bidang,
                                        'Interest Product'=>$datas->interest_product,
                                        'Source Of Information'=>$datas->source_information
                                        );
            }
            $checkindata[]      = array('Total Visitor',count($getdata));
            Excel::create('visitor',function($excel) use ($checkindata){
                $excel->sheet('Visitor',function($sheet) use ($checkindata){
                    // var_dump($excel);die;
                    $sheet->fromArray($checkindata);    
                });
                
            })->download('xlsx');
            Session::flash('notip',"<div class='alert alert-success'>Export Data Check In Berhasil.</div>");
            return redirect('/admin/visitor');   
        }
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
