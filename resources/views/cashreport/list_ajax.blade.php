<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Cash With</th>
            <th>Added Date</th>
            <th>Amount</th>
            <th>Data Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($cash_report))
        @foreach($cash_report as $key => $value)
        <tr>
            <td>{{ $key +1 }}</td>
            <td>{{$value->cash_with}}</td>
            <td>{{$value->date}}</td>
            <td>{{$value->amount}}</td>
            <td>{{$value->data_status}}</td>
            {{-- @if($value->flag == 0)
            <td><span class="badge bg-success">{{ 'Active'}} </span></td>
            @elseif($value->flag == 1)
            <td><span class="badge bg-danger">{{ 'Inactive'}} </span></td>
            @endif --}}
            <td>
                @if(checkaccess('5', 'write_per','inner'))
                @if($value->flag == 0)
                <a data-bs-toggle="modal" data-bs-target="#edit_cash_report" onclick="open_cashreport_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a onclick="delete_pay('{{$value->id}}','{{$value->item_name}}','cash_report','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a onclick="delete_pay('{{$value->id}}','{{$value->item_name}}','cash_report','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a onclick="delete_pay('{{$value->id}}','{{$value->item_name}}','cash_report','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
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