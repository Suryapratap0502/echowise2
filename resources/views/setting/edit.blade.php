<form id="edit_setting" method="post">
    <div class="form-group row align-items-center">
        <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{$item->name}}">
        </div>
    </div>
    <div class="form-group row align-items-center">
        <label class="col-sm-3 col-form-label font-weight-bolder">Email</label>
        <div class="col-sm-9">
            <input type="email" class="form-control" name="email" placeholder="Full Name" value="{{$item->email}}" readonly>
        </div>
    </div>
    <div class="form-group row align-items-center">
        <label class="col-sm-3 col-form-label font-weight-bolder">Contact</label>
        <div class="col-sm-9">
            <input type="number" class="form-control" name="mobile" value="{{$item->mobile_no}}">
        </div>
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="{{$item->id}}">

    <div class="form-group row align-items-center mt-2">
        <label class="col-sm-3 col-form-label"></label>
        <div class="col-sm-9">
            <button type="submit" class="btn btn-eco">Update</button>
        </div>
    </div>
</form>