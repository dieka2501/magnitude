@extends('..template')
@section('content')
  <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>List Seller </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-5 m-b-xs">

                                </div>
                                <div class="col-sm-4 m-b-xs">
                                    
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group"> <span class="input-group-btn">
                                        <a href="/admin/seller/create" class="btn btn-sm btn-primary">Create Seller</a> </span></div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 m-b-xs"><select class="input-sm form-control input-s-sm inline">
                                    <option value="0">Option 1</option>
                                    <option value="1">Option 2</option>
                                    <option value="2">Option 3</option>
                                    <option value="3">Option 4</option>
                                </select>
                                </div>
                                <div class="col-sm-4 m-b-xs">
                                    <div data-toggle="buttons" class="btn-group">
                                        <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                                        <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                                        <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
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
                                        <th>Alamat</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0?>
                                    @foreach($list as $lists)
                                    <?php $i++?>
                                    <tr>
                                    	<td>{{$i}}</td>
                                    	<td>{{$lists->name_seller}}</td>
                                    	<td>{{$lists->email_seller}}</td>
                                    	<td>{{$lists->address_seller}}</td>
                                    	<td>{{$lists->phone}}</td>
                                        <td><a href="/admin/seller/edit/{{$lists->iduser}}" class="btn btn-sm btn-warning">Edit</a>  <a href="/admin/seller/delete/{{$lists->iduser}}" class="btn btn-sm btn-danger" onclick="if(!confirm('Are You Sure?')) return false;">Delete</a></td>
                                    </tr>
                                   	@endforeach()
                                    </tbody>
                                </table>
                                {{$list->render()}}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
@endsection('content')