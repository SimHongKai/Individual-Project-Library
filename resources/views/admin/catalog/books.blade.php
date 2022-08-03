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

    <title>Manage Books</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/card.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('header')
    
    <!-- Action Buttons -->
    <div class="container">
        <br/>
        <div class="row">
            <div class="col-6 text-left"> 
                <div class = 'btn'>
                    <a href="{{ route('admin_panel') }}" class="btn btn-info">Return</a>
                </div>
            </div>
            <div class="col-6 text-right">
                <div class = 'btn'>
                    <a href="{{ route('add_book') }}" class="btn btn-info">Add Book</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            @foreach ($books as $book)
                <div class="card-book">
                    <div class="row">
                        <div class="col-2">
                            <img class="card-img-left" src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}"/>
                        </div>
                        <div class="col-10">
                            <div class="horizontal-card-footer"><br>
                                <a href = "{{ route('manage_book_details', [ 'ISBN'=> $book->ISBN ]) }}">
                                <span class="card-text-title">Book Title:</span>
                                <span class="card-text-title-content">{{ $book->title }}</span></a>
                                <br>
                                <span class="card-text-detail">ISBN-13 Number:</span>
                                <span class="card-text-detail-content">{{ $book->ISBN }}</span>
                                <br>
                                <span class="card-text-detail">Description:</span>
                                <span class="card-text-detail-content">{{ Str::limit($book->description, 20) }}</span>
                                <br>
                                <span class="card-text-detail">Language:</span>
                                <span class="card-text-detail-content">{{ $book->language }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            @endforeach
        </div>
    
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>