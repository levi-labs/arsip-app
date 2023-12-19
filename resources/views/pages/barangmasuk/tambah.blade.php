@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @if (session('failed'))
                        <div class="alert alert-danger" role="alert">{{ session('failed') }}</div>
                    @elseif(session('success'))
                        <div class="alert alert-danger" role="alert">{{ session('success') }}</div>
                    @endif
                        <h5>{{ $title }}</h5>
                    {{-- <h5>Basic Componant</h5> --}}
                </div>
                <div class="card-body">

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/post-barang-masuk') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Barang Masuk</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $kodeBarangMasuk }}"
                                        value="{{ $kodeBarangMasuk }}" readonly name="kode_barang_masuk">
                                    @error('kode_barang_masuk')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">

                                    <label for="exampleFormControlSelect1">
                                        @if (session()->get('sumber') != null)
                                            {{ ucfirst(session()->get('sumber')) }}
                                            <input type="hidden" name="kategori_sumber"
                                                value="{{ ucfirst(session()->get('sumber')) }}">
                                        @elseif ($sumberDetail != null)
                                            {{ ucfirst($sumberDetail) }}
                                            <input type="hidden" name="kategori_sumber" value="{{ $sumberDetail }}">
                                        @else
                                            {{ ucfirst($kategori_sumber) }}
                                            <input type="hidden" name="kategori_sumber" value="{{ $kategori_sumber }}">
                                        @endif


                                    </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="sumber_barang">

                                        <option selected disabled>Pilih</option>
                                        @foreach ($sumber_barang as $sb)
                                            <option>{{ $sb->nama }}</option>
                                        @endforeach


                                    </select>
                                    @error('sumber_barang')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" class="form-control" placeholder="4000" name="harga_beli"
                                        min="0">
                                    @error('harga_beli')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Quantity Masuk</label>
                                    <input type="number" class="form-control" placeholder="0" name="qty_masuk"
                                        min="0">
                                    @error('qty_masuk')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto Surat</label>
                                    <input type="file" class="form-control" placeholder="" name="foto_surat">
                                    @error('foto_surat')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>




                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Kode Surat Jalan</label>
                                @if (session()->get('surat'))
                                    <input type="text" class="form-control" name="kode_surat"
                                        value="{{ session()->get('surat') }}" readonly>
                                @else
                                    <input type="text" class="form-control" name="kode_surat">
                                @endif


                                @error('kode_surat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Barang</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="barang">
                                    <option selected disabled>Pilih</option>
                                    @foreach ($barang as $brg)
                                        <option value="{{ $brg->id }}">{{ $brg->nama }}</option>
                                    @endforeach
                                </select>
                                @error('barang')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control" placeholder="Unit/Pcs/Dus/Kg" name="satuan">
                                @error('satuan')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Quantity Rusak</label>
                                <input type="number" class="form-control" placeholder="0" name="qty_rusak" min="0">
                                @error('qty_rusak')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" placeholder="0" name="tanggal_masuk">
                                @error('tanggal_masuk')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row justify-content-between mt-3">

                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-warning"
                                        onclick="window.location.href='/barang-masuk'">Daftar Barang
                                        Masuk</button>
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

    @isset($barangMasukList)
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        @if (session('success'))
                            <div class="alert alert-success text-dark" role="alert">{{ session('success') }}</div>
                        @endif
                        <h5>Daftar Barang Masuk dengan No Surat-{{ session()->get('surat') }}</h5>
                        {{-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> --}}

                    </div>

                    <div class="card-block table-border-style">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty Masuk</th>
                                        <th>Qty Rusak</th>
                                        <th>Qty Diterima</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangMasukList as $bml)
                                        <tr class="text-center">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $bml->kode_barang_masuk }}</td>
                                            <td>{{ $bml->barang_id }}</td>
                                            <td>{{ $bml->qty_masuk }}</td>
                                            <td>{{ $bml->qty_rusak }}</td>
                                            <td>{{ $bml->qty_diterima }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm text-sm"
                                                    href="{{ url('/detail-barang-masuk/' . $bml->id) }}">Detail</a>
                                                <a class="btn btn-warning btn-sm text-sm"
                                                    href="{{ url('/edit-barang-masuk/' . $bml->id) }}">Edit</a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ url('/hapus-barang-masuk/' . $bml->id) }}">Hapus</a>
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
    @endisset

@endsection
