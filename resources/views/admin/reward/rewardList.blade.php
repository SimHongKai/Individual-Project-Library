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

    <title>Manage Rewards</title>

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
        <div class='row justify-content-center my-3'>
                <h1><font face='Impact'>Manage Rewards</font></h1>
        </div>
        <div class="row">
            <div class="col-6 text-left"> 
                <div class = 'btn'>
                    <a href="{{ route('admin_panel') }}" class="btn btn-info">Return</a>
                </div>
            </div>
            <div class="col-6 text-right">
                <div class = 'btn'>
                    <a href="{{ route('add_reward') }}" class="btn btn-info">Add Reward</a>
                </div>
            </div>
        </div>
        <!-- Print success message that Reward was added -->
        @if(Session::has('Success'))
            <div class="alert alert-success">{{Session::get('Success')}}</div>
        @endif
        
        @if(Session::has('Error'))
            <div class="alert alert-danger">{{Session::get('Error')}}</div>
        @endif
    </div>    

    <!-- reward card detail box -->
    <div class="container">
        <div class="row justify-content-center no-gutters">
        @foreach($rewards as $reward)
            <div class="card col-lg-3 col-sm-6 m-3">
                <img src="{{ asset('images/rewards') }}/{{ $reward->reward_img }}" class="card-img-top" 
                style="height: 25vw; object-fit: contain;" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $reward->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Points Required: {{ $reward->points_required }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Qty Remaining: {{ $reward->available_qty }}</h6>
                    <p class="card-text">
                        {{ $reward->description }}
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('edit_reward', [ 'reward_id'=> $reward->reward_id ]) }}" class="card-link">Edit</a>
                    <a href="{{ route('delete_reward', [ 'reward_id'=> $reward->reward_id ]) }}" 
                    class="card-link" onclick="return confirm('Are you sure you wish to Delete this Reward? {{ $reward->name }}');">
                        Delete
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>