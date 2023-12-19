@extends('layouts.main')
@section('content')
    <style>
        #showError{
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
                        <div class="alert alert-danger">{{ session('message-error') }}</div>
                    @endif
                    <div id="showError"  class="alert alert-warning showError"> <b>Field Tanggal Dari | Tanggal Sampai is required</b></div>

                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
{{--                            {{ url('/post-report-masuk') }}--}}
                            <form id="my-Form" method="POST"  autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label for="input-dari">Tanggal Dari</label>
                                    <input type="date" class="form-control" id="input-dari"
                                        aria-describedby="emailHelp" name="input_from">


                                </div>
                                <div class="form-group">
                                    <label for="input-to">Tanggal Sampai</label>
                                    <input type="date" class="form-control" id="input-to"
                                        aria-describedby="emailHelp" name="input_to">
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-12 text-right">
                                        <button onclick="checkValue()" type="submit" class="btn btn-block  btn-primary">Submit</button>
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
        function checkValue(){
            const input_form = document.getElementById('input-dari').value;
            const input_to   = document.getElementById('input-to').value;
            const myForm     = document.getElementById('my-Form');
            const error      = document.querySelector("#showError");
            myForm.addEventListener('submit', function (e){
                if(input_form == '' && input_to == ''){

                    error.style.display = 'block'
                    e.preventDefault();

                }else if(input_form != '' || input_to != ''){

                   myForm.action ='/post-report-masuk';
                   myForm.target = '_blank';
                    error.style.display = 'none';
                    e.currentTarget.submit();


                    console.log(input_form,input_to);
               }
            });
        }
    </script>
@endsection
