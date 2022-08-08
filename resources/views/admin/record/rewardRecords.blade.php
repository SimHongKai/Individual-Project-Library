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

    <title>Reward Records</title>

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
    <div class="container">
        <!-- Action Buttons -->
        <div class="row">
            <div class="col-6 text-left"> 
                <div class = 'btn'>
                    <a href="{{ route('admin_panel') }}" class="btn btn-info">Return</a>
                </div>
            </div>
        </div>
    </div>

    <!-- action bar -->
    <div class="container">
        <ul class="action_bar">
            <li>
                <a href="{{ route('admin_borrow_records') }}">
                    Borrow History
                </a>
            </li>
            <li>
                <a href="{{ route('admin_reward_records') }}">
                    Reward History
                </a>
            </li>
        </ul>
    </div>

    <!-- Borrow Table -->
    <div class = "container">
        
        <table class = "record-table">
            <tr>
                <th>Time Claimed</th>
                <th>User</th>
                <th>Reward</th>
                <th>Description</th>
                <th>Points Spent</th>
            </tr>
            @foreach($rewardHistory as $record) 
                <tr>
                    <td class = "record-table-title">
                        <span>{{ $record->created_at }}</span>
                    </td>
                    <td>{{ $record -> username }}</td>
                    <td>{{ $record -> name }}</td>
                    <td>{{ $record -> description }}</td>
                    <td>
                        {{ $record -> points_required }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $rewardHistory->links() }}
    </div>

    @include('footer')

    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>