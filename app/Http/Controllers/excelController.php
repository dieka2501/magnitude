<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\visitor;
use App\curl;
class excelController extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        $this->visitor = new visitor;
        $this->curl    = new curl;
        $this->url     = "http://localhost/mailblast/public/api/receiver/create";
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
                            if(count($this->visitor->get_nama($nama))==0){
                                if(count($this->visitor->get_email($email))==0){
                                    if(count($this->visitor->get_phone($phone))==0){
                                        $insert['nama_visitor']     = $nama;
                                        $insert['perusahaan']       = $perusahaan;
                                        $insert['jabatan']          = $jabatan;
                                        $insert['purpose']          = $tujuan;
                                        $insert['nature_business']  = $nature_business;
                                        $insert['email']            = $email;
                                        $insert['region']           = $region;
                                        $insert['country']          = $country;
                                        $insert['phone']            = $phone;
                                        $insert['alamat']           = $alamat;
                                        $insert['bidang']           = $bidang;
                                        $insert['interest_product'] = $interest_product;
                                        $insert['created_at']       = date('Y-m-d H:i:s');
                                        $ids = $this->visitor->add($insert);
                                        if($ids > 0){
                                            $json['name']       = $nama;
                                            $json['email']      = $email;
                                            $json['region']     = $region;
                                            $encode             = json_encode($json);
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
