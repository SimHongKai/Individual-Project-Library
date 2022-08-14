<div class="heading_container heading_center my-3">
    <h2>
        Profile
    </h2>
</div>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <div class="profile-card p-3 py-4">

                <div class="text-center">
                    <img src="{{ asset('images/rewards/no_img_available.jpg') }}" width="100" class="rounded-circle">
                </div>
        
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white">
                    @switch($user->privilege)
                        @case(1)
                            Admin
                            @break
                        @case(2)
                            Priviliged User
                            @break
                        @case(3)
                            Regular User
                            @break
                        @default
                            Error Undefined Privilige
                    @endswitch
                    </span>
                    <h5 class="mt-2 mb-0">{{ $user->username }}</h5>
                    <span class="font-weight-bold">Current Points:</span> 
                    <span>{{ $user->current_points }}</span>
                    <span class="font-weight-bold">Total Points:</span> 
                    <span>{{ $user->total_points }}</span>
                    <span class="font-weight-bold">Weekly Points:</span> 
                    <span>{{ $user->weekly_points }}/{{ $user->point_limit }}</span>
                    <h5 class="mt-2 mb-0">{{ Auth::id() }}</h5>

                    <div class="px-4 mt-1">
                        <p class="fonts">
                            This is Your Personal Profile. View your Bookmarks, History of Borrows and Rewards through the Buttons Below.
                        </p>    
                    </div>
                    
                     <!-- <ul class="social-list">
                        <li><i class="fa fa-facebook"></i></li>
                        <li><i class="fa fa-dribbble"></i></li>
                        <li><i class="fa fa-instagram"></i></li>
                        <li><i class="fa fa-linkedin"></i></li>
                        <li><i class="fa fa-google"></i></li>
                    </ul> -->
                    
                    <div class="profile-buttons"> 
                        @if (strcmp($user->last_check_in, date('Y-m-d')) == 0 ) <!-- same day disable button--> 
                        <p class="btn btn-outline-primary px-4 text-muted">Daily Points Claimed</p>
                        @else
                        <a href="{{ route('claim_daily') }}" class="btn btn-outline-primary px-4">Claim Daily Points</a>
                        @endif
                    </div> 

                </div>
            </div>
        </div>
    </div>
</div>