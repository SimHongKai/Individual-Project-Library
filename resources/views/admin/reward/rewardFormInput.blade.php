<!-- Form Data -->
<div class="form-group row">
    <label for="name" class="col-4 col-form-label">Reward Name</label> 
    <div class="col-8">
        <input id="name" name="name" placeholder="Reward Name" type="text" class="form-control" 
        required value="{{ old('name') }}">
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
    <img style="visibility:hidden" id="preview" src="" width=30% height=30%/>
</div>
<div class="form-group row">
    <label for="description" class="col-form-label">Reward Description</label>
</div>
<div class="form-group row">
    <textarea id="description" name="description" placeholder="Book Description" class="form-control" 
    rows="5" required>{{ old('description') }}</textarea>
    <span class="text-danger">@error('description') {{$message}} @enderror</span>
</div>
<div class="form-group row">
    <label for="points_required" class="col-4 col-form-label">Points Required</label>
    <div class="col-8">
        <input id="points_required" name="points_required" type="number" min="0" max="999999" required
        value="{{ old('points_required') }}" placeholder="0" class="form-control">
    </div>
    <span class="text-danger">@error('points_required') {{$message}} @enderror</span>
</div>
<div class="form-group row justify-content-center my-3">
    <div class="col-sm-4">
        <a class="btn btn-block btn-secondary btn-md" href="{{ route('manage_rewards') }}">Cancel</a>
    </div>
    <div class="col-sm-4">
        <button class="btn btn-block btn-primary btn-md" type="submit">Add Reward</button>
    </div>
</div>