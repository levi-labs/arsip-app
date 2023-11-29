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
                            <form method="POST" action="{{ url('/update-barang/' . $data->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Barang</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $data->kode_barang }}"
                                        name="kode_barang" value="{{ $data->kode_barang }}">
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small> --}}
                                    @error('kode_barang')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" placeholder="keramik gray 4x4" name="nama"
                                        value="{{ $data->nama }}">
                                    @error('nama')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Stock</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="10"
                                        name="stock" value="{{ $data->stock }}">
                                    @error('stock')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Harga</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="3000"
                                        name="harga" value="{{ $data->harga_barang }}">
                                    @error('harga')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kategori</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($kategori as $item)
                                            <option {{ $item->id == $data->kategori_id ? 'selected' : '' }}
                                                value="{{ $item->id }}">
                                                {{ $item->nama }}</option>
                                        @endforeach


                                    </select>
                                    @error('kategori')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto Barang</label>
                                    <input type="file" class="form-control" placeholder="Keramik" name="foto">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <span>{{ $data->foto_barang }}</span>
                                            <span class="text-sm text-danger">Maximal Size 2Mb</span>
                                        </div>


                                    </div>

                                    @error('foto')
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
