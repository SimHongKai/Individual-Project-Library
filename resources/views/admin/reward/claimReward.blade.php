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

    <title>Claim Reward</title>

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
            <div class = 'col-md-10 col-sm-12'>
                <h1><font face='Impact'>Claim Reward</font></h1>
                <form action="{{route('claim_reward_submit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Print success message that Reward WAS claimed -->
                    @if(Session::has('Success'))
                        <div class="alert alert-success">{{Session::get('Success')}}</div>
                    @endif
                    <!-- Print error message that Reward was NOT claimed -->
                    @if(Session::has('Fail'))
                        <div class="alert alert-danger">{{Session::get('Fail')}}</div>
                    @endif

                    <!-- Claim Reward Details -->
                    <div class="card my-3">
                        <div class="card-header">Claim Reward Details</div>
                        <div class="row no-gutters">                            
                            <div class="col-sm-3">
                                <img src="{{ asset('images/rewards/no_img_available.jpg') }}" class="card-img" id="reward_img">
                            </div>
                            <div class="col-sm-9">
                                <div class="card-body">      
                                    <!-- Form Input -->   
                                    <div class="form-group row">
                                        <label for="reward_history_id" class="col-3 col-form-label">Redemption Code</label> 
                                        <div class="col-6">
                                            <input id="reward_history_id" name="reward_history_id" placeholder="Redemption Code" 
                                            type="text" class="form-control" required
                                            onkeyup="getClaimDetails(this.value)">
                                            <span class="text-danger">@error('reward_history_id') {{ $message }} @enderror</span>
                                        </div>
                                    </div>   
                                    <!-- Form Input End -->        
                                    <span class="card-text-detail col-3">Username:</span>
                                    <span class="card-text-detail-content" id="username"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Reward:</span>
                                    <span class="card-text-detail-content" id="reward"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Description:</span>
                                    <span class="card-text-detail-content" id="description"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Points Spent:</span>
                                    <span class="card-text-detail-content" id="points_spent"></span>
                                    <br>
                                    <span class="card-text-detail col-3">Claimed On:</span>
                                    <span class="card-text-detail-content" id="claimed_on"></span>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Buttons -->
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                            <button class="btn btn-block btn-primary btn-md" type="submit">Claim Reward</button>
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
    <script src="{{ asset('js/claimReward.js') }}"></script>


</body>

</html>