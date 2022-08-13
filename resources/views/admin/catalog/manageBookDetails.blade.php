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
        <!-- Error or Success Messages -->
        @if(Session::has('Success'))
            <div class="alert alert-success">{{Session::get('Success')}}</div>
        @endif
        @if(Session::has('Fail'))
            <div class="alert alert-danger">{{Session::get('Fail')}}</div>
        @endif

        <div class="row">
            <div class="col-1 text-left"> 
                <div class = 'btn'>
                    <a href="{{ URL::previous() }}" class="btn btn-info">Return</a>
                </div>
            </div>
            <div class="col-11 text-center">
                <div class="heading_container heading_center">
                    <h2>
                        Book Details
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="container">
        <div class="row justify-content-end">
            <ul class="book-action-bar">
                <li>
                    <a href="{{ route('edit_book', [ 'ISBN'=> $book->ISBN ]) }}">
                        <img class="icon" src = "{{ asset('images/icons/edit.png') }}"/>
                        <span>Edit</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('remove_book', [ 'ISBN'=> $book->ISBN ]) }}"
                    onclick="return confirm('Are you sure you wish to Remove this Book?: {{ $book->ISBN }}');">
                        <img class="icon" src = "{{ asset('images/icons/remove.png') }}"/>
                        <span>Remove</span>
                    </a>
                </li>
            </ul>
        </div>
        <hr>
    </div>

    <!-- Book Details -->
    @include('admin.catalog.bookDetailsSection')

    <!-- Material Table -->
    <div class = "container my-3">
        <div class="heading_container heading_center">
            <h2>
                Material Instances
            </h2>
        </div>
        <!-- Error or Success Messages -->
        @if(Session::has('Mat Success'))
            <div class="alert alert-success">{{Session::get('Mat Success')}}</div>
        @endif
        <div class="row justify-content-end">
            <ul class="book-action-bar">
                <li>
                    <a href="{{ route('add_material', [ 'ISBN'=> $book->ISBN ]) }}">
                        <img class="icon" src = "{{ asset('images/icons/add.png') }}"/>
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
                <th>Intake Time</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach ($materials as $material)
            <tr>
                <td>
                    {{ sprintf('%08d', $material->material_no) }}
                    <div class = "row justify-content-center">
                        {!! DNS1D::getBarcodeHTML(sprintf('%08d', $material->material_no), 'C128') !!}
                    </div>
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
                <td>{{ $material->created_at }}</td>
                <td>
                    <a href="{{ route('edit_material', [ 'material_no'=> $material->material_no ]) }}" class="btn btn-outline-primary">
                        <span>Edit</span>
                    </a>
                </td>
                <td>
                    <a href="{{ route('remove_material', [ 'material_no'=> $material->material_no ]) }}" class="btn btn-outline-danger"
                    onclick="return confirm('Are you sure you wish to Remove this Material?: {{ sprintf(' %08d', $material->material_no) }}');">
                        <span>Remove</span>
                    </a>
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

</body>

</html>