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
                $request->session()->put('username',$username);
                $request->session()->put('password',$password);
                $request->session()->put('role',$get_login->group);
                $request->session()->put('login',true);
                if($get_login->group == 'admin'){
                    return redirect('/admin');        
                }else{
                    return redirect('/admin');        
                }
                
            }else{
                $request->session()->flash('status','Username dan Password Tidak Diketemukan');
                return redirect('/login');    
            }
        }else{
            $request->session()->flash('status','Username dan Password Tidak Boleh Kosong');
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
