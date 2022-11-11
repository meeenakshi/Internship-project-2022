@extends('technician.includes.master')

@section('content')

    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                    <div class="flex-grow-1">

                        <div class="row">
                            <h1 class="h3 fw-bold mb-2 col-lg-3">
                                {{$data['details']['client_name']}}
                            </h1>
                            <a class="btn btn-primary mx-2 col-sm-1" target="_blank"
                               href="">PDF</a>
                        </div>


                        <!-- Work Order ID -->
                        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                            SLA {{$data['details']['id']}}
                        </h2>
                    </div>

                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">


            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">SLA Information</h3>
                </div>

                <div class="block-content block-content-full">
                    <form class="space-y-4" >

                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="">Technician</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="ticket_no" value="{{$data['details']['tech_name']}}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="">Location</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="taken_by" value="{{$data['details']['location']}}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="">Type of Work</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="taken_by"
                                       value="{{$data['details']['type']}} " disabled>
                            </div>
                        </div>


                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="">Time From</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="ticket_no" value="{{\Carbon\Carbon::parse( $data['details']['time_from'] )->format('H:i - d F Y') }} " disabled>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="">Time To</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="taken_by"
                                       value="{{\Carbon\Carbon::parse( $data['details']['time_to'] )->format('H:i - d F Y') }}" disabled>
                            </div>
                        </div>


                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="">Tasks</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="" name="problem" rows="8" value="" disabled>{{$data['details']['tasks']}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="">Signature</label>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-alt-primary push" data-bs-toggle="modal" data-bs-target="#modal-block-popout">View</button>
                            </div>
                        </div>

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
                                            <img alt=" &nbsp No signature available" width="50%" height="50%" src="{{$data['details']['client_signature']}}">
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
    </main>
@endsection


