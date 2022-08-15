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

    <title>Borrow Records</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('header')

    @include('profile')

    <!-- action bar -->
    <div class="container">
        <ul class="action_bar">
            <li>
                <a href="{{ route('profile') }}">
                    Bookmarks
                </a>
            </li>
            <li>
                <a href="{{ route('profile_borrows') }}">
                    Borrow History
                </a>
            </li>
            <li>
                <a href="{{ route('profile_rewards') }}">
                    Reward History
                </a>
            </li>
        </ul>
    </div>

    <div class="heading_container heading_center my-3">
        <h2>
            Bookmarks
        </h2>
    </div>

    <!-- Bookmarks Table -->
    <div class = "container">
        @if($bookmarks->count() == 0)
        <h2 class="text-muted text-center">User has No Bookmarks</h2>
        @else
        <table class = "record-table">
            <tr>
                <th>Book</th>
                <th>Book Cover</th>
                <th>Available Qty</th>
            </tr>
            @foreach($bookmarks as $record) 
                <tr id = "{{ $record->ISBN }}Row">
                    <td class = "record-table-title">
                        <a href = "{{ route('book_details', [ 'ISBN'=> $record->ISBN ]) }}">
                        Title: {{ $record -> title }} <br>
                        ISBN: {{ $record -> ISBN }} <br>
                        </a>
                    </td>
                    <td><img src="{{ asset('images/book_covers') }}/{{ $record -> cover_img }}"></td>
                    <td @if ($record->available_qty < 1) class="text-danger"@endif>
                        {{ $record -> available_qty }}
                    </td>
                </tr>
            @endforeach
        </table>
        @endif
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center my-3">
        {{ $bookmarks->links() }}
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>