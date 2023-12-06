@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5></h5>
                </div>
                <div class="card-body">
                    <h5>{{ $title }}</h5>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form method="GET" action="{{ url('/tambah-barang-masuk') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Cabang / Supplier</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="sumber">

                                        <option selected disabled>Pilih</option>
                                        <option>Cabang</option>
                                        <option>Supplier</option>

                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Input group -->
        </div>
    </div>
@endsection