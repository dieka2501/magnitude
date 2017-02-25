@extends('..template')
@section('content')
<p>{!!session('notip')!!}</p>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
            	
                <h5>{!!$judul!!}</h5>
                <div class="ibox-tools">
                    <!-- <a class="collapse-link">
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
                    </a> -->
                </div>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" method="POST" action="{!!$url!!}">
                	<input type='hidden' name="_token" value="{{csrf_token()}}">
                    <div class="form-group"><label class="col-sm-2 control-label">Company Name</label>

                        <div class="col-sm-10"><input type="text" class="form-control" name='nama_perusahaan' id='nama_perusahaan' value="{!!$nama_perusahaan!!}" required="required">
                        <input type="hidden" class="form-control" name='id' id='id' value="{!!$id!!}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Contact Person</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik" value='{!!$nama_pemilik!!}' required="required"/> 
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10"><input type="email" class="form-control" name="email" id="email" value='{!!$email!!}' required="required"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-lg-2 control-label">Phone</label>

                        <div class="col-lg-10"><input type="text" placeholder="" class="form-control" name="phone" id="phone" value="{!!$phone!!}" required="required"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Company Address</label>

                        <div class="col-sm-10"><input type="text" placeholder="" class="form-control" name="alamat" id="alamat" value="{!!$alamat!!}"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-lg-2 control-label">Zipcode</label>

                        <div class="col-lg-10"><input type="text" placeholder="" class="form-control" name="kodepos" id="kodepos" value="{!!$kodepos!!}"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-lg-2 control-label">Country</label>

                        <div class="col-lg-10"><input type="text" placeholder="" class="form-control" name="country" id="country" value="{!!$country!!}"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- <div class="hr-line-dashed"></div> -->
                    <div class="form-group"><label class="col-lg-2 control-label">Company Business</label>

                        <div class="col-lg-10"><input type="text" placeholder="" class="form-control" name="kategori" id="kategori" value="{!!$kategori!!}"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-lg-2 control-label">Company Product</label>

                        <div class="col-lg-10"><input type="text" placeholder="" class="form-control" name="product" id="product" value="{!!$product!!}"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-lg-2 control-label">Company Website</label>

                        <div class="col-lg-10"><input type="text" placeholder="" class="form-control" name="website" id="website" value="{!!$website!!}"></div>
                    </div>
                                       
                    
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{!!config('app.url')!!}public/admin/exibitor" class="btn btn-white" >Cancel</a>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')