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

    <title>Return Book</title>

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
    
    <!-- Action Buttons -->
    <div class="container">
        <div class="row">
            <div class="col-6 text-left"> 
                <div class = 'btn'>
                    <a href="{{ route('admin_panel') }}" class="btn btn-info">Return</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class = 'col-md-10'>
                <h1><font face='Impact'>Return Book</font></h1>
                <form action="{{ route('return_book_submit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Print success message that Books WAS returned -->
                    @if(Session::has('Success'))
                        <div class="alert alert-success">{{Session::get('Success')}}</div>
                    @endif
                    <!-- Print error message that Books was NOT returned -->
                    @if(Session::has('Fail'))
                        <div class="alert alert-danger">{{Session::get('Fail')}}</div>
                    @endif
                    
                    <!-- Form Input -->   
                    <div class="form-group row">
                        <label for="material_no" class="col-3 col-form-label">Material No</label> 
                        <div class="col-6">
                            <input id="material_no" name="material_no" placeholder="Material No" 
                            type="text" class="form-control" required
                            onkeyup="getReturnDetails(this.value)">
                            <span class="text-danger">@error('material_no') {{ $message }} @enderror</span>
                        </div>
                    </div>   
                    <!-- Form Input End -->

                    <!-- User Returning -->
                    <div class="card my-3">
                        <div class="card-header">
                            User Details
                        </div>
                        <div class="card-body">                       
                            <span class="card-text-title col-4">Username:</span>
                            <span class="card-text-title-content" id="username"></span>
                            <br>
                            <span class="card-text-detail col-4">Privilege Level:</span>
                            <span class="card-text-detail-content" id="privilege"></span>
                            <br>
                            <span class="card-text-detail col-4">No. of Currently Borrowed Books:</span>
                            <span class="card-text-detail-content" id="borrowed"></span>
                            <br>
                            <span class="card-text-detail col-4">No. of Available Borrows:</span>
                            <span class="card-text-detail-content" id="available"></span>
                        </div>
                    </div>

                    <!-- Book Being Returned -->
                    <div class="card my-3">
                        <div class="card-header">Book to be Returned</div>
                        <div class="row no-gutters">                            
                            <div class="col-sm-3">
                                <img src="{{ asset('images/book_covers/no_book_cover.jpg') }}" class="card-img" id="cover_img">
                            </div>
                            <div class="col-sm-9">
                                <div class="card-body">            
                                    <span class="card-text-title col-3">Book Title:</span>
                                    <span class="card-text-title-content" id="title"></span>
                                    <br>
                                    <span class="card-text-detail col-3">ISBN-13 Number:</span>
                                    <span class="card-text-detail-content" id="ISBN"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Author:</span>
                                    <span class="card-text-detail-content" id="author"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Publication:</span>
                                    <span class="card-text-detail-content" id="publication"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Language:</span>
                                    <span class="card-text-detail-content" id="language"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Access Level:</span>
                                    <span class="card-text-detail-content" id="access_level"></span>
                                    <span class="" id="access_dot"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Borrowed At:</span>
                                    <span class="card-text-detail-content" id="borrowed_at"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Due At:</span>
                                    <span class="card-text-detail-content" id="due_at"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Late Fee (RM): </span>
                                    <span class="card-text-detail-content text-danger" id="late_fee"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Buttons -->
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                            <button class="btn btn-block btn-primary btn-md" type="submit">Return Book</button>
                        </div>
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
    <!-- return js -->
    <script src="{{ asset('js/return.js') }}"></script>


</body>

</html>