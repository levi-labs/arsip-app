@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mt-5">
                        <img class="img-thumbnail custom-image" src="{{ $barang->getImage() }}" alt="" width="600px;">
                    </div>
                    <div class="col-md-6">
                        <div class="row justify-content-between">
                            <h4>{{ $barang->nama }}</h4>
                            <h4>{{ $barang->kode_barang }}</h4>
                        </div>
                        <div class="card-block table-border-style">

                            <div class="table-responsive">
                                <table class="table table-hover">

                                    <tbody>

                                        <tr>
                                            <th>Kode Barang</th>
                                            <td>{{ $barang->kode_barang }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <td>{{ $barang->nama }}</td>
                                        </tr>

                                        <tr>
                                            <th>Stock</th>
                                            <td>{{ $barang->stock }}</td>
                                        </tr>

                                        <tr>
                                            <th>Harga</th>
                                            <td>@currency($barang->harga_barang)</td>
                                        </tr>

                                        <tr>
                                            <th>Option</th>
                                            <td>

                                                <a class="btn btn-warning btn-sm text-sm"
                                                    href="{{ url('/edit-barang/' . $barang->id) }}">Edit</a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ url('/hapus-barang/' . $barang->id) }}">Hapus</a>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row justify-content-start">
                    <div class="col-sm-4">
                        <a class="btn btn-info btn-sm" href="{{ url('/barang') }}">Kembali</a>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
