<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{$cash_edit_data->date}}">
            <span id="date_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">Cash With</label>
            <input type="text" class="form-control" id="cash_with" name="cash_with" placeholder="Enter Cash With" value="{{$cash_edit_data->cash_with}}">
            <span id="cash_with_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{$cash_edit_data->amount}}">
            <span id="amount_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="Name">Status</label>
            <input type="text" class="form-control" id="data_status" name="data_status" value="{{$cash_edit_data->data_status}}">
            <span id="status_error" class="error"></span>
        </div>
    </div>
</div>
<input type="hidden" class="form-control" id="id" name="id" value="{{$cash_edit_data->id}}">