<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\useradmin;

class loginController extends Controller
{
    function __construct(){
        $this->middleware('guest');
        $this->login = new useradmin;
        date_default_timezone_set('Asia/Jakarta');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['alert'] = session('status');
        return view('login',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {   
        
        if($request->has('username') && $request->has('password')){
            $username  = $request->get('username');
            $password  = $request->get('password');
            // var_dump(Auth::attempt(['email'=>$username,'password'=>$password])); die;
            if(Auth::attempt(['username'=>$username,'password'=>$password])){
                $get_login      = $this->login->get_username($username);
                if($get_login->valid_until == 0 ){
                    $request->session()->put('username',$username);
                    $request->session()->put('role',$get_login->group);
                    $request->session()->put('date_register',$get_login->created_at);
                    $request->session()->put('valid_until',$get_login->valid_until);
                    $request->session()->put('login',true);
                    return redirect('/admin');     
                }else{
                    $get_date_reg   = $get_login->created_at;
                    if($get_date_reg != "0000-00-00 00:00:00"){
                         $date_now   = date('Y-m-d');
                            $date_valid = date('Y-m-d',strtotime($get_date_reg));
                            $date1      = date_create($date_now);
                            $date2      = date_create($date_valid);
                            $interval   = date_diff($date1,$date2);
                            $res_intv   = $interval->format('%a');
                            if($res_intv < $get_login->valid_until){
                                $request->session()->put('username',$username);
                                $request->session()->put('role',$get_login->group);
                                $request->session()->put('date_register',$get_login->created_at);
                                $request->session()->put('valid_until',$get_login->valid_until);
                                $request->session()->put('login',true);
                                // if($get_login->group == 'admin'){
                                return redirect('/admin');               
                            }else{
                                $request->session()->flash('status','<div class="alert alert-danger">Batas waktu akun anda telah habis, silakan hubungi info@data-driven.asia</div>');
                                return redirect('/login');                    
                            }
                    }else{
                        $request->session()->flash('status','<div class="alert alert-danger">Akun anda tidak valid</div>');
                        return redirect('/login');                
                    }
                }
            }else{
                 $request->session()->flash('status','<div class="alert alert-danger">Username dan Password Tidak Diketemukan</div>');
                 return redirect('/login');    
            }
        }else{
            $request->session()->flash('status','<div class="alert alert-danger">Username dan Password Tidak Boleh Kosong</div>');
            return redirect('/login');
        }

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
    public function destroy()
    {   
        // var_dump(Auth::logout());die;
        
    }
}
