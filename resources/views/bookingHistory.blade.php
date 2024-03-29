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

    <title>Booking History</title>

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

    <div class="heading_container heading_center my-3">
        <h2>
            Booking History
        </h2>
    </div>

    <!-- Booking Table -->
    <div class = "container my-3">

        @if($bookings->count() == 0)
            <h2 class="text-muted text-center">No Bookings Found</h2>
        @else
        <table class = "record-table">
            <tr>
                <th>Booking ID</th>
                <th>User</th>
                <th>Book</th>
                <th>Specific Material</th>
                <th>Status</th>
                <th>Made On</th>
                <th>Expires On</th>
            </tr>
            @foreach($bookings as $record) 
                <tr>
                    <td class = "col-lg-2 col-md-4 col-sm-6">
                        {{ sprintf('%08d', $record->booking_id) }}
                        <div class = "row justify-content-center">
                        {!! DNS1D::getBarcodeHTML(sprintf('%08d', $record->booking_id), 'C128') !!}
                        </div>
                    </td>
                    <td>{{ $record->username }}</td>
                    <td class = "record-table-title col-lg-3 col-md-4 col-sm-6">
                        <a href = "{{ route('book_details', [ 'ISBN'=> $record->ISBN ]) }}">
                        Title: {{ $record -> title }} <br>
                        ISBN: {{ $record -> ISBN }} <br>
                        </a>
                    </td>
                    <td>@if(isset($record->material_no))
                            {{ sprintf('%08d', $record->material_no) }}
                        @else
                            -    
                        @endif
                    </td>
                    <td>
                        @switch($record->status)
                            @case(1)
                                <p class="text-success">Booked with Material</p>
                                @break
                            @case(2)
                                <p class="text-warning">Booked</p>
                                @break
                            @case(3)
                                <p class="text-success">Cancelled/Complete</p>
                                @break
                            @default
                                Error Status
                        @endswitch
                    </td>
                    <td>{{ $record -> created_at }}</td>
                    <td>
                        @if(isset($record -> expire_at))
                            {{ $record -> expire_at }}
                        @else
                            -    
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        @endif
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $bookings->links() }}
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>