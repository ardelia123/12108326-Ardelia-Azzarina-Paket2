@extends('layout.main')

@section('content')


<h4 class="card-title">Data Produk</h4>
< class="box box-info">
  <div class="box-body">
        <div class="mb-3">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Cari produk..." class="form-control">
                <button type="submit" class="btn btn-primary mt-2">Cari</button>
            </form>
        </div>
        <div class="row d-flex align-items-end m-3">
            <a href="/admin.tambahproduk" class="btn btn-primary">Tambah Produk</a>
            @if (Session('success'))
            <div style="width: 100%; padding: 10px">
            <ul class="alert alert-info" role="alert">{{ session('success') }}</ul>
            </div>
            @endif
        </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <caption>List Produk</caption>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col"> </th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $i = 1;
                    @endphp
                    @foreach( $product as $pdc )
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>
                            <a href="../assets/images/product/{{$pdc->gambar}}" target="_blank">
                                <img src="{{ asset("assets/product/{$pdc->gambar}") }}" width="120">
                            </a>
                        </td>
                        <td>{{$pdc->name}}</td>
                        <td>Rp. Rp{{ number_format($pdc->price, 0, ',', '.') }}</td>
                        <td>{{$pdc->stock}}</td>
                        <td>
                            <a href="/edit-product/{{$pdc->id}}" class="btn waves-effect waves-light btn-rounded btn-warning">Edit</a>
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-info" data-toggle="modal"
                                    data-target="#modal-{{$pdc->id}}">Update Stock</button>
                            <form action="/delete-product/{{$pdc->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-danger">Hapus</button>
                            </form>
                        </td>
                        <div class="modal fade" id="modal-{{$pdc->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="scrollableModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="scrollableModalTitle">Upload Stok</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>upload stok ({{$pdc->name}})</p>
                                            <form action="{{route('update-stock', $pdc->id)}}"  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label class="col-md-12">Stok <span class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="stok" class="form-control form-control-line " value="{{ $pdk['stok'] }}">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success">Edit Stok</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
</div>

@endsection