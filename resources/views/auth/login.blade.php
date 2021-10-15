@extends('layouts.app')

@section('content')
    <div class="success">
        @if(Session::has('success'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>&nbsp
                <strong>Success!</strong> {{Session::get('success')}}
            </div>
        @endif
    </div>
    <div class="errors">
        @if(Session::has('error'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>&nbsp
                <strong>Error!</strong> {{Session::get('error')}}
            </div>
        @endif
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                    <!-- <form method="POST" action="{{ url('http://portal-api.test/api/magic-link') }}">
                        @csrf -->

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary" id="form-submit-button">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#form-submit-button").click(function () {

            var email = $("#email").val();


            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    "Access-Control-Allow-Origin": "*",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                        .content,
                },

            };

            // form data
            let formData = new FormData();
            formData.append("email", email);

            axios
                .post("http://portal-api.test/api/magic-link", formData, config)
                .then((response) => {
                    $('.success').append("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>&nbsp<strong>Success!</strong> " + response.data.email + "</div>");

                })
                .catch(error => {
                    if (error.response) {
                        $('.errors').append("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>&nbsp<strong>Error!</strong>" + error.response.data.errors.email[0] + "</div>")
                    }

                });
        });
    </script>
@endsection
