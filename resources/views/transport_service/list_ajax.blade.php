<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Booking Date</th>
            <th>Start Trip</th>
            <th>Vehicle No.</th>
            <th>Size of Vehicle</th>
            <th>Capacity of Vehicle</th>
            <th>Starting Destination</th>
            <th>Starting Load Destination</th>
            <th>Final Destination </th>
            <th>Distance (KM)</th>
            <th>End Trip</th>
            <th>Duration (Days)</th>
            <th>Driver Name</th>
            <th>Diesel liters/ CNG (KG)</th>
            <th>Diesel/CNG Rupees</th>
            <th>Toll</th>
            <th>Cash Toll</th>
            <th>Driver/ Helper Expense</th>
            <th>Police</th>
            <th>Ad Blue</th>
            <th>Truck repair</th>
            <th>Dala</th>
            <th>Border</th>
            <th>Border Weight</th>
            <th>Bilti</th>
            <th>Union</th>
            <th>RTO</th>
            <th>Misc</th>
            <th>Total expenses (Paid)</th>
            <th>Truck booking amount</th>
            <th>Truck payment received</th>
            <th>Commission</th>
            <th>Munsiyana</th>
            <th>TDS</th>
            <th>HoldingCharges</th>
            <th>Profit/ Loss</th>
            <th>Due on logistics</th>
            <th>PAN</th>
            <th>Status</th>
            <th>Added At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($transport_service))
        @foreach($transport_service as $key => $value)
        <tr>
            <td>{{ $key +1 }}</td>
            <td>{{$value->booking_date}}</td>
            <td>{{$value->start_trip}}</td>
            <td>{{$value->vehicle_data->vehicle_number}}</td>
            <td>{{$value->vehicle_data->size}}</td>
            <td>{{$value->vehicle_data->capacity}}</td>
            <td>{{$value->site_1->name }}</td>
            <td>{{$value->start_load_destination}}</td>
            <td>{{$value->final_destination}}</td>
            <td>{{$value->distance}}</td>
            <td>{{$value->end_trip}}</td>
            <td>{{$value->duration_day}}</td>
            <td>{{$value->admin->name}} ({{$value->admin->mobile_no}})</td>
            <td>{{$value->site_1->name }}</td>
            <td>{{$value->fuel_qty}}</td>
            <td>{{$value->fuel_price}}</td>
            <td>{{$value->toll}}</td>
            <td>{{$value->cash_toll}}</td>
            <td>{{$value->worker_expense}}</td>
            <td>{{$value->police}}</td>
            <td>{{$value->ad_blue}}</td>
            <td>{{$value->vehicle_repair}}</td>
            <td>{{$value->dala}}</td>
            <td>{{$value->border}}</td>
            <td>{{$value->bilti}}</td>
            <td>{{$value->union_youth}}</td>
            <td>{{$value->rto}}</td>
            <td>{{$value->misc}}</td>
            <td>{{$value->total_exp_paid}}</td>
            <td>{{$value->vehicle_booking_amt}}</td>
            <td>{{$value->vehicle_pay_recv}}</td>
            <td>{{$value->commission}}</td>
            <td>{{$value->munsiyana}}</td>
            <td>{{$value->tds}}</td>
            <td>{{$value->holding_charges}}</td>
            <td>{{$value->profit_loss}}</td>
            <td>{{$value->due_on_logistics}}</td>
            <td>{{$value->pan}}</td>
            @if($value->flag == 0)
            <td><span class="badge bg-success">{{ 'Active'}} </span></td>
            @elseif($value->flag == 1)
            <td><span class="badge bg-danger">{{ 'Inactive'}} </span></td>
            @endif
            <td>{{$value->created_at}}</td>
            <td>
                @if(checkaccess('5', 'write_per','inner'))
                @if($value->flag == 0)
                <a data-bs-toggle="modal" data-bs-target="#edit_transport" onclick="open_transport_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a  onclick="delete_pay('{{$value->id}}','{{$value->vehicle_data->vehicle_number}}','transportation_service','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a  onclick="delete_pay('{{$value->id}}','{{$value->vehicle_data->vehicle_number}}','transportation_service','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a  onclick="delete_pay('{{$value->id}}','{{$value->vehicle_data->vehicle_number}}','transportation_service','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
                @endif
                @else
                <a class="badge bg-danger"><i class="feather icon-alert-triangle"></i> Not Allowed </a>
                @endif
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
<script>
    $('#report-table').DataTable();
</script>