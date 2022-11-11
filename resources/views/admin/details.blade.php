@extends('admin.includes.master')





@section('css')

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">

@endsection



@section('content')

    <script> var technicianIds = [];

        var technicianIdsCopy = [];

        var techBlockToRemove = 0;

        var techIdToRemove = 0;

    </script>


    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">

            <div class="content content-full">
                <div class="row justify-content-between align-items-center">
                    <div class="col-7 col-sm-6 col-lg-5 col-xl-5">

                        <div class="row">
                            <h1 class="h3 fw-bold mb-2 col-8 col-sm-6 col-lg-7 col-xl-6">
                                Work Order
                            </h1>
                            <a class="btn btn-primary col-3 col-sm-2" target="_blank" href="{{route('admin.workorders.pdf',['id'=>$data['details']['id']])}}">PDF</a>
                        </div>


                        <!-- Work Order ID -->
                        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                            BI {{ $data['details']['id'] }}
                        </h2>
                    </div>

                    <!-- Work Order Status -->
                    <?php $status = $data['details']['status'] ?>
                    <div class="col-4 col-sm-3" align="center">
                        <span class="fs-xs fw-semibold d-inline-block py-2 px-4 rounded-pill @include('admin.includes.status')"> {{ $data['details']['status'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">


            <!-- Show success message upon form submission-->
            @if(session('success'))

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                        <i class="fa fa-fw fa-check"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0">
                            {{session('success')}}
                        </p>
                    </div>
                </div>

            @endif
            <!-- End success message-->


            <!-- Details start-->

            <div class="row items-push">
                <!-- Customer Information card-->
                <div class="col-lg-8 customer-input">
                    <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Customer Information</h3>
                            <div class="block-options space-x-2">



                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="col-lg-12 space-y-3">
                                <!-- Form Horizontal - Default Style -->
                                <form class="space-y-4" action="" method="POST">
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control " id="" name=""
                                                   value=" {{ $data['details']['client'] }} " disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="">Contact</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" name=""
                                                   value=" {{ $data['details']['client_contact_no'] }} " disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="" name=""
                                                   value=" {{ $data['details']['client_email'] }} " disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Customer information card-->


                <!-- START show approve work order box or assign technician box-->


                @include('admin.includes.approved')

                <!-- END special box-->

            </div>


            <div class="row items-push">


                <!-- START Product information card-->
                <div class="col-lg-6">
                    <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Product information</h3>
                            <div class="block-options">



                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <form class="space-y-4" action="" method="POST">
                                <div class="row">
                                    <label class="col-sm-5 col-form-label" for="">Product</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="" name=""
                                               value=" {{ $data['details']['product'] }} " disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label" for="">Model</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="" name=""
                                               value=" {{ $data['details']['model'] }} " disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label" for="">Serial Number</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="" name=""
                                               value=" {{ $data['details']['serial_no'] }} " disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label" for="">Cyber Serial 1</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="" name="cyber_serial_no1"
                                               value="{{$data['details']['cyber_serial_no1']}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label" for="">Cyber Serial 2</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="" name="cyber_serial_no2"
                                               value="{{$data['details']['cyber_serial_no2']}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label" for="">Warranty</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="" name="warranty"
                                               value="{{$data['details']['warranty']==1?"Yes":"No"}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label" for="">Invoice Number</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="" name="invoice_no"
                                               value="{{$data['details']['invoice_no']}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label" for="">Accessories</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="" name="accessories"
                                                  disabled>{{$data['details']['accessories']}}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END Product information card-->


                <!-- START Problem description card-->
                <div class="col-lg-6">
                    <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Problem description</h3>
                            <div class="block-options">
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <form class="space-y-4" action="" method="POST">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Ticket Number</label>
                                    <div class="col-sm-9">

                                        <input type="text" class="form-control" id="ticket_no_field" name="ticket_no"
                                               value=" {{ $data['details']['ticket_no'] }} " {{ $data['details']['status']=="Pending"? '' : 'disabled' }}>

                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Problem Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="" name="problem" rows="8"
                                                  disabled>{{ $data['details']['problem_desc']}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Taken By</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="" name="taken_by"
                                               value="{{ $data['details']['taken_by_name']}}" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Image</label>
                                    <div class="col-sm-9">
                                            <button type="button" class="btn btn-alt-primary push" data-bs-toggle="modal" data-bs-target="#modal-block-popin">View</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Signature</label>
                                    <div class="col-sm-9">
                                        <button type="button" class="btn btn-alt-primary push" data-bs-toggle="modal" data-bs-target="#modal-block-popout">View</button>
                                    </div>
                                </div>

                                <!-- START Image Modal-->
                                <div class="modal fade" id="modal-block-popin" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-popin" role="document">
                                        <div class="modal-content">
                                            <div class="block block-rounded block-transparent mb-0">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title">Product Image</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="block-content fs-sm">
                                                    <img alt=" &nbsp No image available" width="100%" height="100%" src="{{$data['details']['picture']}}">
                                                    <br><br>
                                                </div>
                                                <div class="block-content block-content-full text-end bg-body">

                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Image Modal-->

                                <!-- START Signature Modal-->
                                <div class="modal fade" id="modal-block-popout" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-popout" role="document">
                                        <div class="modal-content">
                                            <div class="block block-rounded block-transparent mb-0">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title">Client Signature</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="block-content fs-sm">
                                                    <img alt=" &nbsp No signature available" width="50%" height="50%" src="{{$data['details']['client_signature_request']}}">
                                                    <br><br>
                                                </div>
                                                <div class="block-content block-content-full text-end bg-body">

                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Signature Modal-->

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END Problem description card-->


            <!-- If Diagnostic Present-->

            @if($data['details']['diagnostic_date']!=null)

                <!-- START Diagnostic card-->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Diagnostic</h3>
                    </div>

                    <div class="block-content block-content-full">
                        <form class="space-y-4" action="{{ route('admin.workorders.set_chargeable') }}" method="POST">
                            @csrf
                            <div class="row">
                                <label class="col-sm-3 col-form-label" for="">Diagnostic Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="" name="ticket_no"
                                           value=" {{ \Carbon\Carbon::parse( $data['details']['diagnostic_date'] )->format('d F Y') }} "
                                           disabled>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label" for="">Diagnostic</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="" name="problem" rows="8"
                                              disabled>{{ $data['details']['diagnostic']}}</textarea>
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-3 col-form-label" for="">Diagnostic By</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="" name="taken_by"
                                           value=" {{ $data['details']['assigned_to_name'] }} " disabled>
                                </div>
                            </div>


                            @if($data['details']['chargeable']!=-1)

                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Chargeable</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="" name="taken_by"
                                               value="{{$data['details']['chargeable']==1?"Yes":"No"}}" disabled>
                                    </div>
                                </div>

                            @else
                                <div class="row align-items-center">


                                    <label class="col-sm-3 col-form-label" for="">Chargeable</label>
                                    <div class="col-sm-3 space-x-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input fs-5" type="radio" id="chargeable_yes"
                                                   name="chargeable" value="1" checked="">
                                            <label class="form-check-label fs-5" for="chargeable_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input fs-5" type="radio" id="chargeable_no"
                                                   name="chargeable" value="0">
                                            <label class="form-check-label fs-5" for="chargeable_no">No</label>
                                        </div>

                                    </div>


                                    <input type="hidden" name="id" id="id" value="{{ $data['details']['id'] }}">
                                    <div class="col-sm-3 ">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </div>

                            @endif

                        </form>

                    </div>
                </div>

                <!-- END Diagnostic card-->

            @endif


            <!-- IF Work order is ready to be assigned technicians-->
            @if( $data['details']['status']=='Ready' )

                <!-- START Assign Technician for Intervention card-->
                <div class="block block-rounded">
                    <div class="block-header block-header-default bg-gray-dark text-white">
                        <h3 class="block-title">Assign Technician for Intervention</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row justify-content-center">

                            <div class="col-lg-11 space-y-4">

                                <form action="{{ route('admin.workorders.assign_work_order_technician') }}" method="POST"
                                      onsubmit="return sendJson()">
                                    @csrf
                                    <div class="row pt-3 justify-content-center">
                                        <div class="mb-4 col-8">
                                            <select class="js-select2 form-select" id="example-select2"
                                                    name="example-select2" style="width: 100%;"
                                                    data-placeholder="Choose one..">
                                                @foreach($data['technicians'] as $user)
                                                    <option value='{{$user['id']}}'>{{$user['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-4 col-3">
                                            <button type="button" class="btn btn-alt-primary push add"
                                                    onclick="addTechnician()">Add Technician
                                            </button>
                                        </div>

                                    </div>

                                    <div class="techlist row justify-content-center">

                                    </div>



                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                    <input type="hidden" id="id" name="work_id" value="{{ $data['details']['id'] }}">
                                    <input type="hidden" name="json" value="" id="json-hidden">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Assign Technician for Intervention card-->
            @endif


            <!-- IF Work order has been assigned technicians-->
            @if( $data['details']['status']=='WIP'  ||  $data['details']['status']=='Complete' ||  $data['details']['status']=='Closed' )

                <!-- START Technician List Card-->
                <div class="block block-rounded" id="techListBlock">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Technician(s) Assigned</h3>

                        <div class="block-options">

                            @if($data['details']['status']=='WIP')
                            <a data-bs-toggle="tooltip" data-bs-placement="left" class="js-bs-tooltip-enabled"
                               aria-label="Edit" onclick="editTechnicians(this)" id="edit">
                                <i class="fa fa-fw fa-pencil-alt edit"></i>
                            </a>
                            @endif
                            <a data-bs-toggle="tooltip" data-bs-placement="left" class="js-bs-tooltip-enabled cancel"
                               aria-label="Cancel" hidden="" onclick="resetEdit(this)">
                                <i class="fa fa-fw fa-xmark-circle "></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content block-content-full" id="techList">
                        <div class="row justify-content-center">

                            <div class="col-lg-11 space-y-4">
                                <form action="{{ route('admin.workorders.assign_work_order_technician') }}" method="POST" onsubmit="return sendJson()" id="techForm">
                                    @csrf

                                    <div class="techlist row justify-content-center">
                                        @include('admin.includes.techlist')
                                    </div>

                                    <div id="changesList" class="m-4" role="tablist" aria-multiselectable="true">
                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                            <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                                <a class="text-muted collapsed" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="false" aria-controls="faq1_q1">Changes</a>
                                            </div>
                                            <div id="faq1_q1" class="collapse" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1" style="">
                                                <div class="block-content">




                                                      <table class="table table-vcenter">

                                                          <tbody>
                                                          @foreach($data['assigned'] as $tech)
                                                          <tr>

                                                              <td class="d-none d-sm-table-cell">
                                                                  @if($tech['status']=='Removed')
                                                                  <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Removed</span>
                                                                  @else
                                                                      <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">Added</span>
                                                                  @endif
                                                              </td>

                                                              <td class=" fs-sm">
                                                                  {{$tech['name']}}
                                                              </td>

                                                              <td class=" fs-sm text-warning">
                                                                  {{$tech['reason']}}
                                                              </td>

                                                              <td class="fs-sm text-muted text-center">
                                                                  <em>{{date('d F Y - H:i', strtotime($tech['updated_at']))}}</em>
                                                              </td>

                                                          </tr>
                                                          @endforeach
                                                          </tbody>
                                                      </table>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <input type="hidden" id="id" name="work_id" value="{{ $data['details']['id'] }}">
                                    <input type="hidden" name="json" value="" id="json-hidden">


                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- END Technician List Card-->
            @endif


            <!-- IF Technicians have performed interventions-->
            @if(  $data['details']['status']=='WIP' ||   $data['details']['status']=='Complete' ||   $data['details']['status']=='Closed')

                <!-- Show interventions card-->
                @include('admin.includes.interventions')

            @endif
        </div>

        <!-- Modal for confirm removal-->
        <div class="modal" id="modal-block-normal" tabindex="-1" aria-labelledby="modal-block-normal"
             aria-hidden="true" style="display: none;" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                        <div class="block block-rounded block-transparent mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Confirm Removal?</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content fs-sm">


                                <div class="col-lg-11 space-y-4">


                                    <div class="mb-4">
                                        <label class="form-label" for="remarks">Reason</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="5"
                                                  placeholder=""></textarea>
                                    </div>

                                    <input type="hidden" id="id" name="work_id" value="{{ $data['details']['id'] }}">

                                </div>

                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                        data-bs-dismiss="modal">Close
                                </button>
                                <button type=button" class="btn btn-sm btn-primary" data-bs-dismiss="modal" onclick="removeEditTechnician()">
                                    Confirm
                                </button>
                            </div>


                            <input type="hidden" id="techIdRemove" value="">

                        </div>
                </div>
            </div>
        </div>

    </main>

@endsection


@section('scripts')
    <script>
        var imgUrl = '{{ asset('assets/media/avatars/avatar1.jpg') }}';
    </script>



    <script src=" {{asset('assets/js/lib/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $('#ticket_no_field').blur(function(){
            $('#actualTicketNo').val($(this).val());
            console.log($('#actualTicketNo').val());
        });

    </script>

    <!-- Script for adding/removing/edit technicians for interventions-->


    @include('admin.includes.edit-technicians-script');


    <script>One.helpersOnLoad(['jq-select2']);</script>

@endsection


