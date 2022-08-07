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
            <div class="col-1 text-left"> 
                <div class = 'btn'>
                    <a href="{{ URL::previous() }}" class="btn btn-info">Return</a>
                </div>
            </div>
            <div class="col-10 text-center">
                <div class="heading_container heading_center">
                    <h2>
                        Book Details
                    </h2>
                </div>
            </div>
            @guest
            @else
            <div class="col-1 text-right">
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

    <!-- Book Details -->
    @include('admin.catalog.bookDetailsSection')

    <!-- Material Table -->
    <div class = "container">
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
                    {!! DNS1D::getBarcodeHTML(sprintf('%08d', $material->material_no), 'UPCA') !!}   
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