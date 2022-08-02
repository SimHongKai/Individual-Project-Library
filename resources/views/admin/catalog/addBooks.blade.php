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

    <title>Add Books</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('header')
    <br/>
    <div class="container">
        <div class='row justify-content-center'>
            <div class = 'col-md-8'>
                <h1><font face='Impact'>Add Book</font></h1>
                <form action="{{route('add_book_submit')}}" method="post" enctype="multipart/form-data">
                    <!-- Print error message that Books was NOT added -->
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group row">
                        <label for="ISBN" class="col-4 col-form-label">ISBN</label> 
                        <div class="col-8">
                            <input id="ISBN" name="ISBN" placeholder="ISBN" type="text" class="form-control" 
                            required="required" value="{{ old('ISBN') }}">
                            <span class="text-danger">@error('ISBN') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-4 col-form-label">Book Title</label> 
                        <div class="col-8">
                            <input id="title" name="title" placeholder="Book Title" type="text" class="form-control" 
                            required="required" value="{{old('title')}}">
                            <span class="text-danger">@error('title') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cover Image</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cover_img" name="cover_img" aria-describedby="fileInput">
                            <label class="custom-file-label" for="cover_img">Cover Image</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <img style="visibility:hidden" id="preview" src="" width=30% height=30%/>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-4 col-form-label">Book Description</label> 
                        <div class="col-8">
                            <textarea id="description" name="description" placeholder="Book Description" class="form-control" 
                            rows="5" required="required">{{ old('description') }}</textarea>
                            <span class="text-danger">@error('description') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="author" class="col-4 col-form-label">Book Author</label> 
                        <div class="col-8">
                            <input id="author" name="author" placeholder="Book Author" type="text" class="form-control" 
                            required="required" value="{{old('author')}}">
                            <span class="text-danger">@error('author') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publication" class="col-4 col-form-label">Publication</label> 
                        <div class="col-8">
                            <input id="publication" name="publication" placeholder="Publication" type="text" 
                            class="form-control" required="required" value="{{old('publication')}}">
                            <span class="text-danger">@error('publication') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publication_date" class="col-4 col-form-label">Publication Date</label> 
                        <div class="col-8">
                            <input id="publication_date" name="publication_date" placeholder="Publication Date" type="date" 
                            class="form-control" required="required" value="{{old('publication_date')}}">
                            <span class="text-danger">@error('publication_date') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-4 col-form-label">Price (RM)</label>
                        <div class="col-8">
                        <input id="price" name="price" type="number" step="0.01" required="required" min="0" max="100"
                            value="{{old('price')}}" placeholder="0.00" class="form-control">   
                            <div id="sliderBox">
                                <input type="range" id="priceSlider" step="0.01" min="0" max="100" class="form-control" required="required">
                            </div>
                        </div>
                        <span class="text-danger">@error('price') {{$message}} @enderror</span>
                    </div> 
                    <div class="form-group row">
                        <label for="language" class="col-4 col-form-label">Language</label> 
                        <div class="col-8">
                            <select class="custom-select form-select-lg mb-3" id="language" name="language">
                                <option value="(EN) English">(EN) English</option>
                                <option value="(CN) Chinese">(CN) Chinese</option>
                                <option value="(BM) Malay">(BM) Malay</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="access_level" class="col-4 col-form-label">Access Level</label> 
                        <div class="col-8">
                            <select class="custom-select form-select-lg mb-3" id="access_level" name="access_level">
                                <option value=1>No Restrictions</option>
                                <option value=2>Priviliged Only</option>
                                <option value=3>Full Restrictions</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">Add Book</button>
                    </div>
                    <br>
                </form> 
            </div>
        </div>
    </div>
    @include('footer')

<!-- jQery -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('js/bootstrap.js') }}"></script>
<!-- addBooks JS -->
<script src="{{ URL::asset('js/addBook.js') }}"></script>

</body>

</html>