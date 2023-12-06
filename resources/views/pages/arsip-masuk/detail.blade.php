@extends('layouts.main')
@section('content')
    <style>
        .clear {
            clear: both;
        }
    </style>
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    @if (session('success'))
                        <div class="alert alert-success text-dark" role="alert">{{ session('success') }}</div>
                    @elseif(session('failed'))
                        <div class="alert alert-danger text-dark" role="alert">{{ session('failed') }}</div>
                    @endif

                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <h5>{{ $title }}</h5>
                        </div>

                        <h5>{{ 'No: ' . $kopTanggal->kode_surat }}</h5>
                    </div>




                    {{-- <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span> --}}

                </div>
                <div class="row justify-content-between">
                    <div class="col-md-4 text-left">
                        <img class="float-left" src="{{ asset('assets/images/logotirta.png') }}" alt=""
                            width="30%">

                        <p class="text-dark">
                            <b>
                                {{ $kopTitle }}
                            </b>
                        </p>
                        <p>
                            {{ $kopAlamat }}
                        </p>
                        <p>
                            {{ $kopTelp }}
                        </p>

                    </div>
                    <div class="clear"></div>
                    <div class="col-md-3 text-left">
                        <p>
                            <b>
                                {{ 'Dari: ' . $kopTanggal->sumber_barang }}
                            </b>
                        </p>
                        <p>
                            {{ strtoupper($sumber_dari->alamat) }}
                        </p>
                        <p>{{ $sumber_dari->no_hp }}</p>
                    </div>

                </div>

                <div class="card-block table-border-style">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Kode<br> Barang Masuk</th>
                                    <th>Nama<br> Barang</th>

                                    <th>Qty <br> Masuk</th>
                                    <th>Qty <br> Rusak</th>
                                    <th>Qty <br> Diterima</th>

                                    <th>Satuan</th>
                                    <th>Harga <br> Beli</th>
                                    <th>Sub <br> Total</th>


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($data as $dt)
                                    <tr class="text-center">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $dt->kode_barang_masuk }}</td>
                                        <td>{{ $dt->barang_id }}</td>
                                        <td>{{ $dt->qty_masuk }}</td>
                                        <td>{{ $dt->qty_rusak }}</td>
                                        <td>{{ $dt->qty_diterima }}</td>
                                        <td>{{ $dt->satuan }}</td>
                                        <td>@currency($dt->harga_beli)</td>
                                        <td>@currency($dt->harga_beli * $dt->qty_diterima) </td>
                                        @php
                                            $total += $dt->harga_beli * $dt->qty_diterima;
                                        @endphp

                                    </tr>
                                @endforeach
                                @php
                                    // $total = \App\Models\BarangMasuk::where('kode_surat', $kopTanggal->kode_surat)->sum('');
                                @endphp
                                <tr>
                                    <th class="text-right" colspan="8">Total :</th>
                                    <td class="text-center">@currency($total)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <img src="{{ $kopTanggal->getImage() }}" alt="" width="100%">
        </div>
    </div>
@endsection
