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
                        <!-- <i class="fa fa-chevron-up"></i> -->
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
                    <div class='col-md-6'>
                        <div id="checkin">
                            
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div id="top_lob">
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-md-6'>
                        <div id="top_reg">
                            
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div id="top_pos">
                            
                        </div>
                    </div>
                    <!-- <div class='col-md-6'></div> -->
                </div>
                <div class="table-responsive">
                    <!-- <table class="table table-striped">
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        </tbody>
                    </table> -->
                    
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

    <script type="text/javascript">
      // google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChartTopPos);
      function drawChartTopPos() {
        var data = google.visualization.arrayToDataTable([
          ['Position', 'Total Visitor'],
          ["{{$top_pos0}}", {{$top_pos_jumlah0}}],
          ["{{$top_pos1}}", {{$top_pos_jumlah1}}],
          ["{{$top_pos2}}", {{$top_pos_jumlah2}}]
        ]);

        var options = {
          title: 'Top 3 Visitor Job Position',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('top_pos'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      // google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChartTopReg);
      function drawChartTopReg() {
        var data = google.visualization.arrayToDataTable([
          ['Region', 'Total Visitor'],
          ["{{$top_reg0}}", {{$top_reg_jumlah0}}],
          ["{{$top_reg1}}", {{$top_reg_jumlah1}}],
          ["{{$top_reg2}}", {{$top_reg_jumlah2}}],
          ["{{$top_reg3}}", {{$top_reg_jumlah3}}],
          ["{{$top_reg4}}", {{$top_reg_jumlah4}}],
        ]);

        var options = {
          title: 'Top 5 Visitor Region/City',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('top_reg'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      // google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChartTopLob);
      function drawChartTopLob() {
        var data = google.visualization.arrayToDataTable([
          ['Line Of Business', 'Total Visitor'],
          ["{{$top_lob0}}", {{$top_lob_jumlah0}}],
          ["{{$top_lob1}}", {{$top_lob_jumlah1}}],
          ["{{$top_lob2}}", {{$top_lob_jumlah2}}],
          ["{{$top_lob3}}", {{$top_lob_jumlah3}}],
          ["{{$top_lob4}}", {{$top_lob_jumlah4}}],
        ]);

        var options = {
          title: 'Top 5 Visitor Business',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('top_lob'));
        chart.draw(data, options);
      }
    </script>
@endsection('content')