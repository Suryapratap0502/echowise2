<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="form-label" for="Name">Payment Method</label>
            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$fetch_pay_method->pay_method}}">
            <span id="name_error" class="error"></span>
        </div>
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="{{$fetch_pay_method->id}}">
</div>