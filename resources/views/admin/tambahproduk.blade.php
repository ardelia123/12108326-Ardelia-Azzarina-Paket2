@extends('layout.main')

@section('content')
<div class="box box-info">
  <div class="box-body">
    <h4 class="card-title">Tambah Produk</h4>
     <form action="{{ route('store-product') }}" method="post" enctype="multipart/form-data"> 
      @csrf
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12">Nama Produk<span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12">Gambar Produk<span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="file" name="image" class="form-control" accept="image/png, image/jpg, image/jpeg">
                </div>
            </div>
        </div>
     </div>
     <div class="row">
       <div class="col-md-6">
          <div class="form-group">
              <label class="col-md-12">Harga <span class="text-danger">*</span></label>
              <div class="col-md-12">
                  <input type="text" name="price" class="form-control">
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label class="col-md-12">Stok <span class="text-danger">*</span></label>
              <div class="col-md-12">
                  <input type="text" name="stock" class="form-control">
              </div>
          </div>
        </div>
     </div> 
     <button type="submit" class="pull-right btn btn-warning" style="margin-top: 15px; margin-right: 15px">Send
      <i class="fa fa-arrow-circle-right"></i></button>
    </form>
  </div>  
</div>

@endsection