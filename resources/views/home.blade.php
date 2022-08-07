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

    <title>Home</title>

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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Books section -->
    <section class="catagory_section layout_padding">
        <div class="catagory_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2>
                        Popular Books
                    </h2>
                </div>
                <div class="row">
                    @foreach ($popularBooks as $book)
                        <div class="col-sm-6 col-md-4 ">
                            <a href="{{ route('book_details', [ 'ISBN'=> $book->ISBN ]) }}">
                                <div class="box ">
                                <div class="cover-img-box">
                                    <img src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}?{{ $book->updated_at }}" 
                                    alt="{{ $book->cover_img }}">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        {{ $book->title }}
                                    </h5>
                                </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Popular section -->

    <!-- New Books section -->
    <section class="new_section layout_padding">
        <div class="new_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2>
                        New Books
                    </h2>
                </div>
                <div class="row">
                    @foreach ($newBooks as $book)
                        <div class="col-sm-6 col-md-4 ">
                            <a href="{{ route('book_details', [ 'ISBN'=> $book->ISBN ]) }}">
                                <div class="box ">
                                <div class="cover-img-box">
                                    <img src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}?{{ $book->updated_at }}" 
                                    alt="{{ $book->cover_img }}">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        {{ $book->title }}
                                    </h5>
                                </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End New section -->

    <!-- Recently Borrowed section -->
    <section class="catagory_section layout_padding">
        <div class="catagory_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2>
                        Recently Borrowed Books
                    </h2>
                </div>
                <div class="row">
                    @foreach ($recentBooks as $book)
                        <div class="col-sm-6 col-md-4 ">
                            <a href="{{ route('book_details', [ 'ISBN'=> $book->ISBN ]) }}">
                                <div class="box ">
                                <div class="cover-img-box">
                                    <img src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}?{{ $book->updated_at }}" 
                                    alt="{{ $book->cover_img }}">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        {{ $book->title }}
                                    </h5>
                                </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Recently Borrowed section -->
    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>
