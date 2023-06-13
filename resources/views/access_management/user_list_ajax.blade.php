<style>
    .data_hold {
        margin: auto;
    }
</style>
@if(!empty($user_data))
@foreach($user_data as $value)
<div class="col-lg-3 col-md-6">
    <div class="card user-card user-card-1 mt-4">
        <div class="card-body pt-0">
            <div class="user-about-block text-center">
                <div class="row align-items-end">
                    <div class="col text-start pb-3">
                        @if($value->flag == 0)
                        <span class="badge bg-success">{{ 'Active'}} </span>
                        @elseif($value->flag == 1)
                        <span class="badge bg-danger">{{ 'Inactive'}} </span>
                        @endif
                    </div>
                    <div class="col"><img class="img-radius img-fluid wid-80" src="{{asset('uploads/staff/'.$value->staff_image)}}" alt="User image"></div>
                    <div class="col text-end pb-3">
                        <div class="dropdown">
                            <a class="drp-icon dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @if(checkaccess('1', 'write_per','inner'))
                                @if($value->flag == 0)
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_data" onclick="open_edit_model('{{$value->id}}')"><span style="color:blue;">Edit</span></a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change_password" onclick="open_change_password('{{$value->id}}')"><span style="color:blue;">Change Password</span></a>
                                @endif
                                <a class="dropdown-item" onclick="delete_pay('{{$value->id}}','{{$value->name}}','admin','delete')"> <span style="color:red">Delete</span></a>
                                @if($value->flag == 0)
                                <a class="dropdown-item" onclick="delete_pay('{{$value->id}}','{{$value->name}}','admin','Inactive')"> <span style="color:red">Inactive</span></a>
                                @elseif($value->flag == 1)
                                <a class="dropdown-item" onclick="delete_pay('{{$value->id}}','{{$value->name}}','admin','Active')"> <span style="color:green">Active</span></a>
                                @endif
                                @endif
                                <a class="dropdown-item" onclick="show_access('{{$value->id}}')" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"> <span style="color:green;">More Details</span></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">

                <h4 class="mb-1 mt-3">{{$value->name}}</h4>
                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i>{{$value->created_at ?? 'NA'}}</p>
                <p class="mb-1"><b>Email : </b><a href="mailto:{{$value->email}}">{{$value->email ?? 'NA'}}</a></p>
                <p class="mb-0"><b>Role : </b><span class="badge bg-warning">{{$value->roles->role ?? 'NA'}}</span></p>

            </div>
        </div>
    </div>
</div>
@endforeach
@endif

<div class="offcanvas offcanvas-end border-0 sidedetails" tabindex="-1" id="offcanvasScrolling">
    <div class="data_hold">
    </div>
</div>
<!--end offcanvas-body-->
</div>


<script src="{{ asset('assets/js/plugins/sweetalert.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/ac-alert.js')}}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>