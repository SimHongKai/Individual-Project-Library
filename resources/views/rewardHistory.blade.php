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

    <title>Reward History</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('header')

    @include('profile')

    <!-- action bar -->
    <div class="container">
        <ul class="action_bar">
            <li>
                <a href="{{ route('profile') }}">
                    Bookmarks
                </a>
            </li>
            <li>
                <a href="{{ route('profile_borrows') }}">
                    Borrow History
                </a>
            </li>
            <li>
                <a href="{{ route('profile_rewards') }}">
                    Reward History
                </a>
            </li>
        </ul>
    </div>

    <div class="heading_container heading_center my-3">
        <h2>
            Reward History
        </h2>
    </div>

    <!-- Reward Table -->
    <div class = "container my-3">

        @if($rewardHistory->count() == 0)
        <h2 class="text-muted text-center">No Reward History Found</h2>
        @else
        <table class = "record-table">
            <tr>
                <th>Time Claimed</th>
                <th>Reward</th>
                <th>Description</th>
                <th>Points Spent</th>
                <th>Status</th>
            </tr>
            @foreach($rewardHistory as $record) 
                <tr>
                    <td class = "record-table-title">
                        <span>{{ $record->created_at }}</span>
                    </td>
                    <td>{{ $record -> name }}</td>
                    <td>{{ $record -> description }}</td>
                    <td>
                        {{ $record -> points_required }}
                    </td>
                    <td>
                        @switch($record->status)
                            @case(1)
                                Unclaimed/Redeemed
                                @break
                            @case(2)
                                Claimed
                                @break
                            @case(3)
                                Canceled
                                @break
                            @default
                                Error Status
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </table>
        @endif
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