<div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{$sale_edit_data->date}}">
                                <span id="date_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Item Name</label>
                                <select class="form-select" name="item_name" id="item_name">
                                    <option>Select</option>
                                    @if(!empty($product))
                                    @foreach($product as $value)
                                    <option value="{{ $value->id}}" @if($value->id == $sale_edit_data->item_name){{'Selected'}} @endif>{{ $value->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span id="item_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter Quantity" value="{{$sale_edit_data->qty}}">
                                <span id="qty_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Rate</label>
                                <input type="number" class="form-control" id="rate" name="rate" placeholder="Enter Rate" value="{{$sale_edit_data->rate}}">
                                <span id="rate_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{$sale_edit_data->amount}}">
                                <span id="amount_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Payment</label>
                                <input type="number" class="form-control" id="payment" name="payment" placeholder="Enter Payment" value="{{$sale_edit_data->payment}}">
                                <span id="payment_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Payment Date</label>
                                <input type="date" class="form-control" id="pay_date" name="pay_date" value="{{$sale_edit_data->payment_date}}">
                                <span id="pay_date_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Status</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{$sale_edit_data->status}}">
                                <span id="status_error" class="error"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="id" name="id" value="{{$sale_edit_data->id}}">