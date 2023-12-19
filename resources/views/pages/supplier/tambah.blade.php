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
                            <form method="POST" action="{{ url('/post-supplier') }}" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Supplier</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $kode_supplier }}"
                                        value="{{ $kode_supplier }}" name="kode_supplier" readonly>
                                    @error('kode_supplier')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small> --}}
                                </div>
                                <div class="form-group">
                                    <label>Nama Supplier</label>
                                    <input type="text" class="form-control" placeholder="PT.NUSAINDAHSARI"
                                        name="nama">
                                    @error('nama')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email Supplier</label>
                                    <input type="text" class="form-control" placeholder="PT.NUSAINDAHSARI@gmail.com"
                                        name="email">
                                    @error('email')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No Hp Supplier</label>
                                    <input type="text" class="form-control" placeholder="PT.NUSAINDAHSARI@gmail.com"
                                        name="no_hp">
                                    @error('no_hp')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Alamat</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3"></textarea>
                                    @error('alamat')
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
