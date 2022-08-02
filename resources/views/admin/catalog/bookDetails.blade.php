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

    <title>Manage Book Details</title>

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
    <!-- action bar -->
    <div class="container">
        <br>
        <div class="row">
            <div class="heading_container heading_center">
                <h2>
                    Book Details
                </h2>
            </div>
        </div>
        <div class="row justify-content-end">
            <ul class="book-action-bar">
                <li>
                    <a href="#">
                        <img class="icon" src = "{{ asset('images/icons/edit.png') }}"/>
                        <span>Edit</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="icon" src = "{{ asset('images/icons/remove.png') }}"/>
                        <span>Remove</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
    <br>
        <div class="row justify-content-center">
            <div class="card-book">
                <div class="row">
                    <div class="innerLeft">
                        <img class="card-img-left" src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}"/>
                    </div>
                    <div class="innerRight">
                        <div class="horizontal-card-footer"><br>
                            <a href = "{{ route('home', [ 'ISBN13'=> $book->ISBN ]) }}">
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
        </div>

    </div>

    <!-- Material Table -->
    <div class = "container">
        <div class="heading_container heading_center">
            <h2>
                Material Instances
            </h2>
        </div>
        <div class="row justify-content-end">
            <ul class="book-action-bar">
                <li>
                    <a href="#">
                        <img class="icon" src = "{{ asset('images/icons/remove.png') }}"/>
                        <span>Add Material</span>
                    </a>
                </li>
            </ul>
        </div>
        <table class = "material-table">
            <tr>
                <th>Material No.</th>
                <th>Call No.</th>
                <th>Status</th>
                <th>Intake Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
                <td>Book</td>
                <td>Book Cover</td>
                <td>User</td>
                <td>Borrowed At</td>
                <td>Due At</td>
                <td>Returned At</td>
            <tr>
            </tr>
        </table>
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>