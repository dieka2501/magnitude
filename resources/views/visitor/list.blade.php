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
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                            <!-- <select class="input-sm form-control input-s-sm inline">
                                <option value="0">Option 1</option>
                                <option value="1">Option 2</option>
                                <option value="2">Option 3</option>
                                <option value="3">Option 4</option>
                            </select> -->
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            <!-- <div data-toggle="buttons" class="btn-group">
                                <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                                <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                                <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                            </div> -->
                        </div>
                        <div class="col-sm-3"><!-- 
                            <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span>
                            </div> -->
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
                                <th>History</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0?>
                            @foreach($list as $lists)
                            <?php $i++?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$lists->nama_visitor}}</td>
                                <td>{{$lists->email}}</td>
                                <td>{{$lists->phone}}</td>
                                <td>{{$lists->perusahaan}}</td>
                                <td>{{$lists->bidang}}</td>
                                <td>{{$lists->region}}</td>
                                <td><a href="{{Config::get('app.url')}}public/admin/visitor/history/{{$lists->id}}" class="btn btn-sm btn-warning">History</a></td>
                            </tr>
                            @endforeach()
                            </tbody>
                        </table>
                        <?php echo $list->render() ?>
                    </div>

                </div>
            </div>
        </div>

    </div>   
</div>
  
@endsection('content')