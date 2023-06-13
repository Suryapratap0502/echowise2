<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="form-label" for="Name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Service Type Name" value="{{$ser_type_data->name}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="{{$ser_type_data->id}}">

</div>