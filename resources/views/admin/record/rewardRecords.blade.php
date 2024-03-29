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
        <ul class="action_bar font-weight-bold">
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
            <li>
                <a href="{{ route('admin_unclaimed_rewards') }}">
                    Unclaimed Rewards
                </a>
            </li>
        </ul>
    </div>

    <!-- Reward Table -->
    <div class = "container my-3">

        @if($rewardHistory->count() == 0)
        <h2 class="text-muted text-center">No Reward History Found</h2>
        @else
        <table class = "record-table">
            <tr>
                <th>Redemption ID</th>
                <th>User</th>
                <th>Reward</th>
                <th>Description</th>
                <th>Points Spent</th>
                <th>Status</th>
                <th>Redeemed At</th>
            </tr>
            @foreach($rewardHistory as $record) 
                <tr>
                    <td class = "col-lg-2 col-md-4 col-sm-6">
                        <div class = "row justify-content-center">
                        {!! DNS1D::getBarcodeHTML(sprintf('%08d', $record->reward_history_id), 'C128') !!}
                        </div>
                    </td>
                    <td>{{ $record -> username }}</td>
                    <td>{{ $record -> name }}</td>
                    <td>{{ $record -> description }}</td>
                    <td>
                        {{ $record -> points_required }}
                    </td>
                    <td>
                        @switch($record->status)
                            @case(1)
                                <p class="text-warning">Unclaimed/Redeemed</p>
                                @break
                            @case(2)
                                <p class="text-success">Claimed</p>
                                @break
                            @case(3)
                                <p class="text-danger">Cancelled</p>
                                @break
                            @default
                                Error Status
                        @endswitch
                    </td>
                    <td class = "record-table-title">
                        <span>{{ $record->created_at }}</span>
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