<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Vehicle No.</th>
            <th>Vehicle Type</th>
            <th>Vehicle Capacity</th>
            <th>Allot to driver</th>
            <th>Allotted Status</th>
            <th>Allotted Date</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($vehicle))
        @foreach($vehicle as $key => $value)
        <tr>
            <td>{{ $key +1 }}</td>
            <td>{{$value->vehicle_number}}</td>
            <td>{{$value->vehicle->vehicle_type}}</td>
            <td>{{$value->vehicle->capacity}}</td>
            <td>{{$value->admin->name}}</td>
            @if($value->flag == 1)
            <td><span class="badge bg-success">{{ 'Allotted'}} </span></td>
            @elseif($value->flag == 2)
            <td><span class="badge bg-danger">{{ 'Allotment Exp.'}} </span></td>
            @endif
            <td>{{$value->created_at}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
<script>
    $('#report-table').DataTable();
    
</script>