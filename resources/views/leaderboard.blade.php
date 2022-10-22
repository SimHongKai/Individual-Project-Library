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

    <title>Leaderboard</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Custom styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/leaderboard.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('header')

    <!-- Action Buttons -->
    <div class="container">
        <div class='row justify-content-center my-3'>
            <h1><font face='Impact'>Total Leaderboard</font></h1>
        </div>
        <div class="row">
            <div class="col-12 text-right"> 
                <div class = 'btn'>
                    <a href="{{ route('weekly_leaderboard') }}" class="btn btn-info">Weekly Board</a>
                </div>
            </div>
        </div>
        <div class="row my">
            <div class="col-12 text-center"> 
                <h6 class = 'title'>
                    <span>You are ranked No.{{ $position }}, with {{ Auth::user()->total_points }} points.</span>
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center"> 
                <div class = 'btn'>
                    <a href="{{ route('leaderboard') }}?page={{ $pageNumber }}" class="btn btn-info">Jump to Your Position</a>
                </div>
            </div>
        </div>
    </div>

    <div class ="container">
    <div class ="row justify-content-center">
        <div class="card one">
            <div class="header">
                <h3 class="title">Total Points Leaderboard</h3>
                <div></div>
            </div>
            <div class="profile">
                <div class="person second">
                <div class="num">2</div>
                <i class="fas fa-caret-up"></i>
                <img src="{{ asset('images/icons/crown.png') }}" alt="" class="photo">
                @isset($topUsers[1])
                    <p class="link">{{ $topUsers[1]->username }}</p>
                    <p class="points">{{ $topUsers[1]->total_points }}</p>
                @endisset
                </div>
                <div class="person first">
                <div class="num">1</div>
                <i class="fas fa-crown"></i>
                <img src="{{ asset('images/icons/2nd.png') }}" alt="" class="photo main">
                @isset($topUsers[0])
                    <p class="link">{{ $topUsers[0]->username }}</p>
                    <p class="points">{{ $topUsers[0]->total_points }}</p>
                @endisset
                </div>
                <div class="person third">
                <div class="num">3</div>
                <i class="fas fa-caret-up"></i>
                <img src="{{ asset('images/icons/3rd.png') }}" alt="" class="photo">
                @isset($topUsers[2])
                    <p class="link">{{ $topUsers[2]->username }}</p>
                    <p class="points">{{ $topUsers[2]->total_points }}</p>
                @endisset
                </div>
            </div>
            <div class="rest">
                @php
                    $i = $users->firstItem()
                @endphp
                @foreach($users as $user)
                    <div class="others flex">    
                        <div class="rank">
                            <i class="fas fa-caret-up"></i>
                            <p class="num">{{ $i++ }}</p>
                        </div>
                        <div class="info">
                            <p class="link">{{ $user->username }}</p>
                            <p class="points">{{ $user->total_points }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
    </div>
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>