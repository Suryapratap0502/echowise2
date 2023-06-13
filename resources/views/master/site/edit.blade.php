<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$site_data->name}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label class="form-label" for="location">Email</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" value="{{$site_data->location}}">
            <span id="location_error" class="error"></span>
        </div>
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="{{$site_data->id}}">
</div>