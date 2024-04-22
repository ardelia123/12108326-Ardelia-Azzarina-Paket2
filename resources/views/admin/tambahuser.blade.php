@extends('layout.main')

@section('content')
<div class="box box-info">
  <div class="box-body">
    <h4 class="card-title">Tambah User</h4>
     <form action="/register" method="post" enctype="multipart/form-data"> 
      @csrf
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12">Email<span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" name="email" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12">Nama<span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
        </div>
     </div>
     <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12">Role <span class="text-danger">*</span></label>
                <div class="col-md-12">
                <select class="form-control" id="" name="role">
                <option selected disabled>Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="employee">Pegawai</option>
                </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12">Password <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" name="password" class="form-control form-control-line ">
                </div>
            </div>
        </div>
     </div> 
     <button type="submit" class="pull-right btn btn-warning padding-top-5" style="margin-top: 15px; margin-right: 15px">Send
      <i class="fa fa-arrow-circle-right"></i></button>
    </form>
  </div>  
</div>

@endsection