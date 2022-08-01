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

    <title>Admin Panel</title>

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
    <div class="container">

        <br/>
        <div class = 'stock_buttons'>
            <a href="{{ route('add_book') }}" class="btn btn-info">Add Books</a>
        </div>
        <br/>

        <div class="row justify-content-center">
            @foreach ($books as $book)
                <div class="cardStock">
                    <div class="row">
                        <div class="innerLeft">
                            <img class="card-img-left" src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}"
                            height="200" width="150"/>
                        </div>
                        <div class="innerRight">
                            <div class="horizontal-card-footer"><br>
                                <a href = "{{ route('home', [ 'ISBN13'=> $book->ISBN ]) }}">
                                <span class="card-text-stock">Book Title: {{ $book->title }}</span></a>
                                <span class="card-text-stock">ISBN-13 Number: {{ $book->ISBN }}</span>
                                <span class="card-text-stock">Description: {{ $book->description }}</span>
                                <span class="card-text-stock">Total Quantity:</span>
                                <span class="card-text-nostock">{{ $book->total_qty }}</span>
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