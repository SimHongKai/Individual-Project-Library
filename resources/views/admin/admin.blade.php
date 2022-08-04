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

    <title>Admin Panel</title>

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
    
    <!-- category section -->
    <section class="catagory_section layout_padding">
        <div class="catagory_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2>
                        Admin Actions
                    </h2>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4 ">
                        <a href="{{ route('manage_books') }}">
                            <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('images/icons/catalog.png')}}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Manage Books & Materials
                                </h5>
                            </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 ">
                        <a href="{{ route('borrow_book') }}">
                            <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('images/icons/borrow_book.png')}}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Borrow
                                </h5>
                            </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 ">
                        <a href="{{ route('home') }}">
                            <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('images/icons/return_book.png')}}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Return
                                </h5>
                            </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 ">
                        <a href="{{ route('admin_borrow_records') }}">
                            <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('images/icons/record.png')}}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Records
                                </h5>
                            </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 ">
                        <a href="{{ route('home') }}">
                            <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('images/icons/reward.png')}}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Manage Rewards
                                </h5>
                            </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 ">
                        <a href="{{ route('home') }}">
                            <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('images/icons/config.png')}}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Library Configurations
                                </h5>
                            </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end category section -->

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>