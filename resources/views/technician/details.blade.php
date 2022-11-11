@extends('technician.includes.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection




@section('content')

    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                    <div class="flex-grow-1">
                        <h1 class="h3 fw-bold mb-2">
                            Work Order
                        </h1>
                        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                            BI {{ $data['details']['id'] }}
                        </h2>
                    </div>
                    <?php $status = $data['details']['status'] ?>

                    @php
                        if($status=="Assigned")
                            {
                                $tStatus="Diagnostic";
                            } else if($status=="Diagnosed")
                                {
                                    $tStatus="Diagnosed";
                                } else {
                             $tStatus="Intervention";
                                }

                    @endphp


                    <span
                        class="fs-xs fw-semibold d-inline-block py-2 px-4 rounded-pill @include('technician.includes.status')">{{$tStatus}}</span>
                </div>
            </div>
        </div>
        <!-- END Hero -->


        <!-- Page Content -->
        <div class="content">

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

            @elseif($data['status']=="Done")

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                        <i class="fa fa-fw fa-check"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0">
                            You have completed the Intervention
                        </p>
                    </div>
                </div>
            @endif
            <!-- Customers and Latest Orders -->
            <div class="row items-push">
                <!-- Latest Customers -->
                <div class="col-lg-8 customer-input">
                    <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Customer Information</h3>

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
                <!-- END Latest Customers -->

                <!-- Latest Orders -->
                <div class="col-lg-4">
                    <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Diagnostic by</h3>
                        </div>
                        <div class="block block-content-full text-center"></div>
                        <div class="block-content block-content-full text-center">

                            <i class="fa fa-4x fa-user-gear"></i>
                        </div>
                        <div class="block-content text-center">
                            <div class="mb-4">
                                <form action="" method="POST">
                                    @csrf
                                    <div class=".d-flex justify-content-center align-items-center   space-x-2">



                                            <div class="col-lg-12 col-lg-offset-12">
                                                <input type="text" class="form-control " id="" name=""
                                                       value=" {{ $data['details']['assigned_to_name'] }} " disabled>
                                            </div>





                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- END Latest Orders -->
            </div>

            <div class="row items-push">
                <div class="col-lg-6">
                    <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Product information</h3>
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

                <div class="col-lg-6">
                    <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Problem description</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <form class="space-y-4" action="" method="POST">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Ticket Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="" name="ticket_no"
                                               value=" {{ $data['details']['ticket_no'] }} " disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Problem Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="" name="problem" rows="8"
                                                  disabled>{{$data['details']['problem_desc']}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="">Taken By</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="" name="taken_by"
                                               value="{{$data['details']['taken_by_name']}}" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Diagnostic form -->
            @if($data['details']['diagnostic_date']!=null)
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Diagnostic</h3>
                    </div>

                    <div class="block-content block-content-full">
                        <form class="space-y-4">
                            <div class="row">
                                <label class="col-sm-3 col-form-label" for="">Diagnostic Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="" name="ticket_no"
                                           value=" {{ \Carbon\Carbon::parse($data['details']['diagnostic_date'] )->format('d F Y') }} "
                                           disabled>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label" for="">Diagnostic</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="" name="problem" rows="8"
                                              disabled>{{$data['details']['diagnostic']}}</textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            @else
                <div class="block block-rounded">
                    <div class="block-header block-header-default bg-gray-dark text-white">
                        <h3 class="block-title">Diagnostic</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-9 space-y-4">

                                <form action="{{ route('technician.workorders.perform_diagnostic') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label" for="diagnostic_date">Diagnostic Date</label>
                                        <input type="text" class="js-flatpickr form-control" id="diagnostic_date"
                                               name="diagnostic_date" placeholder="Y-m-d">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="diagnostic">Diagnostic Remarks</label>
                                        <textarea class="form-control" id="diagnostic" name="diagnostic" rows="8"
                                                  placeholder=""></textarea>
                                    </div>


                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                    <input type="hidden" id="id" name="id" value="{{ $data['details']['id'] }}">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            @endif


            @if( $data['details']['status']=='WIP' )

                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Technician(s) Assigned</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row justify-content-center">

                            <div class="col-lg-11 space-y-4">

                                <div class="techlist row justify-content-center">
                                    @include('admin.includes.techlist')

                                </div>


                            </div>
                        </div>
                    </div>
                </div>



                <div class="block block-rounded">
                    <div class="block-header block-header-default bg-gray-dark text-white">
                        <h3 class="block-title">Intervention</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row justify-content-center">

                            <div class="col-lg-11 space-y-4">


                                <div class="row pt-3 justify-content-center">

                                    @if(count($data['interventions'])==0)
                                        <div class="col-8 text-center">
                                            <h4>No Interventions</h4>
                                        </div>

                                    @else
                                        <table
                                            class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                                            <thead>
                                            <tr>

                                                <th>Name</th>
                                                <th class="text-center">Time From</th>
                                                <th class="text-center">Time To</th>

                                                <th class="d-none d-sm-table-cell text-center" style="width: 20%;">
                                                    Date
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($data['interventions'] as $inter)
                                                <tr>

                                                    <td class="fs-sm">
                                                        <p class="fw-semibold mb-1">
                                                            <a class="text-default">{{ $inter['name'] }}</a>
                                                        </p>
                                                        <p class="text-muted mb-0">
                                                            {{ $inter['remarks'] }}
                                                        </p>
                                                    </td>

                                                    <td class="text-center">{{ date('H:i', strtotime($inter['time_from'])) }}</td>

                                                    <td class="text-center">{{ date('H:i', strtotime($inter['time_to']))  }}</td>

                                                    <td class="d-none d-sm-table-cell text-center">
                                                        <em class="fs-sm text-muted">{{ date('j F Y', strtotime($inter['date'])) }}</em>


                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>

                                    @endif

                                </div>


                                @if($data['status']!='Done')

                                    <form action="{{ route('technician.workorders.complete_intervention') }}" method="POST">


                                        <button type="button" class="btn btn-alt-primary push mx-2"
                                                data-bs-toggle="modal" data-bs-target="#modal-block-normal">Add
                                            Intervention
                                        </button>


                                        @csrf

                                        <input type="hidden" id="id" name="work_id" value="{{ $data['details']['id'] }}">
                                        <button type="submit" class="btn btn-info push mx-2">Complete</button>


                                    </form>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" id="modal-block-normal" tabindex="-1" aria-labelledby="modal-block-normal"
                     aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">


                            <form action="{{ route('technician.workorders.add_intervention') }}" method="POST">
                                @csrf


                                <div class="block block-rounded block-transparent mb-0">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Add Intervention</h3>
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
                                                <label class="form-label" for="product">Time From</label>

                                                <input type="text"
                                                       class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input time "
                                                       id="" name="time_from">
                                            </div>


                                            <div class="mb-4">
                                                <label class="form-label" for="product">Time To</label>

                                                <input type="text"
                                                       class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input time"
                                                       id="" name="time_to">

                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="remarks">Remarks</label>
                                                <textarea class="form-control" id="diagnostic" name="remarks" rows="5"
                                                          placeholder=""></textarea>
                                            </div>

                                            <input type="hidden" id="id" name="work_id" value="{{ $data['details']['id'] }}">

                                        </div>

                                    </div>
                                    <div class="block-content block-content-full text-end bg-body">
                                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                                data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">
                                            Add
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endif


        </div>


    </main>

@endsection



@section('scripts')
    <!-- Page JS Plugins -->

    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>

    <script>
        $(".time").flatpickr({
            enableTime: true,

            dateFormat: "H:i - d F Y",
            time_24hr: true
        });
    </script>



    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
    <script>One.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-masked-inputs', 'jq-rangeslider']);</script>

@endsection




