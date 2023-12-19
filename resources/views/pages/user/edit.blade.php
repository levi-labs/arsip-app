@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $title }}</h5>
                </div>
                <div class="card-body">
                    @if(session()->has('failed'))
                        <div class="alert alert-danger">{{session('failed')}}</div>

                    @endif


                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('/update-user/' . $user->id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Nama User</label>
                                    <input type="text" class="form-control" placeholder="John Doe" name="nama" value="{{$user->nama}}">
                                    @error('nama')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Username</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="username" value="{{$user->username}}">
                                    @error('username')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kategori</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                        <option selected disabled>Pilih</option>
                                        <option {{$user->level == 'Admin' ? 'selected' : ''}}>Admin</option>
                                        <option {{$user->level == 'Staf' ? 'selected' : ''}}>Staf</option>
                                    </select>
                                    @error('kategori')
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
