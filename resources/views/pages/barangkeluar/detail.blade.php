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
                            <h5>{{ 'Tujuan: ' . $data->nama_tujuan . ' / ' . $data->jenis_tujuan }} </h5>
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
                                            <td>@currency($data->harga_jual)</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Masuk</th>
                                            <td>{{ $data->tanggal_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Quantity Keluar</th>
                                            <td>{{ $data->qty_keluar . ' / ' . $data->satuan }}</td>
                                        <tr>
                                            <th colspan="2">Option</th>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm text-sm"
                                                    href="{{ url('/edit-barang-keluar/' . $data->id) }}">
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ url('/hapus-barang-keluar/' . $data->id) }}">
                                                    Hapus
                                                </a>
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
                        <a class="btn btn-info btn-sm" href="{{ url('/daftar-detail-barang-keluar/' . $data->kode_surat) }}">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
