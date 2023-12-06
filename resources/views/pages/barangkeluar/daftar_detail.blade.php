@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    @if (session('success'))
                        <div class="alert alert-success text-dark" role="alert">{{ session('success') }}</div>
                    @elseif(session('failed'))
                        <div class="alert alert-danger text-dark" role="alert">{{ session('failed') }}</div>
                    @endif
                    <h5>{{ $title }}</h5>

                    {{-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> --}}

                </div>
                <div class="col-sm-4">
                    <form action="{{ url('/tambah-barang-masuk') }}" method="GET">
                        <input type="hidden" name='params' value="{{ $params }}">
                        {{-- <a class="btn btn-primary my-1" href="{{ url('/tambah-barang-masuk/' . $params) }}">Tambah</a> --}}
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
                <div class="card-block table-border-style">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Kode Surat | No Arsip</th>
                                    <th>Quantity Diterima</th>
                                    <th>Tanggal</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr class="text-center">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $dt->kode_barang_masuk }}</td>
                                        <td>{{ $dt->qty_diterima }}</td>
                                        <td>{{ $dt->tanggal_masuk }}</td>

                                        <td>
                                            <a class="btn btn-success btn-sm text-sm"
                                                href="{{ url('/detail-barang-masuk/' . $dt->id) }}">Detail</a>
                                            <a class="btn btn-warning btn-sm text-sm"
                                                href="{{ url('/edit-barang-masuk/' . $dt->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('/hapus-barang-masuk/' . $dt->id) }}">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
