<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Date</th>
            <th>State</th>
            <th>Client Name</th>
            <th>Location</th>
            <th>Service Type</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Payment Mode</th>
            <th>Date of Payment</th>
            <th>Receipt Date</th>
            <th>Transport</th>
            <th>PAN</th>
            <th>Status</th>
            <th>Added Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($expense))
        @foreach($expense as $key => $value)
        <tr>
            <td>{{ $key +1 }}</td>
            <td>{{$value->date}}</td>
            <td>@php if(!empty($value->client->state_id)){
                    $state = App\Models\StateModel::where('id',$value->client->state_id)->first();
                    echo $state->state_name ?? '';
             } @endphp</td>
            <td>{{$value->client->name}}</td>
            <td>{{$value->location}}</td>
            <td>{{$value->service_ty->name}}</td>
            <td>{{$value->description}}</td>
            <td>{{$value->amount}}</td>
            <td>{{$value->category_name->category}}</td>
            <td>{{$value->sub_category->subcategory}}</td>
            <td>{{$value->pay_m->pay_method}}</td>
            <td>{{$value->date_of_payment}}</td>
            <td>{{$value->receipt_date}}</td>
            <td>{{$value->transporte}}</td>
            <td>{{$value->client->pan}}</td>
            @if($value->flag == 0)
            <td><span class="badge bg-success">{{ 'Active'}} </span></td>
            @elseif($value->flag == 1)
            <td><span class="badge bg-danger">{{ 'Inactive'}} </span></td>
            @endif
            <td>{{$value->created_at}}</td>
            <td>
                @if(checkaccess('5', 'write_per','inner'))
                @if($value->flag == 0)
                <a data-bs-toggle="modal" data-bs-target="#edit_expense" onclick="open_expense_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a  onclick="delete_pay('{{$value->id}}','{{$value->name}}','expense_report','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a  onclick="delete_pay('{{$value->id}}','{{$value->name}}','expense_report','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a  onclick="delete_pay('{{$value->id}}','{{$value->name}}','expense_report','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
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