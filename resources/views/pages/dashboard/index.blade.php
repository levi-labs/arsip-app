@extends('layouts.main')
@section('content')
    @if(session()->has('login_success'))

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">{{session('login_success')}}</div>
            </div>
        </div>
    @endif

    <div class="row">
        <!--[ daily sales section ] start-->
{{--        @php--}}
{{--        session()->forget('success');--}}
{{--            dd(session()->all());--}}
{{--        @endphp--}}
        <div class="col-md-6 col-xl-4">
            <div class="card daily-sales">
                <div class="card-block">
                    <h6 class="mb-4">Barang Masuk</h6>
                    <div class="row d-flex align-items-center">
                        <div class="col-9">
                            <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                    class="feather icon-arrow-down text-c-green f-30 m-r-10"></i>{{$barangMasuk}}</h3>
                        </div>


                    </div>
                    <div class="progress m-t-30" style="height: 7px;">
                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 100%;"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--[ daily sales section ] end-->
        <!--[ Monthly  sales section ] starts-->
        <div class="col-md-6 col-xl-4">
            <div class="card Monthly-sales">
                <div class="card-block">
                    <h6 class="mb-4">Barang Keluar</h6>
                    <div class="row d-flex align-items-center">
                        <div class="col-9">
                            <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i
                                    class="feather icon-arrow-up text-c-red f-30 m-r-10"></i>{{$barangKeluar}}</h3>
                        </div>

                    </div>
                    <div class="progress m-t-30" style="height: 7px;">
                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width: 100%;"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--[ Monthly  sales section ] end-->
        <!--[ year  sales section ] starts-->
        <div class="col-md-12 col-xl-4">
            <div class="card yearly-sales">
                <div class="card-block">
                    <h6 class="mb-4">Barang</h6>
                    <div class="row d-flex align-items-center">
                        <div class="col-9">
                            <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i
                                    class="feather icon-box text-c-blue f-30 m-r-10"></i>{{$barang}}</h3>
                        </div>
                        <div class="col-3 text-right">
                            <p class="m-b-0">80%</p>
                        </div>
                    </div>
                    <div class="progress m-t-30" style="height: 7px;">
                        <div class="progress-bar progress-c-blue" role="progressbar" style="width: 100%;"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
