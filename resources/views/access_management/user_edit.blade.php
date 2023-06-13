
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <label class="form-label" for="Name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$fetch_user_data->name}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <label class="form-label" for="Email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="" value="{{$fetch_user_data->email}}" readonly>
            <span id="email_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Contact">Contact</label>
            <input type="number" class="form-control" id="contact" name="contact" placeholder="" value="{{$fetch_user_data->mobile_no}}">
            <span id="contact_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <label class="form-label" for="Name">Select Role</label>
            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="role" id="role">
                <option value="" selected>Select</option>
                @if(!empty($roles))
                @foreach($roles as $value)
                <option value="{{$value->id}}" @if($value->id == $fetch_user_data->role_id){{'Selected'}} @endif>{{ $value->role }}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <label class="form-label" for="Name">Select Image</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="" value="{{$fetch_user_data->staff_image}}">
            <span id="upload_error" class="error"></span>
        </div>
        
    </div>
    <div class="col-sm-6">
        <img src="{{asset('uploads/staff/'.$fetch_user_data->staff_image)}}" style="width:100px;">
    </div>

    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$fetch_user_data->id}}">

</div>