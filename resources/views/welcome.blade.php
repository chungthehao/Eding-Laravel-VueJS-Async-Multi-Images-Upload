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

                                <form action="/" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>

                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="" name="image">
                                    </div>

                                    <div class="text-right">
                                        <button class="btn btn-success" type="submit">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="images">
            <div class="container">
                <div class="row">
                    @forelse ($images as $image)
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img src="{{ $image->link }}" alt="">
                            </div>

                            <div class="caption">
                                <h3>{{ $image->title }}</h3>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12 text-center">
                            <h3 class="text-danger">
                                No images
                            </h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
