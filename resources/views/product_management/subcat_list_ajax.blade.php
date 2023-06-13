<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>Image</th>
            <th>Service Type</th>
            <th>Category</th>
            <th>Name</th>
            <th>Status</th>
            <th>Added Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($subcategory))
        @foreach($subcategory as $value)
        <tr>
            <td>
                <img src="{{asset('uploads/subcategory/'.$value->subcat_image)}}" class="img-fluid img-radius wid-40" alt="">
            </td>
            <td>{{$value->service_type_1->name ?? ''}}</td>
            <td>{{$value->category->category}}</td>
            <td>{{$value->subcategory}}</td>
            @if($value->flag == 0)
            <td><span class="badge bg-success">{{ 'Active'}} </span></td>
            @elseif($value->flag == 1)
            <td><span class="badge bg-danger">{{ 'Inactive'}} </span></td>
            @endif
            <td>{{$value->created_at}}</td>
            <td>
                @if(checkaccess('2', 'write_per','inners'))
                @if($value->flag == 0)
                <a data-bs-toggle="modal" data-bs-target="#edit_subcategory" onclick="open_subcat_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a onclick="delete_pay('{{$value->id}}','{{$value->subcategory}}','subcategory','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a onclick="delete_pay('{{$value->id}}','{{$value->subcategory}}','subcategory','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a onclick="delete_pay('{{$value->id}}','{{$value->subcategory}}','subcategory','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
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