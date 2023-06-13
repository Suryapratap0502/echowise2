<div id="addnew">
    @csrf()
    <h6 class="mb-3" style="color:#54be73"><b>TRANSPORTATION DETAILS</b></h6>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="booking_date">Booking Date</label>
                <input type="date" class="form-control" name="booking_date" id="booking_date" value="{{$transport->booking_date}}">
                <span id="booking_date_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="start_trip">Start Trip</label>
                <input type="date" class="form-control location" name="start_trip" id="start_trip" value="{{$transport->start_trip}}">
                <span id="start_trip_error" class="error"></span>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="vehicle_no">Vehicle</label>
                <select class="form-select" name="vehicle_no" id="vehicle_no">
                    <option value="" selected>Select</option>
                    @if(!empty($vehicle))
                    @foreach($vehicle as $value)
                    <option value="{{ $value->id}}" @if($value->id == $transport->vehicle_no){{'Selected'}} @endif>{{ $value->vehicle_type }} ({{ $value->vehicle_number }} - {{ $value->capacity }} KG)</option>
                    @endforeach
                    @endif
                </select>
                <span id="vehicle_no_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="vehicle_size">Vehicle Size</label>
                <input type="text" class="form-control" name="vehicle_size" id="vehicle_size" placeholder="Enter Vehicle Size" value="{{$transport->vehicle_size}}">
                <span id="vehicle_size_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="vehicle_capacity">Vehicle Capacity</label>
                <input type="text" class="form-control" name="vehicle_capacity" id="vehicle_capacity" placeholder="Enter Vehicle Capacity" value="{{$transport->vehicle_capacity}}">
                <span id="vehicle_capacity_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="start_destination">Starting Destination</label>
                <select class="form-select" name="start_destination" id="start_destination">
                    <option value="" selected>Select</option>
                    @if(!empty($site))
                    @foreach($site as $value)
                    <option value="{{ $value->id}}" @if($value->id == $transport->start_destination){{'Selected'}} @endif>{{ $value->name }} ({{ $value->location }})</option>
                    @endforeach
                    @endif
                </select>
                <span id="start_destination_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="start_load_destination">Starting Load Destination</label>
                <input type="text" class="form-control" name="start_load_destination" id="start_load_destination" placeholder="Enter Starting Load Destination" value="{{$transport->start_load_destination}}">
                <span id="start_load_destination_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="final_destination">Final Destination</label>
                <input type="text" class="form-control" name="final_destination" id="final_destination" placeholder="Enter Final Destination" value="{{$transport->final_destination}}">
                <span id="final_destination_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="distance">Distance (In KM.)</label>
                <input type="text" class="form-control" name="distance" id="distance" placeholder="Enter Distance" value="{{$transport->distance}}">
                <span id="distance_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="end_trip">End Trip</label>
                <input type="date" class="form-control" name="end_trip" id="end_trip" value="{{$transport->end_trip}}">
                <span id="end_trip_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="duration_day">Duration (In Days)</label>
                <input type="number" class="form-control" name="duration_day" id="duration_day" placeholder="Enter Duration (In Days)" value="{{$transport->duration_day}}">
                <span id="duration_day_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="driver_name">Driver</label>
                <select class="form-select" name="driver_name" id="driver_name">
                    <option value="" selected>Select</option>
                    @if(!empty($driver))
                    @foreach($driver as $value)
                    <option value="{{ $value->id}}" @if($value->id == $transport->driver_name){{'Selected'}} @endif>{{ $value->name }} ({{ $value->mobile_no }})</option>
                    @endforeach
                    @endif
                </select>
                <span id="driver_name_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="fuel_qty">Diesel liters/ CNG (KG)</label>
                <input type="number" class="form-control" name="fuel_qty" id="fuel_qty" placeholder="Enter Diesel liters/ CNG (KG)" value="{{$transport->fuel_qty}}">
                <span id="fuel_qty_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="fuel_price">Diesel/CNG Rupees</label>
                <input type="number" class="form-control" name="fuel_price" id="fuel_price" placeholder="Enter Diesel/CNG Rupees" value="{{$transport->fuel_price}}">
                <span id="fuel_price_error" class="error"></span>
            </div>
        </div>
    </div>
    <div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div>
    <h6 class="mb-3" style="color:#54be73"><b>PAYMENT DETAILS</b></h6>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="toll">Toll</label>
                <input type="number" class="form-control" name="toll" id="toll" placeholder="Enter Toll" value="{{$transport->toll}}">
                <span id="toll_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="cash_toll">Cash Toll</label>
                <input type="number" class="form-control" name="cash_toll" id="cash_toll" placeholder="Enter Cash Toll" value="{{$transport->cash_toll}}">
                <span id="cash_toll_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="worker_expense">Driver/ Helper Expense </label>
                <input type="text" class="form-control" id="worker_expense" name="worker_expense" placeholder="Enter Driver/ Helper Expense" value="{{$transport->worker_expense}}">
                <span id="worker_expense_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="police">Police</label>
                <input type="number" class="form-control police" id="police" name="police" placeholder="Police" value="{{$transport->police}}">
                <span id="police_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="ad_blue">Ad Blue</label>
                <input type="text" class="form-control" id="ad_blue" name="ad_blue" placeholder="Ad Blue" value="{{$transport->ad_blue}}">
                <span id="ad_blue_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="vehicle_repair">Vehicle repair</label>
                <input type="text" class="form-control" id="vehicle_repair" name="vehicle_repair" placeholder="Enter Vehicle repair" value="{{$transport->vehicle_repair}}">
                <span id="vehicle_repair_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="dala">Dala</label>
                <input type="text" class="form-control" id="dala" name="dala" placeholder="Enter Dala" value="{{$transport->dala}}">
                <span id="dala_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="border">Border</label>
                <input type="text" class="form-control" id="border" name="border" placeholder="Enter Border" value="{{$transport->border}}">
                <span id="border_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="border_weight">Border Weight</label>
                <input type="text" class="form-control" id="border_weight" name="border_weight" placeholder="Enter Border Weight" value="{{$transport->border_weight}}">
                <span id="border_weight_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="bilti">Bilti</label>
                <input type="text" class="form-control" id="bilti" name="bilti" placeholder="Enter Bilti" value="{{$transport->bilti}}">
                <span id="bilti_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="union_youth">Union</label>
                <input type="text" class="form-control" id="union_youth" name="union_youth" placeholder="Enter Union Youth" value="{{$transport->union_youth}}">
                <span id="union_youth_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="rto">RTO</label>
                <input type="text" class="form-control" id="rto" name="rto" placeholder="Enter RTO" value="{{$transport->rto}}">
                <span id="rto_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="misc">Misc</label>
                <input type="text" class="form-control" id="misc" name="misc" placeholder="Enter Misc" value="{{$transport->misc}}">
                <span id="misc_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="total_exp_paid">Total expenses (Paid)</label>
                <input type="text" class="form-control" id="total_exp_paid" name="total_exp_paid" placeholder="Enter Total expenses (Paid)" value="{{$transport->total_exp_paid}}">
                <span id="total_exp_paid_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="vehicle_booking_amt">Vehicle booking amount</label>
                <input type="text" class="form-control" id="vehicle_booking_amt" name="vehicle_booking_amt" placeholder="Enter Vehicle booking amount" value="{{$transport->vehicle_booking_amt}}">
                <span id="vehicle_booking_amt_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="vehicle_pay_recv">Vehicle payment received</label>
                <input type="text" class="form-control" id="vehicle_pay_recv" name="vehicle_pay_recv" placeholder="Enter Vehicle booking amount" value="{{$transport->vehicle_pay_recv}}">
                <span id="vehicle_pay_recv_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="commission">Commission</label>
                <input type="text" class="form-control" id="commission" name="commission" placeholder="Enter Commission" value="{{$transport->commission}}">
                <span id="commission_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="munsiyana">Munsiyana</label>
                <input type="text" class="form-control" id="munsiyana" name="munsiyana" placeholder="Enter Munsiyana" value="{{$transport->munsiyana}}">
                <span id="munsiyana_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="tds">TDS</label>
                <input type="text" class="form-control" id="tds" name="tds" placeholder="Enter TDS" value="{{$transport->tds}}">
                <span id="tds_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="holding_charges">Holding Charges</label>
                <input type="text" class="form-control" id="holding_charges" name="holding_charges" placeholder="Enter Holding Charges" value="{{$transport->holding_charges}}">
                <span id="holding_charges_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="profit_loss">Profit/ Loss</label>
                <input type="text" class="form-control" id="profit_loss" name="profit_loss" placeholder="Enter Profit/ Loss" value="{{$transport->profit_loss}}">
                <span id="profit_loss_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="due_on_logistics">Due on logistics</label>
                <input type="text" class="form-control" id="due_on_logistics" name="due_on_logistics" placeholder="Enter Due on logistics" value="{{$transport->due_on_logistics}}">
                <span id="due_on_logistics_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="pan">PAN</label>
                <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter PAN" value="{{$transport->pan}}">
                <span id="pan_error" class="error"></span>
            </div>
        </div>
        <input type="hidden" name="id" id="id" value="{{$transport->id}}">
    </div>
</div>