<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Name">Select Service Type</label>
            <select class="form-select" name="cat_id" id="cat_id">
                <option value="" selected>Select</option>
                @if(!empty($service_type))
                @foreach($service_type as $value)
                <option value="{{ $value->id}}" @if($value->id == $fetch_cat_data->service_type){{'Selected'}} @endif>{{ $value->name }}</option>
                @endforeach
                @endif
            </select>
            <span id="cat_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$fetch_cat_data->category}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Name">Select Image</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="" value="{{$fetch_cat_data->cat_image}}">
            <span id="upload_error" class="error"></span>
        </div>
        <img src="{{asset('uploads/category/'.$fetch_cat_data->cat_image)}}" style="width:100px;">
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="{{$fetch_cat_data->id}}">

</div>