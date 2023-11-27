@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $title }}</h5>
                    {{-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> --}}

                </div>
                <div class="col-sm-4">
                    <a class="btn btn-primary my-1" href="{{ url('/tambah-barang') }}">Tambah</a>
                </div>
                <div class="card-block table-border-style">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stock</th>
                                    <th>Harga</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 10; $i++)
                                    <tr class="text-center">
                                        <th scope="row">{{ $i + 1 }}</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>@3000</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm text-sm"
                                                href="{{ url('/edit-barang') }}">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="{{ url('/hapus-barang') }}">Hapus</a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
