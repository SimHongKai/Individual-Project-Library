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

    <title>Edit Material</title>

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
    <!-- Title and Button -->
    <div class="container">
        <div class="row justify-content-start my-3">
            <div class = 'stock_buttons'>
                <a href="{{ route('manage_book_details', [ 'ISBN'=> $book->ISBN ]) }}" 
                class="btn btn-info">Return</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="heading_container heading_center">
                <h2>
                    Book Details
                </h2>
            </div>
        </div>
    </div>

    <!-- Book Details -->
    @include('admin.catalog.bookDetailsSection')

    <!-- Edit Material Form -->
    <div class="container">
        <div class='row justify-content-center'>
            <div class = 'col-md-8'>
                <h1><font face='Impact'>Edit Material</font></h1>
                <form action="{{route('edit_material_submit')}}" method="post" enctype="multipart/form-data"
                        onSubmit="return confirm('Are you sure you wish to Edit Material?');">
                    @csrf
                    <!-- Print error message that Material was NOT edited -->
                    @if(Session::has('Fail'))
                        <div class="alert alert-danger">{{Session::get('Fail')}}</div>
                    @endif
                    <!-- Hidden Old Call No -->
                    <input type="hidden" id="old_call_no" name="old_call_no" value="{{ $material->call_no }}">
                    <!-- Form Fields -->
                    <div class="form-group row">
                        <label for="material_no" class="col-4 col-form-label">Material No</label> 
                        <div class="col-8">
                            <input id="material_no" name="material_no" type="text" class="form-control" 
                            required readonly value="{{ sprintf('%08d', $material->material_no) }}">
                            <span class="text-danger">@error('material_no') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="call_no" class="col-4 col-form-label">Call No</label> 
                        <div class="col-8">
                            <input id="call_no" name="call_no" placeholder="Call No" type="text" class="form-control" 
                            required value="{{ $material->call_no }}">
                            <span class="text-danger">@error('call_no') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-4 col-form-label">Default Status</label> 
                        <div class="col-8">
                            <select class="custom-select form-select-lg mb-3" id="status" name="status">
                                <!-- Can't change borrowed or booked books status -->
                                @if ($material->status == 2)
                                    <option value=2 selected>Borrowed</option>
                                @elseif ($material->status == 3)
                                    <option value=3 selected>Booked</option>
                                @else
                                    <option value=1 @if ($material->status == 1) {{ 'selected' }} @endif>Available</option>
                                    <option value=4 @if ($material->status == 4) {{ 'selected' }} @endif>Missing</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="intake_date" class="col-4 col-form-label">Intake Date</label> 
                        <div class="col-8">
                            <input id="intake_date" name="intake_date" placeholder="Intake Date" type="datetime" 
                            class="form-control" readonly value="{{ $material->created_at }}">
                            <span class="text-danger">@error('intake_date') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center my-3">
                        <button class="btn btn-block btn-primary col-4" type="submit">
                            Edit Material
                        </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    @include('footer')

<!-- jQery -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>