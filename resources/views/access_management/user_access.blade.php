<style>
    .disablediv {
        pointer-events: none;
        opacity: 0.8;
    }
</style>

<div class="offcanvas-body profile-offcanvas p-0">
    <div class="p-3 text-center">

        @if (!empty($user_data->staff_image))
        <img src="{{asset('uploads/staff/'.$user_data->staff_image)}}" alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto" />
        @else
        <img src="{{ asset('assets/images/user/avatar-2.jpg')}}" alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto" />
        @endif

        @if (!empty($user_data->name))
        <div class="mt-3">
            <h5 class="fs-15"><a href="javascript:void(0);" class="link-primary">{{ $user_data->name }}</a></h5>
            <p class="mb-0"><b>Role : </b><span class="badge bg-warning">{{$user_data->roles->role ?? 'NA'}}</span></p>
        </div>
        @endif
    </div>

    <!--end row-->
    <div class="p-3">
        <h5 class="fs-15 mb-3">Personal Details</h5>
        @if (!empty($user_data->mobile_no))
        <div class="mb-3">
            <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Number</p>
            <h6>{{$user_data->mobile_no}}</h6>
        </div>
        @endif

        @if (!empty($user_data->email))
        <div class="mb-3">
            <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Email</p>
            <h6>{{$user_data->email}}</h6>
        </div>
        @endif

    </div>

    <h5 class="fs-15 mb-3">Role & Permissions</h5>
    @if(!empty($modules && $access))
    <div class="row">
        <div id="permission" class="col-lg-12 disablediv">
            <div class="mb-3">
                <div class="tshadow mb25 bozero">
                    <div class="around10">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-sx-4"><b>Module</b></div>
                            <div class="col-md-3 col-sm-2 col-sx-2 text-center"><b>Read</b></div>
                            <div class="col-md-3 col-sm-2 col-sx-2 text-center"><b>Write</b></div>
                        </div>

                        @if(!empty($modules))
                        @foreach($modules as $value)
                        @php $innermenu = App\Models\SidebarInnerMenu::where('navigation_id',$value->id)->get(); @endphp
                        <div style="border: 1px solid black; margin-top: 20px; padding: 10px">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-sx-6">
                                    <b>{{ $value->menu }}</b> -
                                    <input type="hidden" name="sidebar_name[]" value="{{ $value->id }}">
                                </div>

                                @if(count($innermenu) == 0)
                                @php
                                $exist = App\Models\UserAccessModel::where('user_id',25)->where('nav_id',$value->id)->where('menu','main')->first();
                                @endphp
                                <div class="col-md-3 col-sm-2 col-sx-2 text-center can_add">
                                    <input type="checkbox" name="read[]" id="mainread_{{ $value->id }}" value="{{ $value->id }}">
                                </div>
                                <div class="col-md-3 col-sm-2 col-sx-2 text-center can_view">
                                    <input type="checkbox" name="write[]" id="mainwrite_{{ $value->id }}">
                                </div>
                                @endif
                            </div>

                            @if(count($innermenu) > 0)
                            @foreach ($innermenu as $value_inner)
                            <div class="row">
                                <div class="col-md-6 col-sm-4 col-sx-4">
                                    &nbsp;&#x2022; {{ $value_inner->inner_menu }}
                                    <input type="hidden" name="sidebar_inner_name[]" value="{{ $value_inner->id }}">
                                </div>
                                <div class="col-md-3 col-sm-2 col-sx-2 text-center can_add">
                                    <input type="checkbox" name="sidebar_inner_read_id[]" id="innerread_{{$value_inner->id}}" value="{{ $value_inner->id }}">
                                </div>
                                <div class="col-md-3 col-sm-2 col-sx-2 text-center can_view">
                                    <input type="checkbox" name="s[]" id="innerwrite_{{$value_inner->id}}" onclick="permission('{{$value_inner->id}}','inner')" value="{{ $value_inner->id }}">
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    {{'No Access Found For This User'}}
    @endif


</div>
</div>