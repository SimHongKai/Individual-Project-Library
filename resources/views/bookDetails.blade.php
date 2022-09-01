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

    <title>Book Details - {{ $book->title }}</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bookmark.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/card.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('header')
    <!-- action bar -->
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-4 col-sm-6 text-left"> 
                <div class = 'btn'>
                    <a href="{{ URL::previous() }}" class="btn btn-info">Return</a>
                </div>
            </div>
            
            <div class="col-lg-4 col-sm-12">
                <div class="heading_container heading_center">
                    <h2>
                        Book Details
                    </h2>
                </div>
            </div>
            
            <!-- add Bookmark Button for Users -->
            @guest
            @else
            <div class="col-lg-4 col-sm-6 text-right">
                <button type="button" data-context="investor" data-context-action="view" data-context-id="7" id="bookmark_btn"
                onclick="bookmarkBtnClick({{ $book->ISBN }})"
                @if ($book->bookmarked == 1)
                    class="pp-bookmark-btn btn btn-default btn-lg pull-right active"
                @else
                    class="pp-bookmark-btn btn btn-default btn-lg pull-right"
                @endif
                >
                </button>
            </div>
            @endguest
        </div>
    </div>

    <!-- Flash Messages -->
    <div class="container">
        <!-- Print success message that Booking was made -->
        @if(Session::has('Success'))
            <div class="alert alert-success">{{Session::get('Success')}}</div>
        @endif
        
        @if(Session::has('Fail'))
            <div class="alert alert-danger">{{Session::get('Fail')}}</div>
        @endif
    </div>    

    <!-- Book Details -->
    @include('admin.catalog.bookDetailsSection')

    <!-- Material Table -->
    <div class = "container my-3">

        <!-- add Booking Button for Users -->
        @auth
            <div class="col-lg-12 col-sm-12 text-right">
                <span><b>{{ $bookingQueue }}</b> People in Queue</span>
            </div>
        @if(!isset($booking))
            <div class="col-lg-12 col-sm-12 text-right">
                <a href="{{ route('create_booking', [ 'ISBN'=> $book->ISBN ]) }}" class="btn btn-info"
                onclick="return confirm('Are you sure you wish to Make a Booking for {{ $book->title }}?');">
                Make a Booking</a>
            </div>
        @else
            <div class="col-lg-12 col-sm-12 text-right">
                <a href="{{ route('cancel_booking', [ 'bookingID'=> $booking->id ]) }}" class="btn btn-info">
                    Cancel Current Booking
                </a>
            </div>
        @endif
        @endauth

        <div class="heading_container heading_center">
            <h2>
                Material Instances
            </h2>
        </div>
        <table class = "material-table">
            <tr>
                <th>Material No.</th>
                <th>Call No.</th>
                <th>Status</th>
            </tr>
            @foreach ($materials as $material)
            <tr>
                <td>
                    {{ sprintf('%08d', $material->material_no) }}<br>
                </td>
                <td>{{ $material->call_no }}</td>
                <td>
                    @switch($material->status)
                        @case(1)
                            Available
                            @break
                        @case(2)
                            Borrowed
                            @break
                        @case(3)
                            Booked
                            @break
                        @case(4)
                            Missing
                            @break
                        @default
                            Error Status
                    @endswitch
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Recommended Books section -->
    <section class="new_section layout_padding">
        <div class="new_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2>
                        Recommendations
                    </h2>
                </div>
                @if($recs->count() == 0)
                <div class="row justify-content-center">
                    <h2 class="text-muted text-center">No Recommendations to Be Made</h2>
                </div>
                <div class="row justify-content-center">
                    <h4 class="text-muted text-center">Be One of the First to Read this Book</h4>
                </div>
                @else
                <div class="scrollable-row">
                    @foreach ($recs as $book)
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
                @endif
            </div>
        </div>
    </section>
    <!-- Recommended New section -->

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- bookmark js -->
    <script type="text/javascript">
	 	var addBookmarkURL = "{{ route('add_bookmark') }}";
        var removeBookmarkURL = "{{ route('delete_bookmark') }}";
	</script>
    <script src="{{ asset('js/bookmark.js') }}"></script>

</body>

</html>