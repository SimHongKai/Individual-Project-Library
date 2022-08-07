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

    <title>Edit Reward</title>

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
        <div class='row justify-content-center my-3'>
            <div class = 'col-md-8'>
                <h1><font face='Impact'>Edit Reward</font></h1>
                <form action="{{ route('edit_reward_submit') }}" method="post" enctype="multipart/form-data"
                onSubmit="return confirm('Are you sure you wish to edit this Reward?');">
                    @csrf
                    <!-- Print error message that Reward was NOT edited -->
                    @if(Session::has('Fail'))
                        <div class="alert alert-danger">{{Session::get('Fail')}}</div>
                    @endif
                    <!-- Form Data -->
                    <!-- Hidden Old Call No -->
                    <input type="hidden" id="reward_id" name="reward_id" value="{{ $reward->id }}">
                    <div class="form-group row">
                        <label for="name" class="col-3 col-form-label">Reward Name</label> 
                        <div class="col-8">
                            <input id="name" name="name" placeholder="Reward Name" type="text" class="form-control" 
                            required value="{{ $reward->name }}">
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Reward Image</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="reward_img" name="reward_img" aria-describedby="fileInput">
                            <label class="custom-file-label" for="reward_img">Reward Image</label>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <img id="preview" src="{{ asset('images/rewards') }}/{{ $reward->reward_img }}" width=30% height=30%/>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-form-label">Reward Description</label>
                    </div>
                    <div class="form-group row">
                        <textarea id="description" name="description" placeholder="Reward Description" class="form-control" 
                        rows="5" required>{{ $reward->description }}</textarea>
                        <span class="text-danger">@error('description') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group row">
                        <label for="points_required" class="col-3 col-form-label">Points Required</label>
                        <div class="col-4">
                            <input id="points_required" name="points_required" type="number" min="0" max="999999" required
                            value="{{ $reward->points_required }}" placeholder="0" class="form-control">
                        </div>
                        <span class="text-danger">@error('points_required') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group row justify-content-center my-3">
                        <div class="col-sm-4">
                            <a class="btn btn-block btn-secondary btn-md" href="{{ route('manage_rewards') }}">Cancel</a>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-block btn-primary btn-md" type="submit">Edit Reward</button>
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
<!-- addBooks JS -->
<script src="{{ URL::asset('js/reward.js') }}"></script>

</body>

</html>