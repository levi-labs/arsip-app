@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    @if (session('reset-password'))
                        <div class="alert alert-info text-dark" role="alert">{!!session('reset-password') !!}</div>
                    @endif
                         @if (session('success'))
                            <div class="alert alert-success text-dark" role="alert">{!!session('success') !!}</div>
                        @endif

                    <h5>{{ $title }}</h5>
                    {{-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> --}}

                </div>
                <div class="col-sm-4">
                    <a class="btn btn-primary my-1" href="{{ url('/tambah-user') }}">Tambah</a>
                </div>
                <div class="card-block table-border-style">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr class="text-center">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $dt->nama }}</td>
                                        <td>{{ $dt->username }}</td>
                                        <td>{{ $dt->level }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm text-sm"
                                                href="{{ url('/reset-password/' . $dt->id) }}">Reset Password</a>
                                            <a class="btn btn-warning btn-sm text-sm"
                                                href="{{ url('/edit-user/' . $dt->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm text-sm"
                                                href="{{ url('/hapus-user/' . $dt->id) }}">Hapus</a>
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
