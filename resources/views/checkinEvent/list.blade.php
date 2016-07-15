@extends('..template')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Check In Visitor</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Config::get('app.url')}}public/admin">Home</a>
            </li>
            <li>
                <a href="{{Config::get('app.url')}}public/admin/visitor">Check In Visitor</a>
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

                    <h5>List Visitor Check In </h5>
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
                    <div class="container"> 
                        <div class="row">
                            <div class="col-md-11 text-right">
                                @if($username != "admin1week")
                                <a href="{!!config('app.url')!!}public/export/checkin" class="btn btn-primary">Export To Excel</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
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
                                <th>Gate</th>
                                <th>Date Check In</th>
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
                                <td>{{$lists->gate}}</td>
                                <td>{{$lists->date_checkin}}</td>
                                <td><a href="{{Config::get('app.url')}}public/admin/visitor/history/{{$lists->id_visitor}}" class="btn btn-sm btn-warning">History</a></td>
                            </tr>
                            @endforeach()
                            </tbody>
                        </table>
                        <?php echo $list->render() ?>
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