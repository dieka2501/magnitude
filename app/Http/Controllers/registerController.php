<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\register;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class registerController extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        $this->register = new register;    
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['alert'] = session('alert');
        $data['email'] = session('email');
        $data['name']  = session('name');

        return view('register',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $email      = $request->get('email');
        $password   = $request->get('password');
        $name       = $request->get('name');
        // $verify     = $request->verify;
        if($request->has('verify') && $request->get('verify')!=""){
            $get_email  = $this->register->get_email($email);
            if(count($get_email)==0){
                $data       = ['email'=>$email,
                            'password'=>bcrypt($password),
                            'name'=>$name,
                            'role'=>'admin',
                            'date_insert'=>date('Y-m-d H:i:s'),
                            'date_update'=>date('Y-m-d H:i:s')
                          ];
                $reg =  $this->register->add($data);
                if($reg > 0){
                    $request->session()->flash('alert','Register success, please login');
                    return redirect('/login');    
                }else{
                    $request->session()->flash('alert','Register Failed, please try again');
                    return redirect('/register');    
                }    
            }else{
                $request->session()->flash('alert','Email already registered');
                $request->session()->flash('email',$email);
                $request->session()->flash('name',$name);
                return redirect('/register');                
            }
        }else{

            $request->session()->flash('alert','Agreement not Checked');
            $request->session()->flash('email',$email);
            $request->session()->flash('name',$name);
            return redirect('/register');
        }
        

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
;