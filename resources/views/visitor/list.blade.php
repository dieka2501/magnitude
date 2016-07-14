@extends('..template')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Visitor</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Config::get('app.url')}}public/admin">Home</a>
            </li>
            <li>
                <a href="{{Config::get('app.url')}}public/admin/visitor">Visitor</a>
            </li>
            <li class="active">
                <strong>List</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <p><strong>{{$notip}}</strong></p>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>List Visitor </h5>
                    <div class="ibox-tools">

                        <!-- <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a> -->
                        <!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a> -->
                        <!-- <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul> -->
                        <!-- <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a> -->
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                            {!!Form::open(['url'=>$url,'method'=>'POST','files'=>true,'class'=>'form-inline'])!!}
                                <label>Upload Data Visitor</label>
                                {!!Form::file('files',['class'=>'form-control'])!!}
                                <button class="btn btn-success">Upload</button>
                            {!!Form::close()!!}
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            
                        </div>
                        <div class="col-sm-3">
                            <!-- <div class="input-group"> <span class="input-group-btn">
                                <a href="{{Config::get('app.url')}}public/admin/visitor/create" class="btn btn-sm btn-primary">Create Visitor</a> </span>
                            </div> -->
                        </div>
                    </div>
                    <label>Filter Data</label>
                    <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-4 m-b-xs">
                            {!!Form::select('position[]',$arr_position,$position,['class'=>'form-control','multiple'])!!}
                        </div>
                        <div class="col-md-4 m-b-xs">
                            {!!Form::select('region[]',$arr_region,$region,['class'=>'form-control','multiple'])!!}
                        </div>
                        <div class="col-md-4 m-b-xs">
                            {!!Form::select('country[]',$arr_country,$country,['class'=>'form-control','multiple'])!!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 m-b-xs">
                             {!!Form::select('lob[]',$arr_lob,$lob,['class'=>'form-control','multiple'])!!}
                        </div>
                        <div class="col-md-4 m-b-xs">
                            
                             {!!Form::select('interest_product[]',$arr_interest_product,$interest_product,['class'=>'form-control','multiple'])!!}
                    
                        </div>
                        <div class="col-md-4 m-b-xs">
                            <input type="text" name="purpose" class="form-control" value="{!!$purpose!!}" placeholder="Purpose Of Visit"></input>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 m-b-xs">
                            <input type="text" name="source" class="form-control" value="{!!$source!!}" placeholder="Source Of Information"></input>
                        </div>
                        <div class="col-md-4 m-b-xs">
                        <input type="text" name="email" class="form-control" value="{!!$email!!}" placeholder="Email Of Visitor"></input>
                        </div>
                        <div class="col-md-4 m-b-xs">
                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <button class="btn btn-primary">Search</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{!!config('app.url')!!}public/export/visitor" class="btn btn-success" type="button">Export To Excel</a>
                        </div>
                    </div>
                    </form>
                    <div class="table-responsive">
                        <p>{{session('alert')}}</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>

                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Line Of Business</th>
                                <th>Region</th>
                                <th>Date Register</th>
                                <th>History</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;
                            	if(Input::has('page')){
                            		$haspage = Input::get('page');
                            	}else{
                            		$haspage = 1;
                            	}
                                $num = 20 * ($haspage-1);
                            // if((Input::get('page') =='1')){
                            //         $i=0;   
                            //     }else{
                                    
                            //     }
                                $numawal  = $num +1;
                                $numakhir = $num +20;

                            ?>
                            @foreach($list as $lists)
                            <?php 
                            $i++;
                            $nums = $num +$i ?>

                            <tr>
                                <td>{{$nums}}</td>
                                <td>{{$lists->nama_visitor}}</td>
                                <td>{{$lists->email}}</td>
                                <td>{{$lists->phone}}</td>
                                <td>{{$lists->perusahaan}}</td>
                                <td>{{$lists->bidang}}</td>
                                <td>{{$lists->region}}</td>
                                <td>{{$lists->created_at}}</td>
                                <td><a href="{{Config::get('app.url')}}public/admin/visitor/history/{{$lists->id}}" class="btn btn-sm btn-warning">History</a></td>
                            </tr>
                            @endforeach()
                            </tbody>
                        </table>
                        <?php echo $list->appends(['position'=>$position,'region'=>$region,'country'=>$country,'lob'=>$lob,'interest_product'=>$interest_product,'purpose'=>$purpose,'source'=>$source,'email'=>$email])->render() ?>
                    </div>
                    <strong>{!!$numawal!!} - {!!$numakhir!!} of {!!$datacount!!}</strong>
                </div>
            </div>
        </div>

    </div>   
</div>
<div>
    
</div>
  
@endsection('content')