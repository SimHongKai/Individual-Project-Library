<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/gif" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>Catalog Search</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('header')
    <div class="container">
        <div class='row justify-content-center my-3'>
            <div class = 'col-md-8'>
                <h1><font face='Impact'>Catalog Search</font></h1>
                <form action="{{ route('catalog_search_submit') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    <!-- Search Form Fields -->
                    <div class="form-group row">
                        <label for="ISBN" class="col-4 col-form-label">ISBN</label> 
                        <div class="col-8">
                            <input id="ISBN" name="ISBN" placeholder="ISBN" type="text" class="form-control" 
                            value="{{ old('ISBN') }}">
                            <span class="text-danger">@error('ISBN') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-4 col-form-label">Book Title</label> 
                        <div class="col-8">
                            <input id="title" name="title" placeholder="Book Title" type="text" class="form-control" 
                            value="{{ old('title') }}">
                            <span class="text-danger">@error('title') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="author" class="col-4 col-form-label">Book Author</label> 
                        <div class="col-8">
                            <input id="author" name="author" placeholder="Book Author" type="text" class="form-control" 
                            value="{{ old('author') }}">
                            <span class="text-danger">@error('author') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="language" class="col-4 col-form-label">Language</label> 
                        <div class="col-8">
                            <select class="custom-select form-select-lg mb-3" id="language" name="language">
                                <option value="">-</option>
                                <option value="(EN) English">(EN) English</option>
                                <option value="(CN) Chinese">(CN) Chinese</option>
                                <option value="(BM) Malay">(BM) Malay</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4 col-form-label">Available Only</label> 
                        <div class="col-8">
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input" type="checkbox" id="available" name="available" value="True">
                                <label class="custom-control-label" for="available">On</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="access_level" class="col-4 col-form-label">Access Level</label> 
                        <div class="col-8">
                            <select class="custom-select form-select-lg mb-3" id="access_level" name="access_level">
                                <option value="">-</option>
                                <option value=1>No Restrictions</option>
                                <option value=2>Priviliged Only</option>
                                <option value=3>Full Restrictions</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="publication" class="col-4 col-form-label">Publication</label> 
                        <div class="col-8">
                            <input id="publication" name="publication" placeholder="Publication" type="text" 
                            class="form-control" value="{{ old('publication') }}">
                            <span class="text-danger">@error('publication') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publication_date_from" class="col-4 col-form-label">Publication Date Range</label> 
                        <div class="col-3">
                            <input id="publication_date_from" name="publication_date_from" placeholder="Publication Date" type="date" 
                            class="form-control" value="{{ old('publication_date_from') }}">
                            <span class="text-danger">@error('publication_date_from') {{$message}} @enderror</span>
                        </div>
                        -
                        <div class="col-3">
                            <input id="publication_date_to" name="publication_date_to" placeholder="Publication Date" type="date" 
                            class="form-control" value="{{ old('publication_date_to') }}">
                            <span class="text-danger">@error('publication_date_to') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center my-3">
                        <div class="col-sm-4">
                            <a class="btn btn-block btn-secondary btn-md" href="{{ route('catalog') }}">Cancel</a>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-block btn-primary btn-md" type="submit">Search</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    @include('footer')

<!-- jQery -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>