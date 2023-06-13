<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Name">Select Category</label>
            <select class="form-select" name="cat_id" id="cat_id">
                <option value="" selected>Select</option>
                @if(!empty($category))
                @foreach($category as $value)
                <option value="{{ $value->id}}" @if($value->id == $fetch_subcat_data->cat_id){{'Selected'}} @endif>{{ $value->category }}</option>
                @endforeach
                @endif
            </select>
            <span id="cat_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$fetch_subcat_data->subcategory}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Name">Select Image</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="" value="{{$fetch_subcat_data->subcat_image}}">
            <span id="upload_error" class="error"></span>
        </div>
        <img src="{{asset('uploads/subcategory/'.$fetch_subcat_data->subcat_image)}}" style="width:100px;">
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="{{$fetch_subcat_data->id}}">

</div>