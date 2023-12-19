@extends('layouts.main')
@section('content')
    <style>
        .show-error{
            display: none;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $title }}</h5>
                </div>
                <div class="card-body">
                    @if (session('message-error'))
                        <div class="alert alert-danger showError">{{ session('message-error') }}</div>
                    @endif

                    <div class="alert alert-warning show-error"><b>Field Tanggal Dari | Tanggal Sampai is required</b></div>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form id="my-form" method="POST"  autocomplete="off" >
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Dari</label>
                                    <input type="date" class="form-control"
                                        aria-describedby="emailHelp" name="input_from" id="input-from">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Sampai</label>
                                    <input type="date" class="form-control"
                                        aria-describedby="emailHelp" name="input_to" id="input-to">
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-12 text-right">
                                        <button onclick="checkValidation()"  type="submit" class="btn btn-block  btn-primary">Submit</button>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>

        function checkValidation(){
            const input_from    = document.getElementById('input-from').value;
            const input_to      = document.getElementById('input-to').value;
            const showError     = document.querySelector('.show-error');
            const myForm        = document.getElementById('my-form');

            myForm.addEventListener('submit', function(e) {
                if (input_from == '' && input_to == ''){
                    showError.style.display = 'block';
                    e.preventDefault();
                }else if(input_from != '' || input_to != ''){
                    myForm.action = 'post-report-keluar';
                    myForm.target = '_blank';
                    showError.style.display = 'none';
                    e.target.submit();
                    alert('passing data success');
                }
            });

        }
    </script>


@endsection
