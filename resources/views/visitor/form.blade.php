@extends('..template')
@section('content')
<p>{{session('notip')}}</p>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
            	
                <h5>Form Editor Seller</h5>
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
                <form class="form-horizontal" method="POST" action="/admin/seller/create">
                	<input type='hidden' name="_token" value="{{csrf_token()}}">
                    <div class="form-group"><label class="col-sm-2 control-label">Nama Lengkap</label>

                        <div class="col-sm-10"><input type="text" class="form-control" name='nama' id='nama' value=""></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10"><input type="password" class="form-control" name="password" id="password" /> 
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>

                        <div class="col-sm-10"><input type="password" class="form-control" name="conf-password" id="conf-password"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-10"><input type="text" placeholder="" class="form-control" name="alamat" id="alamat" value=""></div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Zipcode</label>

                        <div class="col-lg-10"><input type="text" placeholder="" class="form-control" name="zipcode" id="zipcode" value=""></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                        <div class="col-lg-10"><input type="email" placeholder="" class="form-control" name="email" id="email" value=""></div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Phone</label>

                        <div class="col-lg-10"><input type="text" placeholder="" class="form-control" name="phone" id="phone" value=""></div>
                    </div>
                                       
                    
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="/admin/seller" class="btn btn-white" >Cancel</a>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')