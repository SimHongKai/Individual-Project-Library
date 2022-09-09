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

    <title>Borrow Book - Booking</title>

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
            <div class="col-6 text-right"> 
                <div class = 'btn'>
                    <a href="{{ route('borrow_book') }}" class="btn btn-primary">Regular Borrows</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class = 'col-md-10 col-sm-12'>
                <h1><font face='Impact'>Borrow Book</font></h1>
                <form action="{{route('borrow_book_submit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Print success message that Books WAS borrowed -->
                    @if(Session::has('Success'))
                        <div class="alert alert-success">{{Session::get('Success')}}</div>
                    @endif
                    <!-- Print error message that Books was NOT borrowed -->
                    @if(Session::has('Fail'))
                        <div class="alert alert-danger">{{Session::get('Fail')}}</div>
                    @endif

                    <!-- Form Input -->   
                    <div class="form-group row">
                        <label for="booking_id" class="col-5 col-form-label"><b>Booking ID</b></label> 
                        <div class="col-lg-5">
                            <input id="booking_id" name="booking_id" placeholder="Booking ID" type="text" 
                            class="form-control" required onkeyup="getBookingDetails(this.value)">

                            <span class="text-danger">@error('booking_id') {{ $message }} @enderror</span>
                        </div>
                    </div>   
                    <!-- Form Input End -->   

                    <!-- User Borrowing -->
                    <div class="card my-3">
                        <div class="card-header font-weight-bold">
                            Borrowing User Details
                        </div>
                        <div class="card-body">      
                            <!-- Form Input -->   
                            <div class="form-group row">
                                <div class="col-sm-1"></div>
                                <label for="user_id" class="col-4 col-form-label font-weight-bold">User ID</label> 
                                <div class="col-5">
                                    <input id="user_id" name="user_id" placeholder="User ID" type="text" 
                                    readonly class="form-control" required"
                                    @if ($user->user_id)
                                        value="{{ $user->user_id }}" 
                                    @endif>
                                    <span class="text-danger">@error('user_id') {{ $message }} @enderror</span>
                                </div>
                            </div>   
                            <!-- Form Input End -->                       
                            <span class="card-text-title col-4">Username:</span>
                            <span class="card-text-title-content" id="username">{{ $user->username }}</span>
                            <br>
                            <span class="card-text-detail col-4">Privilege Level:</span>
                            <span class="card-text-detail-content" id="privilege">
                            @switch($user->privilege)
                                @case(1)
                                    Admin
                                    @break
                                @case(2)
                                    Privileged User
                                    @break
                                @case(3)
                                    Basic User
                                    @break
                            @endswitch
                            </span>
                            <br>
                            <span class="card-text-detail col-4">No. of Currently Borrowed Books:</span>
                            <span class="card-text-detail-content" id="borrowed">{{ $user->borrowed }}</span>
                            <br>
                            <span class="card-text-detail col-4">No. of Available Borrows:</span>
                            <span class="card-text-detail-content" id="available">{{ $user->available }}</span>
                        </div>
                    </div>

                    <!-- Book Being Borrowed -->
                    <div class="card my-3">
                        <div class="card-header font-weight-bold">Book to be Borrowed</div>
                        <div class="row no-gutters">                            
                            <div class="col-sm-3">
                                <img src="{{ asset('images/book_covers/no_book_cover.jpg') }}" class="card-img" id="cover_img">
                            </div>
                            <div class="col-sm-9">
                                <div class="card-body">      
                                    <!-- Form Input -->   
                                    <div class="form-group row">
                                        <label for="material_no" class="col-3 col-form-label font-weight-bold">Material No</label> 
                                        <div class="col-6">
                                            <input id="material_no" name="material_no" placeholder="Material No" 
                                            type="text" class="form-control" readonly required">
                                            <span class="text-danger">@error('material_no') {{ $message }} @enderror</span>
                                        </div>
                                    </div>   
                                    <!-- Form Input End -->        
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Buttons -->
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                            <button class="btn btn-block btn-primary btn-md" type="submit">Borrow Book</button>
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
    <!-- borrow ajax query js -->
    <script src="{{ asset('js/borrow.js') }}"></script>


</body>

</html>