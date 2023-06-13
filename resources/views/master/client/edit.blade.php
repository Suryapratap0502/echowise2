<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$client_data->name}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{$client_data->email}}">
            <span id="email_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">Contact</label>
            <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter Contact No." value="{{$client_data->contact}}">
            <span id="contact_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">State</label>
            <select class="form-select" name="state" id="state" require>
                <option>Select</option>
                @if(!empty($state))
                @foreach($state as $value)
                <option value="{{ $value->id}}" @if($value->id == $client_data->state_id){{'Selected'}} @endif>{{ $value->state_name }}</option>
                @endforeach
                @endif
            </select>
            <span id="state_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">Location</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" value="{{$client_data->location}}">
            <span id="location_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">PAN No.</label>
            <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter PAN No." value="{{$client_data->pan}}">
            <span id="pan_error" class="error"></span>
        </div>
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="{{$client_data->id}}">
</div>