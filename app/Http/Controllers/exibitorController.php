<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\exibitor;
class exibitorController extends Controller
{
    function __construct(){
        $this->middleware('auth');
        $date_reg           = date_create(session('date_register'));
        $valid_until        = session('valid_until');
        date_add($date_reg,date_interval_create_from_date_string($valid_until.' days'));
        $date_exp   = date_format($date_reg,'d F Y');
        view()->share('username', session('username'));
        view()->share('date_exp', $date_exp);
        $this->exibitor = new exibitor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getlist                = $this->exibitor->get_page();
        $getcount               = $this->exibitor->get_count();
        $view['notip']          = session('notip');
        $view['list']           = $getlist;
        $view['datacount']      = $getcount;
        return view('exibitor.list',$view);

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view['id']                         = session('id');
        $view['nama_perusahaan']            = session('nama_perusahaan');
        $view['nama_pemilik']               = session('nama_pemilik');
        $view['email']                      = session('email');
        $view['phone']                      = session('phone');
        $view['alamat']                     = session('alamat');
        $view['kodepos']                    = session('kodepos');
        $view['country']                    = session('country');
        $view['kategori']                   = session('kategori');
        $view['product']                    = session('product');
        $view['website']                    = session('website');
        $view['url']                        = config('app.url').'public/admin/exibitor/create';
        $view['judul']                      = "Create Data Exhibitor";
        return view('exibitor.form',$view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($request->session()->all());
        //
        // $token              = $request->input('_token');
        $nama_perusahaan    = $request->input('nama_perusahaan');
        $nama_pemilik       = $request->input('nama_pemilik');
        $email              = $request->input('email');
        $phone              = $request->input('phone');
        $alamat             = $request->input('alamat');
        $kodepos            = $request->input('kodepos');
        $country            = $request->input('country');
        $kategori           = $request->input('kategori');
        $product            = $request->input('product');
        $website            = $request->input('website');

        $insert['nama_perusahaan']          = $nama_perusahaan;
        $insert['nama_pemilik']             = $nama_pemilik;
        $insert['email']                    = $email;
        $insert['phone']                    = $phone;
        $insert['alamat']                   = $alamat;
        $insert['kodepos']                  = $kodepos;
        $insert['country']                  = $country;
        $insert['kategori']                 = $kategori;
        $insert['product']                  = $product;
        $insert['website']                  = $website;
        $ids   = $this->exibitor->add($insert);
        if($ids > 0){
            $request->session()->flash('notip','<div class="alert alert-success">Data exhibitor berhasil ditambahkan</div>');
            return redirect('/admin/exibitor');
        }else{
            $request->session()->flash('notip','<div class="alert alert-danger">Data exhibitor tidak masuk, silakan ulangi</div>');
            $request->session()->flash('nama_perusahaan',$nama_perusahaan);
            $request->session()->flash('nama_peilik',$nama_pemilik);
            $request->session()->flash('email',$email);
            $request->session()->flash('phone',$phone);
            $request->session()->flash('alamat',$alamat);
            $request->session()->flash('kodepos',$kodepos);
            $request->session()->flash('country',$country);
            $request->session()->flash('kategori',$kategori);
            $request->session()->flash('product',$product);
            $request->session()->flash('website',$website);
            return redirect('/admin/exibitor/create');
        }
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
        $getdata        = $this->exibitor->get_id($id);
        $view['id']                         = $id;
        $view['nama_perusahaan']            = $getdata->nama_perusahaan;
        $view['nama_pemilik']               = $getdata->nama_pemilik;
        $view['email']                      = $getdata->email;
        $view['phone']                      = $getdata->phone;
        $view['alamat']                     = $getdata->alamat;
        $view['kodepos']                    = $getdata->kodepos;
        $view['country']                    = $getdata->country;
        $view['kategori']                   = $getdata->kategori;
        $view['product']                    = $getdata->product;
        $view['website']                    = $getdata->website;
        $view['url']                        = config('app.url').'public/admin/exibitor/edit';
        $view['judul']                      = "Create Data Exhibitor";
        return view('exibitor.form',$view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id                 = $request->input('id');
        $nama_perusahaan    = $request->input('nama_perusahaan');
        $nama_pemilik       = $request->input('nama_pemilik');
        $email              = $request->input('email');
        $phone              = $request->input('phone');
        $alamat             = $request->input('alamat');
        $kodepos            = $request->input('kodepos');
        $country            = $request->input('country');
        $kategori           = $request->input('kategori');
        $product            = $request->input('product');
        $website            = $request->input('website');

        $insert['nama_perusahaan']          = $nama_perusahaan;
        $insert['nama_pemilik']             = $nama_pemilik;
        $insert['email']                    = $email;
        $insert['phone']                    = $phone;
        $insert['alamat']                   = $alamat;
        $insert['kodepos']                  = $kodepos;
        $insert['country']                  = $country;
        $insert['kategori']                 = $kategori;
        $insert['product']                  = $product;
        $insert['website']                  = $website;
        // $ids   = $thisd->exibitor->add($insert);
        if($this->exibitor->edit($insert,$id)){
            $request->session()->flash('notip','<div class="alert alert-success">Data exhibitor berhasil diedit</div>');
            return redirect('/admin/exibitor');
        }else{
            $request->session()->flash('notip','<div class="alert alert-danger">Data exhibitor tidak berhasil diedit, silakan ulangi</div>');
            $request->session()->flash('nama_perusahaan',$nama_perusahaan);
            $request->session()->flash('nama_peilik',$nama_pemilik);
            $request->session()->flash('email',$email);
            $request->session()->flash('phone',$phone);
            $request->session()->flash('alamat',$alamat);
            $request->session()->flash('kodepos',$kodepos);
            $request->session()->flash('country',$country);
            $request->session()->flash('kategori',$kategori);
            $request->session()->flash('product',$product);
            $request->session()->flash('website',$website);
            return redirect('/admin/exibitor/edit/'.$id);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->exibitor->del($id);
        $request->session()->flash('notip','<div class="alert alert-danger">Data exhibitor telah dihapus</div>');
        return redirect('/admin/exibitor');
    }
}
