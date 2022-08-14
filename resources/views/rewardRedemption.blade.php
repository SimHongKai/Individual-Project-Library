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

    <title>Reward Redemption</title>

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
    
    <!-- Title -->
    <div class="heading_container heading_center my-3">
        <h2>
            Reward Redemption
        </h2>
    </div>

    <!-- Flash Messages -->
    <div class="container">
        <!-- Print success message that Reward was claimed -->
        @if(Session::has('Success'))
            <div class="alert alert-success">{{Session::get('Success')}}</div>
        @endif
        
        @if(Session::has('Fail'))
            <div class="alert alert-danger">{{Session::get('Fail')}}</div>
        @endif
    </div>    

    <!-- reward card detail box -->
    <div class="container">
        <div class="row justify-content-center no-gutters">
        @foreach($rewards as $reward)
            <div class="card col-3 m-3">
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
                    <!-- Only enable Link if User has ENOUGH points to CLAIM reward -->
                    @if (Auth::user()->current_points >= $reward->points_required)
                        <a href="{{ route('claim_reward', [ 'reward_id'=> $reward->id ]) }}" class="card-link"
                        onclick="return confirm('Are you sure you wish to Claim this Reward? {{ $reward->name }}');">
                    @else
                        <a class="card-subtitle mb-2 text-muted">
                    @endif
                        Redeem
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