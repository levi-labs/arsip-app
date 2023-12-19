@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    @if(session()->has('failed'))
                        <div class="alert alert-danger">{{session('failed')}}</div>
                    @endif
                    @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                    @endif


                    <h5>{{ $title }}</h5>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/ubah-password') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control"  name="old_password">
                                    @error('old_password')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">New Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="new_password">
                                    @error('new_password')
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
