@extends('reports-layout.main')
@section('surat')
    <center>
        <h4>Laporan Barang Keluar</h4>
        <h4>Periode :
            {{ Carbon\Carbon::parse($result['dari'])->isoFormat('D MMMM Y') . ' - ' . Carbon\Carbon::parse($result['sampai'])->isoFormat('D MMMM Y') }}
        </h4>
    </center>

    <div class="table-print">

        <button type="button" onclick="window.print()" class="btn">&nbsp;Print</button>
        <table class="table table-bordered d-print-table" style="border-collapse: collapse; border: 2px solid black;"
            border="2">
            <thead>
                <tr class="text-center">
                    <th style="background-color: rgb(158, 198, 251)" class="text-center top-th" rowspan="2">
                        No
                    </th>
                    <th style="background-color: rgb(158, 198, 251)" class="text-center top-th" rowspan="2">
                        Kode<br>
                        Barang Keluar
                    </th>
                    <th style="background-color: rgb(158, 198, 251)" class="text-center top-th" rowspan="2">
                        Nama<br>
                        Barang
                    </th>
                    <th style="background-color: rgb(158, 198, 251)" class="text-center top-th" rowspan="2">
                        Qty<br>
                        Keluar
                    </th>
                    <th style="background-color: rgb(158, 198, 251)" class="text-center top-th" rowspan="2">
                        Satuan<br>

                    </th>
                    <th style="background-color: rgb(158, 198, 251)" class="text-center top-th" rowspan="2">
                        Harga<br>
                        Jual
                    </th>
                    <th style="background-color: rgb(158, 198, 251)" class="text-center top-th" rowspan="2">
                        Sub<br>
                        Total
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp

                @foreach ($result['data'] as $dt)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->kode_barang_keluar }}</td>
                        <td>{{ $dt->barangs->nama }}</td>
                        <td>{{ $dt->qty_keluar }}</td>
                        <td>{{ $dt->satuan }}</td>
                        <td>@currency($dt->harga_jual)</td>
                        <td> @currency($dt->harga_jual * $dt->qty_keluar)</td>
                        @php
                            $total += $dt->harga_jual * $dt->qty_keluar;
                        @endphp

                    </tr>
                @endforeach
                <style>
                    .text-right {
                        text-align: center;
                        padding-right: 5px;
                    }
                </style>
                <tr>
                    <td class="text-right" colspan="6">Total </td>
                    <td class="text-center">@currency($total)</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <style>
            .space-ttd {
                width: 1000px;
            }

            .ttd-row {
                width: 100%;
            }
        </style>
        <table class="ttd-row">
            <tr>
                <td style="text-align: center">
                    {{-- <b>Bekasi,<br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br> --}}
                    <br>
                    <br><br><br>
                    <p>Menyetujui</p>,
                    <br><br><br>
                    <br>

                    <hr width="100px">
                </td>
                <td class="space-ttd"></td>
                <td style="text-align: center">
                    <b>Bekasi,<br><br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br>
                    <br><br>
                    <p>Mengetahui</p>,
                    <br><br><br>
                    <br>

                    <hr width="100px">
                </td>
            </tr>
        </table>
    </div>
@endsection
