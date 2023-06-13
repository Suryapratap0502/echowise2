<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Vehicle No.</th>
            <th>Type</th>
            <th>Capacity (In TON)</th>
            <th>Size (In Feet)</th>
            <!-- <th>Allot to driver</th> -->
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($vehicle))
        @foreach($vehicle as $key => $value)
        <tr>
            <td>{{ $key +1 }}</td>
            <td>{{$value->vehicle_number}}</td>
            <td>{{$value->vehicle_type}}</td>
            <td>{{$value->capacity}}</td>
            <td>{{$value->size}}</td>
            <!-- <td><select class="form-select" name="allot_vehicle" onchange="allot_vehicle(this.value,'{{$value->id}}','{{$value->vehicle_number}}');">
                <option value="allotment_remove" style="color:red;">Deallocate Vehical</option>
                @if(!empty($driver))
                @foreach($driver as $value1)
                <option value="{{ $value1->id}}" @if(!empty($value->allot_driver->driver_id)) @if($value->allot_driver->driver_id == $value1->id) {{ 'Selected'; }} @endif @endif>{{ $value1->name }}</option>
                @endforeach
                @endif
                </select> </td> -->
            @if($value->flag == 0)
            <td><span class="badge bg-success">{{ 'Active'}} </span></td>
            @elseif($value->flag == 1)
            <td><span class="badge bg-danger">{{ 'Inactive'}} </span></td>
            @endif
            <td>
                @if($value->flag == 0)
                <a data-bs-toggle="modal" data-bs-target="#edit_vehicle" onclick="open_vehicle_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a onclick="delete_pay('{{$value->id}}','{{$value->vehicle_number}}','vehicle','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a onclick="delete_pay('{{$value->id}}','{{$value->vehicle_number}}','vehicle','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a onclick="delete_pay('{{$value->id}}','{{$value->vehicle_number}}','vehicle','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
                @endif
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
<script>
    // DataTable start
    $('#report-table').DataTable();
    // DataTable end
</script>