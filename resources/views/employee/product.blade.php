@extends('layout.second')

@section('content')
<div class="box box-info">
    <div class="box-body">
        <div class="box-body">
            <h4 class="card-title">Data Produk</h4>
            <div class="mb-3">
                <form action="" method="GET">
                    <input type="text" name="search" placeholder="Cari produk..." class="form-control">
                    <button type="submit" class="btn btn-primary mt-2">Cari</button>
                </form>
                </div>
            <div class="table-responsive">
                <table class="table">
                    <caption>List of users</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
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
                                <a href="../assets/images/product/{{$pdc->image}}" target="_blank">
                                    <img src="{{ asset("assets/product/{$pdc->image}") }}" width="120">
                                </a>
                            </td>
                            <td>{{$pdc->name}}</td>
                            <td>Rp. Rp{{ number_format($pdc->price, 0, ',', '.') }}</td>
                            <td>{{$pdc->stock}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection