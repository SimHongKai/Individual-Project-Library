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

    <title>Borrow History</title>

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
            Borrow History
        </h2>
    </div>

    <!-- Borrow Table -->
    <div class = "container">

        @if($borrowHistory->count() == 0)
        <h2 class="text-muted text-center">No Borrow History Found</h2>
        @else
        <table class = "record-table">
            <tr>
                <th>Book</th>
                <th>Book Cover</th>
                <th>Borrowed At</th>
                <th>Due to Return At</th>
                <th>Returned At</th>
                <th>Status</th>
                <th>Late Fee (RM)</th>
            </tr>
            @foreach($borrowHistory as $record) 
                <tr id = "{{ $record->ISBN }}Row">
                    <td class = "record-table-title">
                        <a href = "{{ route('book_details', [ 'ISBN'=> $record->ISBN ]) }}">
                        Title: {{ $record -> title }} <br>
                        ISBN: {{ $record -> ISBN }} <br>
                        Material No: {{ sprintf('%08d', $record->material_no) }} <br>
                        </a>
                    </td>
                    <td><img src="{{ asset('images/book_covers') }}/{{ $record -> cover_img }}"></td>
                    <td>{{ $record -> borrowed_at }}</td>
                    <td @if ($record->status == 1 && $record->due_at < date('Y-m-d'))class="text-danger"@endif>
                        {{ $record -> due_at }}
                    </td>
                    <td>{{ $record -> returned_at }}</td>
                    <td>
                    @switch($record->status)
                        @case(1)
                            <p class="text-warning">Borrowed</p>
                            @break
                        @case(2)
                            <p class="text-success">Returned</p>
                            @break
                        @case(3)
                            Missing
                            @break
                        @default
                            Error Status
                    @endswitch
                    </td>
                    <td>{{ sprintf('%.2f', $record -> late_fees) ?? "0.00" }}</td>
                </tr>
            @endforeach
        </table>
        @endif
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center my-3">
        {{ $borrowHistory->links() }}
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>