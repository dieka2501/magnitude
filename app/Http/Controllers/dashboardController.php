<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\visitor;
use App\checkinEvent;

use App\region;
use App\position;
use App\business;
use App\purpose;
use App\sourceInfo;
use App\kategori;

class dashboardController extends Controller
{
    function __construct(){
        $this->middleware('auth');
        $this->visitor = new visitor;
        $this->checkin = new checkinEvent;
        $this->visitor = new visitor;
        $this->kategori = new kategori;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function indexadmin(Request $request)
    {
        // View::share('username',session('username'));
        
        // var_dump($request->session()->all());
        // $get_visitor        = count($this->visitor->get_visitor_today()); 
        $date_reg           = date_create(session('date_register'));
        $valid_until        = session('valid_until');
        date_add($date_reg,date_interval_create_from_date_string($valid_until.' days'));
        $date_exp   = date_format($date_reg,'d F Y');
        $pos = 0;
        $reg = 0;
        $lob = 0;
        $get_hall1          = count($this->checkin->get_checkin_all_hall1()); 
        $get_nusantara      = count($this->checkin->get_checkin_all_nusantara()); 
        $get_hall7          = count($this->checkin->get_checkin_all_hall7()); 
        $get_hall10         = count($this->checkin->get_checkin_all_hall10()); 
        $get_top_pos        = $this->visitor->get_top_position();
        $get_top_region     = $this->visitor->get_top_region();
        $get_top_lob        = $this->visitor->get_top_lob();
        // $total_checkin      = count($this->checkin->get_checkin_today());
        $view['role']          = session('role');
        // $view['visitor']       = $get_visitor;
        foreach ($get_top_pos as $top_pos) {
            $view['top_pos_jumlah'.$pos]       = $top_pos->jumlah;
            $view['top_pos'.$pos]              = $top_pos->jabatan;
            $pos++;
        }
        foreach ($get_top_region as $top_region) {
            $view['top_reg_jumlah'.$reg]       = $top_region->jumlah;
            $view['top_reg'.$reg]              = $top_region->region;
            $reg++;
        }
        foreach ($get_top_lob as $top_lob) {
            $view['top_lob_jumlah'.$lob]       = $top_lob->jumlah;
            $view['top_lob'.$lob]              = $top_lob->bidang;
            $lob++;
        }
        
        $view['hall1']         = $get_hall1;
        $view['nusantara']     = $get_nusantara;
        $view['hall7']         = $get_hall7;
        $view['hall10']        = $get_hall10;
        view()->share('date_exp', $date_exp);
        view()->share('username', session('username'));
       
        return view('dashboard.indexadmin',$view);
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
    public function destroy($id)
    {
        //
    }

    public function logout(){
        // var_dump(session()->flush());
        // if(session()->flush()){
            session()->flush();
            return redirect('/login');  
        // }else{
        //     return redirect('/admin');
        // }
    }

    public static function pecahData($modelName, $nameField, $nameText)
    {
        $json = [];
        $arrayname = array();
        foreach ($modelName as $key) {
            if (!empty($key[$nameField])) {               
                $json[] = ['id'=>$key[$nameField],'text'=>$key[$nameField]];
            }
        }
        $arrayname = array(
            'text' => $nameText,
            'children'=> $json            
        );
        return $arrayname;
    }

    public function filterParam($fieldName,$puras)
    {
       $param = '';
        for ($i=0; $i < sizeof($puras) ; $i++) { 
            $param = $param.''.$fieldName.' = '."'$puras[$i]'".' ';
            if ($i != sizeof($puras)-1 ) {
                $param = $param.'OR ';
            }
        }

        return $param;
    }
    public static function postFilter($request)
    {
        $filter = $request->get('data');
        return $filter;
    }

    public function searchQuery($value)
    {
        $data = $this->visitor->searchCountry($value);

    }

    public function filterResult($param1, $param2)
    {
        $difilter = $this->filterParam($param1, $param2);
        $data =  $this->visitor->searchQuery($param1,$difilter); 

        return $data;
    }

    public function allQuery($filter)
    {
        $data1 =  $this->filterResult("region",$filter);
        $data2 =  $this->filterResult("bidang",$filter);
        $data3 =  $this->filterResult("jabatan",$filter);
        $data4 =  $this->filterResult("purpose",$filter);
        $data5 =  $this->filterResult("source_information",$filter);
        $data6 =  $this->filterResult("interest_product",$filter);
        $data7 =  $this->filterResult("country",$filter);

        $data = array_merge($data1,$data2,$data3,$data4,$data5,$data6,$data7);
        return $data;
    }


    public function filter()
    {
        //Get data From model
        $countrys            =   $this->visitor->getAllCountry();
        $regions             =   $this->visitor->getAllRegion();
        $positions           =   $this->visitor->getAllPosition();
        $lineBusiness        =   $this->visitor->getAllLineBusiness();
        $purpose             =   $this->visitor->getAllPurpose();
        $sourceInformation   =   $this->visitor->getAllSourceInformation();
        $interestProducts    =   $this->kategori->getAllKategoriName();        

        $dataKategori = $this->pecahData($interestProducts,'nama_kategori','Interest Product');
        $dataRegion = $this->pecahData($regions,'region','City / Region');
        $dataCountry = $this->pecahData($countrys,'country','Country');
        $dataPosition = $this->pecahData($positions,'jabatan','Position');
        $dataPurpose = $this->pecahData($purpose,'purpose','Purpose / Need');
        $dataInformation = $this->pecahData($sourceInformation,'source_information','Source Information');
        $dataBusiness = $this->pecahData($lineBusiness,'bidang','Line Of Business');
        $data = array($dataCountry, $dataRegion, $dataPosition, $dataBusiness, $dataPurpose,$dataInformation, $dataKategori);  
       return response()->json($data);
    }
       public function dataTesting(Request $request)
        {
            $puras = $request->get('data');
            $datass =  $this->allQuery($puras);
        
            $rows = [];

            foreach ($datass as $key ) {                 
            $rows[] = ["c" =>  array( 
                                    array("v"=>$key->nama,"f"=>null),
                                    array("v"=>$key->total,"f"=>null,)
                                )];
        }

        $sample = array(
                "cols" => array(
                    array("id" => "" , "label" => "Topping" , "patterns" => "" , "type" => "string"),
                    array("id" => "" , "label" => "Slices" , "patterns" => "" , "type" => "number")
                ),
                "rows" => $rows 
        );
        $encode = json_encode($sample);     
        return $encode;
        return response()->json($sample);
    }
}
