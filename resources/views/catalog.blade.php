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

    <title>Catalog</title>

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
    <div class="heading_container heading_center my-3">
        <h2>
            Catalog
        </h2>
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center my-3">
        {{ $books->links() }}
    </div>
    
    <!-- card detail box -->
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($books as $book)
                <div class="card-book">
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-sm-2">
                                <img src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}?{{ $book->updated_at }}" class="card-img">
                            </div>
                            <div class="col-sm-10">
                                <div class="card-body">                                        
                                    <a href = "{{ route('book_details', [ 'ISBN'=> $book->ISBN ]) }}">
                                    <span class="card-text-title">Book Title:</span>
                                    <span class="card-text-title-content">{{ $book->title }}</span></a>
                                    <br>
                                    <span class="card-text-detail">ISBN-13 Number:</span>
                                    <span class="card-text-detail-content">{{ $book->ISBN }}</span>
                                    <br>
                                    <span class="card-text-detail">Description:</span>
                                    <span class="card-text-detail-content">{{ Str::limit($book->description, 100) }}</span>
                                    <br>
                                    <span class="card-text-detail">Language:</span>
                                    <span class="card-text-detail-content">{{ $book->language }}</span>
                                    <br>
                                    <span class="card-text-detail">Access Level:</span>
                                    <span class="card-text-detail-content">
                                    @switch($book->access_level)
                                        @case(1)
                                            No Restrictions <span class="green-dot"></span>
                                            @break
                                        @case(2)
                                            Priviliged Only <span class="yellow-dot"></span>
                                            @break
                                        @case(3)
                                            Full Restrictions <span class="red-dot"></span>
                                            @break
                                        @default
                                            Error Status
                                    @endswitch
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
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