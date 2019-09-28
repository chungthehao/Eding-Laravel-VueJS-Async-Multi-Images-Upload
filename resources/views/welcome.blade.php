<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            nav.navbar {
                margin-bottom: 0;
            }

            #image-form-wrapper {
                padding-top: 20px;
                background: #f7f7f7;
            }

            #images {
                background: #eee;
                padding: 20px 0;
            }
        </style>
    </head>
    <body>
        <div id="app-cua-tao">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            My Images
                        </a>

                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href="#">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <section id="image-form-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Upload Your Images
                                </div>

                                <div class="panel-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @elseif (session('message'))
                                        <div class="alert alert-info">{{ session('message') }}</div>
                                    @endif

                                    <form-upload></form-upload>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="images">
                <div class="container">
                    <div class="row">
                        <images></images>
                    </div>
                </div>
            </section>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
