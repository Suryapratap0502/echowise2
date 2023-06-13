<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Code</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($hsn_code))
        @foreach($hsn_code as $key => $value)
        <tr>
            <td>{{ $key +1 }}</td>
            <td>{{$value->hsn_code}}</td>
            <td>{{$value->description}}</td>
            @if($value->flag == 0)
            <td><span class="badge bg-success">{{ 'Active'}} </span></td>
            @elseif($value->flag == 1)
            <td><span class="badge bg-danger">{{ 'Inactive'}} </span></td>
            @endif
            <td>
                @if(checkaccess('4', 'write_per','main'))
                @if($value->flag == 0)
                <a data-bs-toggle="modal" data-bs-target="#edit_hsn" onclick="open_hsn_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a onclick="delete_pay('{{$value->id}}','{{$value->hsn_code}}','hsn_master','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a onclick="delete_pay('{{$value->id}}','{{$value->hsn_code}}','hsn_master','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a onclick="delete_pay('{{$value->id}}','{{$value->hsn_code}}','hsn_master','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
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
    // DataTable start
    $('#report-table').DataTable();
    // DataTable end
</script>