<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\position;
use Excel;
class positionController extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        $this->position = new position;
    }

    function import_xls(Request $request){
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
                            $jabatan                = ($res->jabatan != null)?$res->jabatan : "";
                            
                            
                            if(true){
                                if(count($this->position->get_name($jabatan))==0 ){
                                    if(true){
                                        $insert['position_name']        = str_replace([",","/",'"'], "",$jabatan);
                                        $insert['created_at']           = date('Y-m-d H:i:s');
                                        // echo $nama."<br>";
                                        $ids = $this->position->add($insert);
                                        // $ids = 0;
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
