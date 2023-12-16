@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @if (session('failed'))
                        <div class="alert alert-danger" role="alert">{{ session('failed') }}</div>
                    @elseif(session('success'))
                        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif
                    {{-- <h5>Basic Componant</h5> --}}
                </div>
                <div class="card-body">
                    <h5>{{ $title }}</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/update-barang-keluar/' . $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Barang Masuk</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" placeholder="{{ $data->kode_barang_keluar }}"
                                           value="{{ $data->kode_barang_keluar }}" readonly name="kode_barang_keluar">
                                    @error('kode_barang_keluar')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror

                                </div>

                                @if (strtolower(session()->get('tujuan')) == 'cabang' || $data->jenis_tujuan == 'Cabang')
                                    <div class="form-group">

                                        <label for="exampleFormControlSelect1">

                                            {{ $data->jenis_tujuan == 'Cabang' ? ucfirst('cabang') : ucfirst('customer') }}
                                            <input type="hidden" name="jenis_tujuan" value="{{$data->jenis_tujuan}}">

                                        </label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="nama_tujuan">
                                            <option selected disabled>Pilih</option>
                                            @foreach ($tujuan_barang as $tb)
                                                <option {{$tb->nama == $data->nama_tujuan ? 'selected' : ''}}>{{ $tb->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('nama_tujuan')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                @if (session()->get('tujuan') == 'customer')
                                    <div class="form-group">
                                        <label>Nama Customer</label>
                                        <input type="hidden" name="jenis_tujuan" value='customer'>
                                        <input type="text" class="form-control" placeholder="4000" name="nama_tujuan">
                                        @error('nama_tujuan')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="number" class="form-control" placeholder="4000" name="harga_jual" value="{{$data->harga_jual}}"
                                           min="0">
                                    @error('harga_jual')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Quantity Keluar</label>
                                    <input type="number" class="form-control" placeholder="0" name="qty_keluar" value="{{$data->qty_keluar}}"
                                           min="0">
                                    @error('qty_keluar')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto Surat</label>
                                    <input type="file" class="form-control" placeholder="" name="foto_surat">
                                    <span class="text-danger text-sm">{{$data->foto_surat}}</span>
                                    @error('foto_surat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode Surat Jalan</label>
{{--                                @if (session()->get('surat') || $data->kode_surat != null)--}}
{{--                                    <input type="text" class="form-control" placeholder="Kode Surat" name="kode_surat"--}}
{{--                                           value="{{ session()->get('surat') ?? $data->kode_surat}}" readonly>--}}
{{--                                @else--}}
{{--                                    <input type="text" class="form-control" placeholder="Kode Surat" name="kode_surat">--}}
{{--                                @endif--}}
                                <input type="text" class="form-control" placeholder="Kode Surat" name="kode_surat" value="{{$data->kode_surat}}" readonly>
                                @error('kode_surat')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Barang</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="barang">
                                    <option selected disabled>Pilih</option>
                                    @foreach ($barang as $brg)
                                        <option {{$brg->id == $data->barang_id ? 'selected' : ''}} value="{{ $brg->id }}">{{ $brg->nama }}</option>
                                    @endforeach
                                </select>
                                @error('barang')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control" placeholder="Unit/Pcs/Dus/Kg" name="satuan" value="{{$data->satuan}}">
                                @error('satuan')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <input type="date" class="form-control" placeholder="0" name="tanggal_keluar" value="{{$data->tanggal_keluar}}">
                                @error('tanggal_keluar')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row justify-content-between mt-3">

                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-warning"
                                            onclick="window.location.href='/barang-keluar'">Daftar Barang
                                        Keluar</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Input group -->
        </div>
    </div>

@endsection
