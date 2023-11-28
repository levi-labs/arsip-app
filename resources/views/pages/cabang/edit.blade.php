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
                            <form method="POST" action="{{ url('/update-cabang/' . $data->id) }}" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Cabang</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $data->kode_cabang }}"
                                        value="{{ $data->kode_cabang }}" name="kode_cabang" readonly>
                                    @error('kode_cabang')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small> --}}
                                </div>
                                <div class="form-group">
                                    <label>Nama Cabang</label>
                                    <input type="text" class="form-control" placeholder="Cabang Margonda" name="nama"
                                        value="{{ $data->nama }}">
                                    @error('nama')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email Supplier</label>
                                    <input type="text" class="form-control" placeholder="geraimargonda@gmail.com"
                                        name="email" value="{{ $data->email }}">
                                    @error('email')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No Hp Supplier</label>
                                    <input type="text" class="form-control" placeholder="08123878712" name="no_hp"
                                        value="{{ $data->no_hp }}">
                                    @error('no_hp')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Alamat</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3">{{ $data->alamat }}</textarea>
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
