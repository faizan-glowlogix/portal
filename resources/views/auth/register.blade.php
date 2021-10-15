@extends('layouts.app')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>&nbsp
            <strong>Success!</strong> {{Session::get('success')}}
        </div>
    @endif
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
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" id="name"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="form-submit-button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#form-submit-button").click(function () {
            var name = $("#name").val();
            var email = $("#email").val();
            console.log(name, email);

            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                        .content,
                },
            };

            // form data
            let formData = new FormData();
            formData.append("name", name);
            formData.append("email", email);


            axios
                .post("http://portal-api.test/api/register-user", formData, config)
                .then((response) => {

                    window.location.href = `/login`;
                })
                .catch(error => {
                    if (error.response) {
                        console.log(error.response.data.errors.email[0], 'error message');
                    }
                    $('.errors').append("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>&nbsp<strong>Error!</strong>" + error.response.data.errors.email[0] + "</div>")


                });
        });
    </script>
@endsection
