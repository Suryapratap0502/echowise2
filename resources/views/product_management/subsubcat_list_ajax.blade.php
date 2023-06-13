<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Image</th>
            <th>Service Type</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Name</th>
            <th>Status</th>
            <th>Added Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($subsubcat))
        @foreach($subsubcat as $key => $value)
        <tr>
            <td>{{ $key +1 }}</td>
            <td>
                <img src="{{asset('uploads/subsubcategory/'.$value->subsubcat_image)}}" class="img-fluid img-radius wid-40" alt="">
            </td>
            <td>{{$value->service_type_1->name ?? ''}}</td>
            <td>{{$value->subcategory->subcategory}}</td>
            <td>{{$value->subsubcategory}}</td>
            <td>{{$value->subsubcategory}}</td>
            @if($value->flag == 0)
            <td><span class="badge bg-success">{{ 'Active'}} </span></td>
            @elseif($value->flag == 1)
            <td><span class="badge bg-danger">{{ 'Inactive'}} </span></td>
            @endif
            <td>{{$value->created_at}}</td>
            <td>
                @if(checkaccess('2', 'write_per','inner'))
                @if($value->flag == 0)
                <a data-bs-toggle="modal" data-bs-target="#edit_subsubcategory" onclick="open_sub_sub_cat_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a onclick="delete_pay('{{$value->id}}','{{$value->subsubcategory}}','subsubcategory','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a onclick="delete_pay('{{$value->id}}','{{$value->subsubcategory}}','subsubcategory','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a onclick="delete_pay('{{$value->id}}','{{$value->subsubcategory}}','subsubcategory','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
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