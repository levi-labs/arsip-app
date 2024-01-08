@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mt-5">
                        <img class="img-thumbnail custom-image" src="{{ $data->getImage() }}" alt="" width="600px;">
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <h5>{{ 'Dari: ' . $data->sumber_barang }}</h5>
                        </div>
                        <hr>
                        <div class="row justify-content-between">
                            <h4>{{ 'No Surat-' . $data->kode_surat }}</h4>
                            <h4>{{ $data->kode_barang_masuk }}</h4>
                        </div>
                        <div class="card-block table-border-style">

                            <div class="table-responsive">
                                <table class="table table-hover">

                                    <tbody>

                                        <tr>
                                            <th>Kode Barang Masuk</th>
                                            <td>{{ $data->kode_barang_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <td>{{ $data->barangs->nama }}</td>
                                        </tr>




                                        <tr>
                                            <th>Harga Beli</th>
                                            <td>@currency($data->harga_beli)</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Masuk</th>
                                            <td>{{ $data->tanggal_masuk }}</td>
                                        </tr>

                                        <tr class="text-center">
                                            <th>Quantity Masuk</th>
                                            <th>Quantity Rusak</th>
                                            <th>Quantity Diterima</th>
                                        </tr>
                                        <tr class="text-center">
                                            <td>{{ $data->qty_masuk . '/' . $data->satuan }}</td>
                                            <td>{{ $data->qty_rusak . '/' . $data->satuan }}</td>
                                            <td>{{ $data->qty_diterima . '/' . $data->satuan }}</td>
                                        </tr>

                                        <tr>
                                            <th colspan="2">Option</th>
                                            <td class="text-center">

                                                <a class="btn btn-warning btn-sm text-sm"
                                                    href="{{ url('/edit-barang-masuk/' . $data->id) }}">Edit</a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ url('/hapus-barang-masuk/' . $data->id) }}">Hapus</a>
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
                        <a class="btn btn-info btn-sm"
                            href="{{ url('/daftar-detail-barang-masuk/' . $data->kode_surat) }}">Kembali</a>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
