<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="code">Product Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{$fetch_product_data->code}}" readonly>
            <span id="code_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="Name">Select Category</label>
            <select class="form-select subcategory" name="cat_id" id="cat_id" onchange="getsubcat(this.value);">
                @if(!empty($category))
                @foreach($category as $value)
                <option value="{{ $value->id}}" @if($value->id == $fetch_product_data->cat_id){{'Selected'}} @endif>{{ $value->category }}</option>
                @endforeach
                @endif
            </select>
            <span id="cat_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="Name">Select Sub Category</label>
            <select class="form-select subcategory" name="sub_cat_id" id="sub_cat_id" onchange="getsubsubcat(this.value);">
                @if(!empty($subcategory))
                @foreach($subcategory as $value)
                <option value="{{ $value->id}}" @if($value->id == $fetch_product_data->sub_cat_id){{'Selected'}} @endif>{{ $value->subcategory }}</option>
                @endforeach
                @endif
            </select>
            <span id="cat_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="sub_sub_cat_id">Sub Sub Category</label>
            <select class="form-select subsubcat" name="sub_sub_cat_id" id="sub_sub_cat_id">
                @if(!empty($subsubcategory))
                @foreach($subsubcategory as $value)
                <option value="{{ $value->id}}" @if($value->id == $fetch_product_data->sub_sub_cat_id){{'Selected'}} @endif>{{ $value->subsubcategory }}</option>
                @endforeach
                @endif
            </select>
            <span id="sub_sub_cat_id_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="Code">Product Name</label>
            <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Product Name" value="{{$fetch_product_data->name}}">
            <span id="p_name_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="hsn">HSN Code</label>
            <select class="form-select" name="hsn" id="hsn">
                <option value="{{$fetch_product_data->hsn}}" selected>{{$fetch_product_data->hsn}}</option>
                <option value="hsn1">HSN1</option>
            </select>
            <span id="hsn_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="p_unit">Product Unit</label>
            <select class="form-select" name="p_unit" id="p_unit">
                <option value="{{$fetch_product_data->hsn}}" selected>{{$fetch_product_data->unit}}</option>
                <option value="kg">kg</option>
            </select>
            <span id="p_unit_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="p_size">Product Size</label>
            <input type="text" class="form-control" id="p_size" name="p_size" placeholder="Product Size" value="{{$fetch_product_data->size}}">
            <span id="p_size_error" class="error"></span>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="p_quanity">Product Quantity</label>
            <input type="number" class="form-control" id="p_quanity" name="p_quanity" placeholder="Product Quantity" value="{{$fetch_product_data->quantity}}">
            <span id="p_quantity_error" class="error"></span>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label class="form-label" for="Name">Select Image</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="" value="{{$fetch_product_data->image}}">
            <span id="upload_error" class="error"></span>
        </div>
        <img src="{{asset('uploads/product/'.$fetch_product_data->image)}}" style="width:100px;">
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="{{$fetch_product_data->id}}">

    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label " for="p_desc">Product Discription</label>
            <textarea type="text" class="form-control" id="p_desc" name="p_desc" placeholder="Product Description">{{$fetch_product_data->description}}</textarea>
            <span id="p_desc_error" class="error"></span>
        </div>
    </div>

</div>
