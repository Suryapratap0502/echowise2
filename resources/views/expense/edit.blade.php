<script>
    get_client_data('0', '{{ $expense_data->client_id }}');
    getsubcat2('{{ $expense_data->category }}', '{{ $expense_data->subcategory }}')
</script>
<div id="addnew">
    @csrf()
    <h6 class="mb-3" style="color:#00acc1"><b>CLIENTS DETAILS</b></h6>
    <div class="row">

        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Client</label>
                <select class="form-select" name="client_id" id="client_id" onchange="get_client_data(0,this.value)">
                    <option value="" selected>Select</option>
                    @if(!empty($client))
                    @foreach($client as $value)
                    <option value="{{ $value->id}}" @if($value->id == $expense_data->client_id){{'Selected'}} @endif>{{ $value->name}}</option>
                    @endforeach
                    @endif
                </select>
                <span id="client_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2 ">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">State</label>
                <select class="form-select" name="state" id="state" require>
                    <option>Select</option>
                    @if(!empty($state))
                    @foreach($state as $value)

                    <option value="{{ $value->id}}" @if($value->id == $expense_data->state){{'Selected'}} @endif>{{ $value->state_name}}</option>
                    @endforeach
                    @endif
                </select>

            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Location</label>
                <input type="text" class="form-control location" name="location" id="location" placeholder="Enter Client Location" value="{{$expense_data->location}}">

            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">PAN</label>
                <input type="text" class="form-control pan_0" name="pan" id="pan_0" readonly>
            </div>
        </div>
    </div>
    <div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div>
    <h6 class="mb-3" style="color:#00acc1"><b>ONOTHER DETAILS</b></h6>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{$expense_data->date}}">
                <span id="date_error" class="error"></span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Service Type </label>
                <div class="col-sm-6 text-end mb-2" style="float: right;">
                </div>
                <select class="form-select" name="service_type" id="service_type">
                    <option value="" selected>Select</option>
                    @if(!empty($service_type))
                    @foreach($service_type as $value)

                    <option value="{{ $value->id}}" @if($value->id == $expense_data->service_type){{'Selected'}} @endif>{{ $value->name}}</option>

                    @endforeach
                    @endif
                </select>
                <span id="client_error" class="error"></span>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="{{$expense_data->description}}">

            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{$expense_data->amount}}">

            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Category</label>
                <select class="form-select" name="category" id="category" onchange="getsubcat2(this.value,'{{$expense_data->subcategory}}')">
                    <option value="" selected>Select</option>
                    @if(!empty($category))
                    @foreach($category as $value)

                    <option value="{{ $value->id}}" @if($value->id == $expense_data->category){{'Selected'}} @endif>{{ $value->category}}</option>
                    @endforeach
                    @endif
                </select>
                <span id="cat_error" class="error"></span>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Sub Category</label>
                <select class="form-select subcategory" name="sub_cat" id="sub_cat2" value="{{$expense_data->subcategory}}">
                </select>

            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Payment Mode</label>
                <select class="form-select" name="pay_mode" id="pay_mode">
                    <option value="" selected>Select</option>
                    @if(!empty($pay_mode))
                    @foreach($pay_mode as $value)

                    <option value="{{ $value->id}}" @if($value->id == $expense_data->pay_mode){{'Selected'}} @endif>{{ $value->pay_method}}</option>
                    @endforeach
                    @endif
                </select>
                <span id="pay_mode_error" class="error"></span>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Date Of Payment</label>
                <input type="date" class="form-control" id="date_pay" name="date_pay" value="{{$expense_data->date_of_payment}}">

            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Date Of Receipt</label>
                <input type="date" class="form-control" id="date_receipt" name="date_receipt" value="{{$expense_data->receipt_date}}">

            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-group-sm">
                <label class="form-label" for="Name">Transport</label>
                <input type="text" class="form-control" id="transport" name="transport" value="{{$expense_data->transporte}}">
            </div>
        </div>
        <input type="hidden" name="id" id="id" value="{{$expense_data->id}}">
    </div>
</div>