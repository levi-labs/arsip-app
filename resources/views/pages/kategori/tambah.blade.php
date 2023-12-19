@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $title }}</h5>
                </div>
                <div class="card-body">

                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/post-kategori') }}" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Kategori</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $kode_kategori }}"
                                        value="{{ $kode_kategori }}" name="kode_kategori" readonly>
                                    @error('kode_kategori')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small> --}}
                                </div>
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" class="form-control" placeholder="keramik" name="nama">
                                    @error('nama')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
