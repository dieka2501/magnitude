@extends('..template')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Dashboard</a>
            </li>
            <li class="active">
                <strong>Show</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Dashboard Admin </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
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
                    <div class="col-sm-12 m-b-xs">
                    <h1>Welcome To Magnitude</h1>
                    <!-- <select class="input-sm form-control input-s-sm inline">
                        <option value="0">Option 1</option>
                        <option value="1">Option 2</option>
                        <option value="2">Option 3</option>
                        <option value="3">Option 4</option>
                    </select> -->
                    </div>
                    
                </div>
                <div class="row">
                    <div class='col-md-12'>
                        <div id="checkin">
                            
                        </div>
                    </div>
                    <!-- <div class='col-md-6'></div> -->
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th>Total Visitor</th>
                            <th>Total Check In</th>
                            <th>Check In Hall 1</th>
                            <th>Check In Nusantara</th>
                            <th>Check In Hall 7</th>
                            <th>Check In Hall 10</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                        <tr>
                            <td>{{$visitor}}</td>
                            <td>{{$checkin}}</td>
                            <td>{{$hall1}}</td>
                            <td>{{$nusantara}}</td>
                            <td>{{$hall7}}</td>
                            <td>{{$hall10}}</td>
                        </tr>
                        
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div>
    </div>
</div> 
  
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['GATE', 'Total Check In'],
          ['Hall 1',     {{$hall1}}],
          ['Nusantara',      {{$nusantara}}],
          ['Hall 7',  {{$hall7}}],
          ['Hall 10', {{$hall10}}]
        ]);

        var options = {
          title: 'Total Check In Per Gate',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('checkin'));
        chart.draw(data, options);
      }
    </script>
@endsection('content')