<table id="report-table" class="table table-bordered table-striped mb-0">
    <thead>
        <tr>
            <th>Product</th>
            <th>Product Code</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Sub Sub Category</th>
            <th>Unit</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($product))
        @foreach($product as $value)
        <tr>
            <td class="align-middle">
                <img src="{{asset('uploads/product/'.$value->image)}}" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
                <p class="m-0 d-inline-block align-middle font-16">
                    <a href="#!" class="text-body">{{$value->name}}</a>
                </p>

            </td>
            <td>{{$value->code}}</td>
            <td>{{$value->category->category}}</td>
            <td>{{$value->subcategory->subcategory}}</td>
            <td>{{$value->subsubcategory->subsubcategory}}</td>
            <td>{{$value->unit}}</td>
            <td>{{$value->size}}</td>
            <td>{{$value->quantity}}</td>
            @if($value->flag == 0)
            <td><span class="badge bg-success">{{ 'Active'}} </span></td>
            @elseif($value->flag == 1)
            <td><span class="badge bg-danger">{{ 'Inactive'}} </span></td>
            @endif
            <td>
                @if(checkaccess('2', 'write_per','inner'))
                @if($value->flag == 0)
                <a data-bs-toggle="modal" data-bs-target="#edit_product" onclick="open_pro_edit('{{$value->id}}');" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                @endif
                <a onclick="delete_pay('{{$value->id}}','{{$value->name}}','product','delete');" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                @if($value->flag == 0)
                <a onclick="delete_pay('{{$value->id}}','{{$value->name}}','product','Inactive');" class="btn btn-danger btn-sm"></i><i class="feather icon-power"></i> </a>
                @elseif($value->flag == 1)
                <a onclick="delete_pay('{{$value->id}}','{{$value->name}}','product','Active');" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> </a>
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