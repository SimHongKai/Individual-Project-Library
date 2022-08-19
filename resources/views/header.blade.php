<!-- header section strats -->
<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          	<a class="navbar-brand" href="{{ route('home') }}">
            	<span>
              		Library
            	</span>
          	</a>

          	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            	<span class=""> </span>
          	</button>

          	<div class="collapse navbar-collapse" id="navbarSupportedContent">
            	<ul class="navbar-nav">
					<!-- Admin Bar Link -->
					@guest
					@else
					@if (Auth::user()->privilege == 1)
					<li class="nav-item">
						<a class="nav-link pl-lg-0" href="{{route('admin_panel')}}">Admin</a>
					</li>
					@endif
					@endguest
					<!-- Regular Nav Bar -->
              		<li class="nav-item">
                		<a class="nav-link" href="{{ route('home') }}">Home</a>
              		</li>
              		<li class="nav-item">
                		<a class="nav-link" href="{{ route('catalog') }}">Catalog</a>
              		</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('reward_shop') }}">Rewards</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('leaderboard') }}">Leaderboard</a>
					</li>
					<!-- Right Side Of Navbar -->
					<!-- Authentication Links -->
					@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">Login</a>
					</li>				
					@else
					<li class="nav-item">
						<a class="nav-link" href="{{ route('profile') }}">{{ Auth::user()->username }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							Logout
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</li>
					@endguest
            	</ul>
          	</div>
        </nav>
    </div>
</header>
<!-- end header section -->