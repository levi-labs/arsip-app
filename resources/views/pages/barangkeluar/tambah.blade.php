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
                        <h5>{{ $title }}</h5>
                    {{-- <h5>Basic Componant</h5> --}}
                </div>
                <div class="card-body">

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/post-barang-keluar') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Barang Masuk</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $kodeBarangMasuk }}"
                                        value="{{ $kodeBarangMasuk }}" readonly name="kode_barang_keluar">
                                    @error('kode_barang_keluar')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror

                                </div>

                                @if (session()->get('tujuan') == 'cabang')
                                    <div class="form-group">

                                        <label for="exampleFormControlSelect1">
                                            @if (session()->get('tujuan') == 'cabang')
                                                {{ ucfirst(session()->get('tujuan')) }}
                                                <input type="hidden" name="jenis_tujuan"
                                                    value="{{ ucfirst(session()->get('tujuan')) }}">
                                            @elseif ($tujuanDetail != null)
                                                {{ ucfirst($tujuanDetail) }}
                                                <input type="hidden" name="jenis_tujuan" value="{{ $tujuanDetail }}">
                                            @else
                                                {{ ucfirst($jenis_tujuan) }}
                                                <input type="hidden" name="jenis_tujuan" value="{{ $jenis_tujuan }}">
                                            @endif

                                        </label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="nama_tujuan">
                                            <option selected disabled>Pilih</option>
                                            @foreach ($tujuan_barang as $tb)
                                                <option>{{ $tb->nama }}</option>
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
                                        <input type="text" class="form-control" placeholder="Nama Customer" name="nama_tujuan">
                                        @error('nama_tujuan')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="number" class="form-control" placeholder="4000" name="harga_jual"
                                        min="0">
                                    @error('harga_jual')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Quantity Keluar</label>
                                    <input type="number" class="form-control" placeholder="0" name="qty_keluar"
                                        min="0">
                                    @error('qty_keluar')
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
                                    <input type="text" class="form-control" placeholder="Kode Surat" name="kode_surat"
                                        value="{{ session()->get('surat') }}" readonly>
                                @else
                                    <input type="text" class="form-control" placeholder="Kode Surat" name="kode_surat">
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
                                <label>Tanggal Keluar</label>
                                <input type="date" class="form-control" placeholder="0" name="tanggal_keluar">
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
    @isset($barangKeluarList)
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        @if (session('success'))
                            <div class="alert alert-info text-dark" role="alert">Barang Keluar dengan No Surat-{{ session()->get('surat') }} added successfully..</div>
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
                                        <th>Kode Barang Keluar</th>
                                        <th>Nama Barang</th>
                                        <th>Qty Keluar</th>
                                        <th>Harga Jual</th>
                                        <th>Unit</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangKeluarList as $bkl)
                                        <tr class="text-center">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $bkl->kode_barang_keluar }}</td>
                                            <td>{{ $bkl->barangs->nama }}</td>
                                            <td>{{ $bkl->qty_keluar }}</td>
                                            <td>@currency($bkl->harga_jual)</td>
                                            <td>{{ $bkl->satuan }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm text-sm"
                                                    href="{{ url('/detail-barang-keluar/' . $bkl->id) }}">Detail</a>
                                                <a class="btn btn-warning btn-sm text-sm"
                                                    href="{{ url('/edit-barang-keluar/' . $bkl->id) }}">Edit</a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ url('/hapus-barang-keluar/' . $bkl->id) }}">Hapus</a>
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
