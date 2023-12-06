@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>PT.ABC</h5>
                </div>
                <div class="card-body">
                    <h5>{{ $title }}</h5>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/arsip-masuk') }}" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Surat</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="kode_surat">
                                    @error('kode_surat')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.</small> --}}
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-block  btn-primary">Submit</button>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    @if (session('success'))
                        <div class="alert alert-success text-dark" role="alert">{{ session('success') }}</div>
                    @endif
                    <h5>{{ $title }}</h5>
                    <hr>
                    @isset($final_result)
                        <h6>{{ $final_result }}</h6>
                        <h6>{{ 'Nomor Surat: ' . $data->kode_surat }}</h6>
                    @endisset

                    {{-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> --}}

                </div>

                <div class="card-block table-border-style">
                    @if (isset($final_result))
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Kode Surat | No Arsip</th>
                                        <th>Tanggal</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="text-center">
                                        <th scope="row">1</th>
                                        <td>{{ $data->kode_surat }}</td>
                                        <td>{{ $data->tanggal_masuk }}</td>


                                    </tr>


                                </tbody>

                            </table>
                            <div class="row text-right">
                                <div class="col-sm-12">
                                    <p>{{ $endtime . ' milesecond' }}</p>
                                </div>

                            </div>

                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Kode Surat | No Arsip</th>
                                        <th>Tanggal</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr class="text-center">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $dt->kode_surat }}</td>
                                            <td>{{ $dt->tanggal_masuk }}</td>

                                            <td>
                                                <a class="btn btn-success btn-sm text-sm"
                                                    href="{{ url('/detail-arsip-masuk/' . $dt->kode_surat) }}">Detail</a>
                                                {{-- <a class="btn btn-warning btn-sm text-sm"
                                                    href="{{ url('/edit-barang/' . $dt->id) }}">Edit</a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ url('/hapus-barang/' . $dt->id) }}">Hapus</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="row text-right">
                                <div class="col-sm-12">
                                    <p>{{ $endtime . ' milesecond' }}</p>
                                </div>

                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
