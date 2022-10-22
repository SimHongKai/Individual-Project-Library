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

    <title>Edit Configuration</title>

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
                <h1><font face='Impact'>Edit Configuration</font></h1>
                <form action="{{ route('edit_configuration_submit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Print success message that Configuration was edited -->
                    @if(Session::has('Success'))
                        <div class="alert alert-success">{{Session::get('Success')}}</div>
                    @endif
                    <!-- Print error message that Configuration was NOT edited -->
                    @if(Session::has('Fail'))
                        <div class="alert alert-danger">{{Session::get('Fail')}}</div>
                    @endif

                    <!-- Config Form Data -->
                    <!-- Admin -->
                    <div class="form-group row">
                        <label for="admin_borrow_no" class="col-4 col-form-label">Admin Borrow Number</label>
                        <div class="col-8">
                        <input id="admin_borrow_no" name="admin_borrow_no" type="number" step="1" min="0" max="100" required
                            value="{{ $config[0]->no_of_borrows }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('admin_borrow_no') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group row">
                        <label for="admin_borrow_duration" class="col-4 col-form-label">Admin Borrow Duration (Days)</label>
                        <div class="col-8">
                        <input id="admin_borrow_duration" name="admin_borrow_duration" type="number" step="1" min="0" max="100" required
                            value="{{ $config[0]->borrow_duration }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('admin_borrow_duration') {{$message}} @enderror</span>
                    </div>
                    <!-- Privileged -->
                    <div class="form-group row">
                        <label for="privileged_borrow_no" class="col-4 col-form-label">Privileged Borrow Number</label>
                        <div class="col-8">
                        <input id="privileged_borrow_no" name="privileged_borrow_no" type="number" step="1" min="0" max="100" required
                            value="{{ $config[1]->no_of_borrows }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('privileged_borrow_no') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group row">
                        <label for="privileged_borrow_duration" class="col-4 col-form-label">Privileged Borrow Duration (Days)</label>
                        <div class="col-8">
                        <input id="privileged_borrow_duration" name="privileged_borrow_duration" type="number" step="1" min="0" max="100" required
                            value="{{ $config[1]->borrow_duration }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('privileged_borrow_duration') {{$message}} @enderror</span>
                    </div>
                    <!-- Regular -->
                    <div class="form-group row">
                        <label for="regular_borrow_no" class="col-4 col-form-label">Regular Borrow Number</label>
                        <div class="col-8">
                        <input id="regular_borrow_no" name="regular_borrow_no" type="number" step="1" min="0" max="100" required
                            value="{{ $config[2]->no_of_borrows }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('regular_borrow_no') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group row">
                        <label for="regular_borrow_duration" class="col-4 col-form-label">Regular Borrow Duration (Days)</label>
                        <div class="col-8">
                        <input id="regular_borrow_duration" name="regular_borrow_duration" type="number" step="1" min="0" max="100" required
                            value="{{ $config[2]->borrow_duration }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('regular_borrow_duration') {{$message}} @enderror</span>
                    </div>

                    <!-- Late Fees -->
                    <div class="form-group row">
                        <label for="late_fees_base" class="col-4 col-form-label">Late Fees Base (RM)</label>
                        <div class="col-8">
                        <input id="late_fees_base" name="late_fees_base" type="number" step="0.10" min="0" max="100" required
                            value="{{ $config[0]->late_fees_base }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('late_fees_base') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group row">
                        <label for="late_fees_increment" class="col-4 col-form-label">Late Fees Increment (RM)</label>
                        <div class="col-8">
                        <input id="late_fees_increment" name="late_fees_increment" type="number" step="0.10" min="0" max="100" required
                            value="{{ $config[0]->late_fees_increment }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('late_fees_increment') {{$message}} @enderror</span>
                    </div>
                    <!-- Point Limit -->
                    <div class="form-group row">
                        <label for="point_limit" class="col-4 col-form-label">Point Limit</label>
                        <div class="col-8">
                        <input id="point_limit" name="point_limit" type="number" step="100" min="0" required
                            value="{{ $config[0]->point_limit }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('point_limit') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="form-group row justify-content-center my-3">
                        <div class="col-sm-4">
                            <a class="btn btn-block btn-secondary btn-md" href="{{ route('admin_panel') }}">Cancel</a>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-block btn-primary btn-md" type="submit">Edit Configuration</button>
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


</body>

</html>