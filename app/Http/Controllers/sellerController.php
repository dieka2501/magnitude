<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\seller;
use App\register;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class sellerController extends Controller
{
    function __construct(){

        $this->middleware('auth');        
        $this->seller = new seller;
        $this->login  = new register;

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view['role'] =  session('role');
        return view('dashboard.index',$view);
    }

    public function index_admin(){
        
        return view('seller.indexadmin');
    }

    public function list_seller(){
        
        $view['role']   = session('role');
        $view['list']   = $this->seller->get_page();
        return view('seller.sellerlist',$view);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $view['nama']       = session('nama');
        $view['email']      = session('email');
        $view['alamat']     = session('alamat');
        $view['zipcode']    = session('zipcode');
        $view['phone']      = session('phone');
        $view['role']       = session('role');
        return view('seller.form',$view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $nama       = $request->get('nama');
        $password   = $request->get('password');
        $pass       = $request->get('conf-password');
        $alamat     = $request->get('alamat');
        $zipcode    = $request->get('zipcode');
        $email      = $request->get('email');
        $phone      = $request->get('phone');
        if($password == $pass){
            $get_login  = $this->login->get_email($email);
            if(count($get_login) == 0){
                $datalog    = ['email'=>$email,
                                'name'=>$nama,
                                'password'=>bcrypt($password),
                                'role'=>'seller',
                                'date_insert'=>date('Y-m-d H:i:s')];
                $idlogin    = $this->login->add($datalog);
                $dataseller = ['iduser'=>$idlogin,
                                'name_seller'=>$nama,
                                'address_seller'=>$alamat,
                                'email_seller'=>$email,
                                'phone'=>$phone,
                                'zipcode'=>$zipcode,
                                'date_insert'=>date('Y-m-d H:i:s')];
                $res        = $this->seller->add($dataseller);
                if($res > 0){
                    $request->session()->flash('alert','Data seller berhasil masuk');
                    return redirect('/admin/seller');        
                }else{
                    $request->session()->flash('alert','Data seller tidak masuk');
                    $request->session()->flash('nama',$nama);
                    $request->session()->flash('email',$email);
                    $request->session()->flash('alamat',$alamat);
                    $request->session()->flash('zipcode',$zipcode);
                    $request->session()->flash('phone',$phone);
                    return redirect('/admin/seller/create');    
                }    
            }else{
                $request->session()->flash('alert','Email Sudah Terpakai');
                $request->session()->flash('nama',$nama);
                $request->session()->flash('email',$email);
                $request->session()->flash('alamat',$alamat);
                $request->session()->flash('zipcode',$zipcode);
                $request->session()->flash('phone',$phone);
                return redirect('/admin/seller/create');    
            }
            
        }else{
            $request->session()->flash('alert','Password Must Match');
            $request->session()->flash('nama',$nama);
            $request->session()->flash('email',$email);
            $request->session()->flash('alamat',$alamat);
            $request->session()->flash('zipcode',$zipcode);
            $request->session()->flash('phone',$phone);
            return redirect('/admin/seller/create');
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
        $data               = $this->seller->get_id($id);
        $view['id']         = $id;
        $view['nama']       = $data->name_seller;
        $view['email']      = $data->email_seller;
        $view['alamat']     = $data->address_seller;
        $view['zipcode']    = $data->zipcode;
        $view['phone']      = $data->phone;
        $view['role']       = session('role');
        return view('seller.form_edit',$view);
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
        $update['name_seller']       = $request->get('nama');
        $update['address_seller']    = $request->get('alamat');
        $update['zipcode']           = $request->get('zipcode');
        $update['email_seller']      = $request->get('email');
        $update['phone']             = $request->get('phone');
        $update['date_update']       = date('Y-m-d H:i:s');  
        $updatelog['email']          = $update['email_seller'];
        $updatelog['updated_at']     = date('Y-m-d H:i:s');
        if($request->has('password')){
            $password   = $request->get('password');
            $pass       = $request->get('conf-password');
            if($password == $pass){
                $updatelog['password'] = bcrypt($password);
                $login     = $this->login->edit($id,$updatelog);
                $seller    = $this->seller->edit($id,$update);
                if($login > 0 && $seller > 0){
                    $request->session()->flash('alert','Data updated');
                    return redirect('/admin/seller');
                }else{
                    $request->session()->flash('alert','Update failed');
                    return redirect('/admin/seller/edit/'.$id);
                }
            }else{
                $request->session()->flash('alert','Password must match');
                return redirect('/admin/seller/edit/'.$id);
            }    
        }else{
            $login     = $this->login->edit($id,$updatelog);
            $seller    = $this->seller->edit($id,$update);
            if($login > 0 && $seller > 0){
                $request->session()->flash('alert','Data updated');
                return redirect('/admin/seller');
            }else{
                $request->session()->flash('alert','Update failed');
                return redirect('/admin/seller/edit/'.$id);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->login->del($id);
        $this->seller->del($id);
        return redirect('/admin/seller');

    }
}
