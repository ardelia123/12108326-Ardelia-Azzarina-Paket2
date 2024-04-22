@extends('layout.second')

@section('content')
@use('Illuminate\Support\Number')

<form action="{{ route('save-transaction') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="row my-4">
                            @foreach ($errors->all() as $error)
                                <div class="col-md-12">
                                    <div class="alert alert-danger fade show" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <h2>Produk yang dipilih</h2>
                            <table style="width: 100%;">
                                <thead></thead>
                                <tbody>
                                    @foreach ($products as $i => $row)
                                        <input type="hidden" name="products[{{ $i }}][id]"
                                            value="{{ $row['id'] }}">
                                        <input type="hidden" name="products[{{ $i }}][qty]"
                                            value="{{ $row['qty'] }}">
                                            <input type="hidden" name="products[{{ $i }}][total]"
                                            value="{{ $row['total'] }}">
                                            <input type="hidden" name="products[{{ $i }}][price]"
                                            value="{{ $row['price'] }}">
                                        <tr>
                                            <td>{{ $row['name'] }} <br />
                                                <small>Rp{{ number_format($row['price'], 0, ',', '.') }} x
                                                    {{ $row['qty'] }}</small></td>
                                            <td><b>Rp{{ number_format($row['total'], 0, ',', '.') }}</b></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td style="padding-top: 20px; font-size: 20px;"><b>Total</b></td>
                                        <td class="tex-end" style="padding-top: 20px; font-size: 20px;">
                                            <b>Rp{{ number_format($total, 0, ',', '.') }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Nama Pelanggan <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                            <input type="text" name="name" class="form-control form-control-line "
                                                required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Alamat Pelanggan <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control form-control-line " name="address" required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">No Telepon <span class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                            <input type="number" name="no_hp" class="form-control form-control-line "
                                                onkeypress="if(this.value.length==13) return false;" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-end">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection