@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @if (session('failed'))
                        <div class="alert alert-danger" role="alert">{{ session('failed') }}</div>
                    @endif

                    <h5>Basic Componant</h5>
                </div>
                <div class="card-body">
                    <h5>{{ $title }}</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/update-barang-masuk/' . $data->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Barang Masuk</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $data->kode_barang_masuk }}"
                                        value="{{ $data->kode_barang_masuk }}" readonly name="kode_barang_masuk">
                                    @error('kode_barang_masuk')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">

                                    <label
                                        for="exampleFormControlSelect1">{{ $data->kategori_sumber == 'cabang' ? ucfirst('cabang') : ucfirst('supplier') }}</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="sumber_barang">

                                        <option selected disabled>Pilih</option>
                                        @foreach ($sumber_barang as $sb)
                                            <option {{ $sb->nama == $data->sumber_barang ? 'selected' : '' }}>
                                                {{ $sb->nama }}</option>
                                        @endforeach


                                    </select>
                                    @error('sumber_barang')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" class="form-control" placeholder="4000" name="harga_beli"
                                        value="{{ $data->harga_beli }}">
                                    @error('harga_beli')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Quantity Masuk</label>
                                    <input type="number" class="form-control" placeholder="0" name="qty_masuk"
                                        value="{{ $data->qty_masuk }}">
                                    @error('qty_masuk')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto Surat</label>
                                    <input type="file" class="form-control" placeholder="" name="foto_surat"><span
                                        class="text-sm text-danger">
                                        {{ $data->foto_surat }}
                                    </span>
                                    @error('foto_surat')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Kode Surat Jalan <span class="text-sm text-danger"> | 7 digit terakhir surat jalan (
                                        3150OUT)</span></label>
                                <input type="text" class="form-control" placeholder="Text" name="kode_surat"
                                    value="{{ $data->kode_surat }}">
                                @error('kode_surat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Barang</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="barang">
                                    <option selected disabled>Pilih</option>
                                    @foreach ($barang as $brg)
                                        <option {{ $brg->id == $data->barang_id ? 'selected' : '' }}
                                            value="{{ $brg->id }}">{{ $brg->nama }}</option>
                                    @endforeach
                                </select>
                                @error('barang')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control" placeholder="Unit/Pcs/Dus/Kg" name="satuan"
                                    value="{{ $data->satuan }}">

                                @error('satuan')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Quantity Rusak</label>
                                <input type="number" class="form-control" placeholder="0" name="qty_rusak"
                                    value="{{ $data->qty_rusak }}">
                                @error('qty_rusak')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" placeholder="0" name="tanggal_masuk"
                                    value="{{ $data->tanggal_masuk }}">
                                @error('tanggal_masuk')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
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
