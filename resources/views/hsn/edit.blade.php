<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Name">HSN Code</label>
            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$fetch_hsn_data->hsn_code}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="Name">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{$fetch_hsn_data->description}}</textarea>
            <span id="name_error" class="error"></span>
        </div>
    </div>


    <input type="hidden" class="form-control" id="id" name="id" value="{{$fetch_hsn_data->id}}">

</div>