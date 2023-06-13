<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Loading Date</th>
            <th>Location</th>
            <th>Client Name</th>
            <th>Vehicle No.</th>
            <th>Labour Loading Exp/Overloading</th>
            <th>Booking Amt</th>
            <th>Advance Pay</th>
            <th>Adv Pay Date</th>
            <th>Final Payment</th>
            <th>Final Payment Date</th>
            <th>Unloading Date</th>
            <th>Weight at Client Site (In KG)</th>
            <th>Site Name </th>
            <th>Weight at Site (In KG)</th>
            <th>Weight Differ (In KG)</th>
            <th>Transport Name</th>
            <th>PAN</th>
            <th>Status</th>
            <th>Added At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($rental))
        @foreach($rental as $key => $value)
        <tr>
            <td>{{ $key +1 }}</td>
            <td>{{$value->loading_date}}</td>
            <td>{{$value->location}}</td>
            <td>{{$value->clients->name}}</td>
            <td>{{$value->vehicle->vehicle_number}}</td>
            <td>{{$value->loading_exp_over_loading}}</td>
            <td>{{$value->booking_amt}}</td>
            <td>{{$value->adv_pay}}</td>
            <td>{{$value->adv_pay_date}}</td>
            <td>{{$value->final_pay_truck}}</td>
            <td>{{$value->final_pay_date}}</td>
            <td>{{$value->unloading_date}}</td>
            <td>{{$value->client_site_weight}}</td>
            <td>{{$value->site_1->name }} ({{$value->site_1->location}})</td>
            <td>{{$value->site_weight}}</td>
            <td>{{$value->weight_differ}}</td>
            <td>{{$value->transporter_name}}</td>
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
                <a data-bs-toggle="modal" data-bs-target="#edit_rental_truck" onclick="open_rental_truck_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a  onclick="delete_pay('{{$value->id}}','{{$value->vehicle->vehicle_number}}','rental_truck','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a  onclick="delete_pay('{{$value->id}}','{{$value->vehicle->vehicle_number}}','rental_truck','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a  onclick="delete_pay('{{$value->id}}','{{$value->vehicle->vehicle_number}}','rental_truck','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
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