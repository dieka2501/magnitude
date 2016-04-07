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
                <strong>History</strong>
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

                    <h5>History Visitor </h5>
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
                        <a href="{!!config('app.url')!!}public/admin/visitor">
                            Back
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Visitor Name</th>
                                    <td>{!!$visitor->nama_visitor!!}</td>
                                </tr>
                                <tr>
                                    <th>Company</th>
                                    <td>{!!$visitor->perusahaan!!}</td>
                                </tr>
                                <tr>
                                    <th>Position</th>
                                    <td>{!!$visitor->jabatan!!}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{!!$visitor->email!!}</td>
                                </tr>
                                <tr>
                                    <th>Region/City</th>
                                    <td>{!!$visitor->region!!}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{!!$visitor->country!!}</td>
                                </tr>
                            </table>    
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo $visitor->phone ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $visitor->alamat ?></td>
                                </tr>
                                
                                <tr>
                                    <th width="50%">Line Of Business</th>
                                    <td><?php echo $visitor->bidang ?></td>
                                </tr>
                                <tr>
                                    <th>Interest Product</th>
                                    <td><?php echo $visitor->interest_product ?></td>
                                </tr>
                                <tr>
                                    <th>Purpose</th>
                                    <td><?php echo $visitor->purpose ?></td>
                                </tr>
                            </table>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 table-responsive">
                            <strong>Check-In Event Region/City</strong>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Check-in Date</th>
                                        <th>Region/City</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($event as $events)
                                    <tr>
                                        <td>{!!date('d F Y',strtotime($events->date_checkin))!!}</td>
                                        <td>{!!$events->nama_kota!!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <strong>Check-In Booth Region/City</strong>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Check-in Date</th>
                                        <th>Exibitor</th>
                                        <th>Region/City</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($booth as $booths)
                                    <tr>
                                        <td>{!!date('d F Y',strtotime($booths->date_checkin))!!}</td>
                                        <td>{!!$booths->nama_perusahaan!!}</td>
                                        <td>{!!$booths->nama_kota!!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="table-responsive">
                        
                    </div> -->

                </div>
            </div>
        </div>

    </div>   
</div>
  
@endsection('content')