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
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('header')
    <div class="container">
        <!-- Action Buttons -->
        <div class="row">
            <div class="col-6 text-left"> 
                <div class = 'btn'>
                    <a href="{{ route('admin_panel') }}" class="btn btn-info">Return</a>
                </div>
            </div>
        </div>
    </div>

    <!-- action bar -->
    <div class="container">
        <ul class="action_bar">
            <li>
                <a href="admin_borrow_records">
                    Borrow History
                </a>
            </li>
            <li>
                <a href="#">
                    Reward History
                </a>
            </li>
        </ul>
    </div>

    <!-- Borrow Table -->
    <div class = "container">
        
        <table class = "record-table">
            <tr>
                <th>Book</th>
                <th>Book Cover</th>
                <th>User</th>
                <th>Borrowed At</th>
                <th>Due At</th>
                <th>Returned At</th>
            </tr>
            @foreach($borrowHistory as $record) 
                <tr id = "{{ $record->ISBN }}Row">
                    <td class = "record-table-title">
                        <a href = "{{ route('manage_book_details', [ 'ISBN'=> $record->ISBN ]) }}">
                        {{ $record -> title }} <br>
                        {{ $record -> ISBN }} <br>
                        {{ sprintf('%08d', $record->material_no) }} <br>
                        </a>
                    </td>
                    <td><img src="{{ asset('images/book_covers') }}/{{ $record -> cover_img }}"></td>
                    <td>{{ $record -> username }}</td>
                    <td>{{ $record -> borrowed_at }}</td>
                    <td>{{ $record -> due_at }}</td>
                    <td>{{ $record -> returned_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $borrowHistory->links() }}
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>