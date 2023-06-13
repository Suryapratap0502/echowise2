<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="vehicle_number">Vehical Number</label>
            <input type="text" class="form-control" id="vehicle_number" placeholder="Enter Vehical Number" name="vehicle_number" value="{{$vehicle->vehicle_number}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="vehicle_type">Vehical Type</label>
            <input type="text" class="form-control" id="vehicle_type" placeholder="Enter Vehical Type" name="vehicle_type" value="{{$vehicle->vehicle_type}}">
            <span id="vehicle_type_error" class="error"></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="capacity">Capacity (In TON)</label>
            <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Enter Capacity (In TON)" value="{{$vehicle->capacity}}"></textarea>
            <span id="capacity_error" class="error"></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label" for="size">Size (In Foot)</label>
            <input type="text" class="form-control" id="size" name="size" placeholder="Enter Size (In Foot)" value="{{$vehicle->size}}"></textarea>
            <span id="size_error" class="error"></span>
        </div>
    </div>


    <input type="hidden" class="form-control" id="id" name="id" value="{{$vehicle->id}}">

</div>