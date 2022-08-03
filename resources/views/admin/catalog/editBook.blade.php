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

    <title>Edit Book</title>

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
                <h1><font face='Impact'>Edit Book</font></h1>
                <form action="{{route('add_book_submit')}}" method="post" enctype="multipart/form-data"
                onSubmit="return confirm('Are you sure you wish to Edit Book?');">
                    @csrf
                    <!-- Print error message that Books was NOT edited -->
                    @if(Session::has('Fail'))
                        <div class="alert alert-danger">{{Session::get('Fail')}}</div>
                    @endif
                    <!-- Form Data -->
                    <div class="form-group row">
                        <label for="ISBN" class="col-4 col-form-label">ISBN</label> 
                        <div class="col-8">
                            <input id="ISBN" name="ISBN" placeholder="ISBN" type="text" class="form-control" 
                            required value="{{ $book->ISBN }}">
                            <span class="text-danger">@error('ISBN') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-4 col-form-label">Book Title</label> 
                        <div class="col-8">
                            <input id="title" name="title" placeholder="Book Title" type="text" class="form-control" 
                            required="required" value="{{ $book->title }}">
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
                    <div class="form-group row justify-content-center">
                        <img id="preview" src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}" width=30% height=30%/>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-4 col-form-label">Book Description</label> 
                        <div class="col-8">
                            <textarea id="description" name="description" placeholder="Book Description" class="form-control" 
                            rows="5" required="required">{{ $book->description }}</textarea>
                            <span class="text-danger">@error('description') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="author" class="col-4 col-form-label">Book Author</label> 
                        <div class="col-8">
                            <input id="author" name="author" placeholder="Book Author" type="text" class="form-control" 
                            required value="{{ $book->author }}">
                            <span class="text-danger">@error('author') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publication" class="col-4 col-form-label">Publication</label> 
                        <div class="col-8">
                            <input id="publication" name="publication" placeholder="Publication" type="text" 
                            class="form-control" required value="{{ old('publication') }}">
                            <span class="text-danger">@error('publication') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publication_date" class="col-4 col-form-label">Publication Date</label> 
                        <div class="col-8">
                            <input id="publication_date" name="publication_date" placeholder="Publication Date" type="date" 
                            class="form-control" required value="{{ $book->publication_date }}">
                            <span class="text-danger">@error('publication_date') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-4 col-form-label">Price (RM)</label>
                        <div class="col-8">
                        <input id="price" name="price" type="number" step="0.01" min="0" max="100" required
                            value="{{ $book->price }}" placeholder="0.00" class="form-control">   
                            <div id="sliderBox">
                                <input type="range" id="priceSlider" step="0.01" min="0" max="100" class="form-control" value="{{ $book->price }}">
                            </div>
                        </div>
                        <span class="text-danger">@error('price') {{$message}} @enderror</span>
                    </div> 
                    <div class="form-group row">
                        <label for="language" class="col-4 col-form-label">Language</label> 
                        <div class="col-8">
                            <select class="custom-select form-select-lg mb-3" id="language" name="language">
                                <option value="(EN) English" @if ($book->language == "(EN) English") {{ 'selected' }} @endif>
                                    (EN) English</option>
                                <option value="(CN) Chinese" @if ($book->language == "(CN) Chinese") {{ 'selected' }} @endif>
                                    (CN) Chinese</option>
                                <option value="(BM) Malay" @if ($book->language == "(BM) Malay") {{ 'selected' }} @endif>
                                    (BM) Malay</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="access_level" class="col-4 col-form-label">Access Level</label> 
                        <div class="col-8">
                            <select class="custom-select form-select-lg mb-3" id="access_level" name="access_level">
                                <option value=1 @if ($book->access_level == 1) {{ 'selected' }} @endif>No Restrictions</option>
                                <option value=2 @if ($book->access_level == 2) {{ 'selected' }} @endif>Priviliged Only</option>
                                <option value=3 @if ($book->access_level == 3) {{ 'selected' }} @endif>Full Restrictions</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                            <a class="btn btn-block btn-secondary btn-md" 
                            href="{{ route('manage_book_details', [ 'ISBN'=> $book->ISBN ]) }}">Cancel</a>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-block btn-primary btn-md" type="submit">Edit Book</button>
                        </div>
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