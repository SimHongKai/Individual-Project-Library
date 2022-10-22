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

    <title>VarDump</title>

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
            Var Dump
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

    <!-- Var Dump -->
    @foreach($recommendations as $recommendation)        
        {{ $recommendation }}
    @endforeach
    <div class="container">
        @dd($__data)
    </div>

    @include('footer')

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>