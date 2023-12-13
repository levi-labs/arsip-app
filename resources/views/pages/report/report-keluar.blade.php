@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>PT.ABC</h5>
                </div>
                <div class="card-body">
                    @if (session('message-error'))
                        <div class="alert alert-danger">{{ session('message-error') }}</div>
                    @endif

                    <h5>{{ $title }}</h5>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/post-report-keluar') }}" autocomplete="off" target="_blank">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Dari</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="input_from">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Dari</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="input_to">
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-block  btn-primary">Submit</button>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
