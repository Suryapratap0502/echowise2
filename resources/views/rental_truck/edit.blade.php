<script>
    change_lable('{{$rental->site}}','0');
</script>
<div id="addnew">
    @csrf()
    <h6 class="mb-3" style="color:#54be73"><b>BASIC DETAILS</b></h6>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="loading_date">Loading Date</label>
                <input type="date" class="form-control" name="loading_date" id="loading_date" value="{{$rental->loading_date}}">
                <span id="loading_date_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Location</label>
                <input type="text" class="form-control location" name="location" id="location" placeholder="Enter Location" value="{{$rental->location}}">
                <span id="location_error" class="error"></span>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="client_id">Client</label>
                <select class="form-select" name="client_id" id="client_id">
                    <option value="" selected>Select</option>
                    @if(!empty($client))
                    @foreach($client as $value)
                    <option value="{{ $value->id}}" @if($value->id == $rental->client){{'Selected'}} @endif>{{ $value->name }}</option>
                    @endforeach
                    @endif
                </select>
                <span id="client_id_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="vehicle_no">Vehicle</label>
                <select class="form-select" name="vehicle_no" id="vehicle_no">
                    <option value="" selected>Select</option>
                    @if(!empty($vehicle))
                    @foreach($vehicle as $value)
                    <option value="{{ $value->id}}" @if($value->id == $rental->vehicle_no){{'Selected'}} @endif>{{ $value->vehicle_type }} ({{ $value->vehicle_number }})</option>
                    @endforeach
                    @endif
                </select>
                <span id="vehicle_no_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group input-group-sm">
                <label class="form-label" for="lab_loading_overloading">Labour Loading Exp / Overloading</label>
                <input type="text" class="form-control" name="lab_loading_overloading" id="lab_loading_overloading" placeholder="Enter Labour Loading Exp / Overloading" value="{{$rental->loading_exp_over_loading}}">
                <span id="lab_loading_overloading_error" class="error"></span>
            </div>
        </div>
    </div>
    <div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div>
    <h6 class="mb-3" style="color:#54be73"><b>PAYMENT DETAILS</b></h6>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="booking_amt">Booking Amount</label>
                <input type="number" class="form-control" id="booking_amt0" name="booking_amt" placeholder="Booking Amount" value="{{$rental->booking_amt}}">
                <span id="booking_amt_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="adv_pay">Advance Payment</label>
                <input type="number" class="form-control" id="adv_pay0" name="adv_pay" placeholder="Advance Payment" onkeydown="cal_final_amt(0)" onkeyup="cal_final_amt(0)" value="{{$rental->adv_pay}}">
                <span id="adv_pay_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="adv_pay_date">Advance Payment Date</label>
                <input type="date" class="form-control" id="adv_pay_date" name="adv_pay_date"  value="{{$rental->adv_pay_date}}">
                <span id="adv_pay_date_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="final_pay">Final Payment</label>
                <input type="number" class="form-control final_pay0" id="final_pay" name="final_pay" placeholder="Final Payment" value="{{$rental->final_pay_truck}}">
                <span id="final_pay_error0" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="final_pay_date">Final Payment Date</label>
                <input type="date" class="form-control" id="final_pay_date" name="final_pay_date" value="{{$rental->final_pay_date}}">
                <span id="final_pay_date_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="unloading_date">Unloading Date</label>
                <input type="date" class="form-control" id="unloading_date" name="unloading_date" value="{{$rental->unloading_date}}">
                <span id="unloading_date_error" class="error"></span>
            </div>
        </div>
    </div>
    <div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div>
    <h6 class="mb-3" style="color:#54be73"><b>SITE DETAILS</b></h6>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="weight_cl_site">Weight at Client Site</label>
                <input type="text" class="form-control" id="weight_cl_site" name="weight_cl_site" placeholder="In (KG)" value="{{$rental->client_site_weight}}">
                <span id="weight_cl_site_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="site">Site Name</label>
                <select class="form-select" name="site" id="site" onchange="change_lable(this.value,'0');" >
                    <option value="" selected>Select</option>
                    @if(!empty($site))
                    @foreach($site as $value)
                    <option value="{{ $value->id}}" @if($value->id == $rental->site){{'Selected'}} @endif>{{ $value->name }} ({{ $value->location }})</option>
                    @endforeach
                    @endif
                </select>
                <span id="site_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="weight_sel_site">Weight at <span class="sel_site0" style="color:#54be73"></span></label>
                <input type="text" class="form-control" id="weight_sel_site" name="weight_sel_site" placeholder="In (KG)" value="{{$rental->site_weight}}">
                <span id="weight_sel_site_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="weight_differ">Weight Differnce</label>
                <input type="text" class="form-control" id="weight_differ" name="weight_differ" placeholder="In (KG)" value="{{$rental->weight_differ}}">
                <span id="weight_differ_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="transporter">Transport</label>
                <input type="text" class="form-control search_transporter_name" id="transporter" name="transporter" placeholder="Enter Transporter Name" value="{{$rental->transporter_name}}">
                <span id="transporter_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="pan">PAN</label>
                <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter PAN" value="{{$rental->pan}}">
                <span id="pan_error" class="error"></span>
            </div>
        </div>
        <input type="hidden" name="id" id="id" value="{{$rental->id}}">
    </div>
</div>