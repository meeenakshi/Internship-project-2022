
@if($data['details']['status']=="With Sales")


    <div class="col-lg-4">
        <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
            <div class="block-header block-header-default">
                <h3 class="block-title">Approval</h3>
            </div>

            <div class="block-content block-content-full">
                <form action="{{ route('admin.workorders.approval') }}" method="POST">
                    @csrf

                    <div style="padding-bottom: 0.8em">
                        <input type="text" class="form-control" id="quotation_no" name="quotation_no" placeholder="Quotation Number">
                    </div>

                    <div class="form-check">
                        <div style="padding-bottom: 0.5em">
                            <input class="form-check-input" type="radio" id="approved" name="approved" value="1" checked>
                            <label class="form-check-label" for="">Approved</label>
                        </div>

                    </div>

                    <div class="form-check">
                        <div style="padding-bottom: 0.5em">
                            <input class="form-check-input" type="radio" id="approved" name="approved" value="0">
                            <label class="form-check-label" for="">Not approved</label>
                        </div>

                        <input type="hidden"  name="id" id="id" value="{{ $data['details']['id'] }}">

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>

        </div>
    </div>


@endif







@if($data['details']['chargeable']==1 && $data['details']['quotation_approved']==1)

        <div class="col-lg-4">
            <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">

                <div class="block-header block-header-default">
                    <h3 class="block-title">Approval</h3>
                </div>

                <div class="block block-content-full text-center"></div>

                <div class=" block-content-full text-center">
                    <i class="fa fa-3x fa-check text-success"></i>
                </div>

                <div class="block-content text-center">
                    <div class="mb-1">
                        <div class="col-sm-9 d-inline-block">
                            <h5 class="text-success">Approved</h5>
                        </div>
                    </div>

                    <div class="row pb-3">
                        <label class="col-sm-5 col-form-label" for="">Quotation</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="" name="" value="{{$data['details']['quotation_no']}}" disabled="">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @elseif($data['details']['chargeable']==1 && $data['details']['quotation_approved']==0)

        <div class="col-lg-4">
            <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">

                <div class="block-header block-header-default">
                    <h3 class="block-title">Approval</h3>
                </div>

                <div class="block block-content-full text-center"></div>

                <div class=" block-content-full text-center">
                    <i class="fa fa-3x fa-times text-city"></i>
                </div>

                <div class="block-content text-center">
                    <div class="mb-1">
                        <div class="col-sm-9 d-inline-block">
                            <h5 class="text-city">Not Approved</h5>
                        </div>
                    </div>

                    <div class="row pb-3">
                        <label class="col-sm-5 col-form-label" for="">Quotation</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="" name="" value="110" disabled="">
                        </div>
                    </div>
                </div>

            </div>
        </div>




@endif


@if($data['details']['chargeable']!=1 && $data['details']['status']!="Warranty")

    <div class="col-lg-4">
        <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
            <div class="block-header block-header-default">
                <h3 class="block-title">Diagnostic</h3>
                <div class="block-options">

                </div>
            </div>
            <div class="block block-content-full text-center"></div>
            <div class="block-content block-content-full text-center">

                <i class="fa fa-4x fa-user-gear"></i>
            </div>
            <div class="block-content text-center">
                <div class="mb-4">
                    <form action="{{ route('admin.workorders.assign_diagnostic_technician') }}" method="POST">
                        @csrf
                        <div class=".d-flex justify-content-center align-items-center   space-x-2">


                            @if($data['details']['assigned_to']==null)
                                <div class="col-sm-6 d-inline-block pb-3">
                                    <select class="form-select" id="technician" name="technician" >
                                        <option selected>Technician</option>
                                        @foreach($data['technicians'] as $user)
                                            <option value='{{$user['id']}}'>{{$user['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" value="" name="actualTicketNo" id="actualTicketNo">
                            @else

                                <div class="col-lg-12 col-lg-offset-12">
                                    <input type="text" class="form-control " id="" name="" value=" {{ $data['details']['assigned_to_name'] }} " disabled>
                                </div>

                            @endif


                            @if($data['details']['assigned_to']==null)
                                <div class="col d-inline-block">
                                    <button type="submit" class="btn btn-info">Assign</button>
                                </div>
                            @endif

                        </div>

                        <input type="hidden" id="id" name="id" value="{{ $data['details']['id'] }}">

                    </form>

                </div>
            </div>

        </div>
    </div>


@endif
