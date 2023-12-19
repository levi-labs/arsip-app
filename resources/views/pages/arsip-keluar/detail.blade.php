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
                                Dari :
                                <br>
                                {{ $kopTitle }}
                            </b>
                        </p>
                        <p>
                            {{ $kopAlamat }}
                            <br>
                            {{ $kopTelp }}
                        </p>


                    </div>
                    <div class="clear"></div>
                    <div class="col-md-3 text-left">
                        <p>
                            <b>
                                Kepada: <br>
                                {{ strtoupper($kopTanggal->nama_tujuan) }}
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
                                <th>Kode<br> Barang Keluar</th>
                                <th>Nama<br> Barang</th>
                                <th>Qty <br> Keluar</th>
                                <th>Satuan</th>
                                <th>Harga <br> Jual</th>
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
                                    <td>{{ $dt->kode_barang_keluar }}</td>
                                    <td>{{ $dt->barangs->nama }}</td>
                                    <td>{{ $dt->qty_keluar }}</td>
                                    <td>{{ $dt->satuan }}</td>
                                    <td>@currency($dt->harga_jual)</td>
                                    <td>@currency($dt->harga_jual * $dt->qty_keluar )</td>
                                    @php
                                        $total += $dt->harga_jual * $dt->qty_keluar;
                                    @endphp

                                </tr>
                            @endforeach

                            <tr>
                                <th class="text-right" colspan="6">Total :</th>
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
