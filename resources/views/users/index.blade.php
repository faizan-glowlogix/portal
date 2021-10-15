@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Users</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody class="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const config = {
            headers: {
                "content-type": "multipart/form-data",
                "Access-Control-Allow-Origin": "*",
                "Authorization": '{!! $token !!}',
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                    .content,
            },

        };

        axios
            .get("http://portal-api.test/api/users", config)
            .then((response) => {
                console.log(response.data.data), 'response';
                jQuery.each(response.data.data, function (index, item) {

                    $('.tbody').append("<tr><th scope='row'>" + index + "</th><td>" + item.name + "</td><td>" + item.email + "</td></tr>");

                });

            })
            .catch(error => {

            });
    </script>
@endsection
