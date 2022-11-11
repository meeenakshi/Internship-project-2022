
@extends('technician.includes.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection


    @section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                    <div class="flex-grow-1">
                        <h1 class="h3 fw-bold mb-2">
                            SLA
                        </h1>
                        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                            BI 1405
                        </h2>
                    </div>
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="javascript:void(0)">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                SLA
                            </li>
                        </ol>
                    </nav>
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

            @endif


            @if(count($errors) > 0)

                @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <p class="mb-0">
                                {{$error}}
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                @endforeach


            @endif

            <form action="" method="POST" onsubmit="convertSig()">
                @csrf
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Basic Information</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-9 space-y-4">

                                <div class="mb-4">
                                    <label class="form-label" for="name">Select Client</label>
                                    <input type="text" class="form-control" id="searchClient" name="name" value="">
                                    <input type="hidden" id="clientId" name="client_id" value="0">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="example-select">Type of work</label>
                                    <select class="form-select" id="example-select" name="type">
                                        <option selected>Options</option>
                                        <option value="User Support">User Support</option>
                                        <option value="Network Support">Network Support</option>
                                        <option value="Preventive Maintenance">Preventive Maintenance</option>
                                    </select>

                            </div>

                                <div class="row align-items-center my-5">


                                    <label class="col-sm-3 col-form-label" for="">Location</label>
                                    <div class="col-sm-5 space-x-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="onsite"
                                                   name="location" value="On-site" checked="">
                                            <label class="form-check-label" for="onsite">On-site</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="remote"
                                                   name="location" value="Remote">
                                            <label class="form-check-label" for="remote">Remote</label>
                                        </div>

                                    </div>


                                    <input type="hidden" name="id" id="id" value="">

                                </div>
                        </div>
                    </div>
                </div>
                </div>


                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tasks</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-9 space-y-4">



                                <div class="mb-4">
                                    <label class="form-label" for="product">Time From</label>

                                    <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input time" id="" name="time_from">
                                </div>


                                <div class="mb-4">
                                    <label class="form-label" for="product">Time To</label>

                                    <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input time" id="" name="time_to">

                                </div>



                                <div class="mb-4">
                                    <label class="form-label" for="problem">Tasks Performed</label>
                                    <textarea class="form-control" id="problem" name="tasks" rows="4" placeholder=""></textarea>
                                </div>


                                <div class="mb-4">

                                    <div class="row align-items-center mb-2 ">

                                        <label class="form-label col-3" for="client_sig_req">Client Signature</label>
                                        <a class="btn btn-alt-secondary col-1 " onclick="clearSig()"> <i class="fa fa-fw fa-eraser"></i></a>

                                    </div>


                                    <div class="col">
                                        <canvas id="sig" class="border border-grey"></canvas>

                                        <input type="hidden" name="client_sig" value="" id="hiddenSig">
                                    </div>



                                </div>


                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary" id="submitSla">Submit</button>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </form>
        </div>

    </main>
    <!-- END Main Container -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
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


    <script src="{{asset('assets/js/signature_pad.umd.js')}}"></script>

    <script>
        canvas = document.getElementById('sig');
        signaturePad = new SignaturePad(canvas);


        function clearSig()
        {
            signaturePad.clear();
            $('#sigData').text("");
        }

        function convertSig()
        {
            $('#hiddenSig').val(signaturePad.toDataURL('image/png',100))
        }


    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script>


        $('#searchClient').typeahead({


            source: function(query,process)
            {
                return  $.ajax({
                    url: "{{route('api_search_client')}}",
                    method:"GET",
                    data:{query: query},
                    headers: {
                        Authorization: 'Bearer '+ '{{session('token')}}'
                    },

                    success: function(data){

                        return process(data);
                    }
                });
            }

        });



        $('#searchClient').blur(function() {
            var current = $('#searchClient').typeahead("getActive");
            if (current) {
                // Some item from your model is active!
                if (current.name.toLowerCase() === $('#searchClient').val().toLowerCase()) {
                   $('#clientId').val(current['id']);
                } else {
                    // This means it is only a partial match, you can either add a new item
                    // or take the active if you don't want new items
                    $('#clientId').val(0);
                }
            } else {
                // Nothing is active so it is a new value (or maybe empty value)

                $('#clientId').val(0);
            }
        });


    </script>

    <script>
        function convertSig()
        {
            $('#hiddenSig').val(signaturePad.toDataURL('image/png',100))
            $('#createSla').hide();
        }
    </script>




@endsection

