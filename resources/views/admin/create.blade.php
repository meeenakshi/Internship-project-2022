@extends('admin.includes.master')



@section('content')
    <!-- Main Container -->
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
                            BI 1405
                        </h2>
                    </div>
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="{{route("admin.dashboard")}}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Work Order
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

            <form action="{{route('admin.workorders.create')}}" method="POST" onsubmit="convertSig()" class="needs-validation" novalidate>
                @csrf
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Client Information</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-9 space-y-4">

                                <div class="mb-4">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="" required>
                                    <div class="invalid-feedback">
                                        Field cannot be empty.
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="" pattern="^[0-9\-]+$">

                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="" value="">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Product Information</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-9 space-y-4">

                                <div class="mb-4">
                                    <label class="form-label" for="product">Product</label>
                                    <input type="text" class="form-control" id="product" name="product" required>
                                    <div class="invalid-feedback">
                                        Field cannot be empty.
                                    </div>
                                </div>


                                <div class="mb-4">
                                    <label class="form-label" for="model">Model</label>
                                    <input type="text" class="form-control" id="model" name="model" required>
                                    <div class="invalid-feedback">
                                        Field cannot be empty.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="serial_no">Serial Number</label>
                                    <input type="text" class="form-control" id="serial_no" name="serial_no"
                                           placeholder="Product serial number" required>
                                    <div class="invalid-feedback">
                                        Field cannot be empty.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="visually-hidden" for="cyber_serial_no_1">Cyber Serial Number 1</label>
                                    <input type="text" class="form-control" id="cyber_serial_no_1"
                                           name="cyber_serial_no_1" placeholder="Cybernaptics serial number 1">
                                </div>

                                <div class="mb-4">
                                    <label class="visually-hidden" for="cyber_serial_no_2">Cyber Serial Number 2</label>
                                    <input type="text" class="form-control" id="cyber_serial_no_2"
                                           name="cyber_serial_no_2" placeholder="Cybernaptics serial number 2">
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="warranty"
                                           name="warranty" unchecked>
                                    <label class="form-check-label" for="warranty">Warranty</label>
                                    <br><br>
                                    <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                                           placeholder="Invoice Number">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="accessories">Accessories</label>
                                    <textarea class="form-control" id="accessories" name="accessories" rows="4"
                                              placeholder=""></textarea>
                                </div>

                                <div class="mb-4">
                                    <input type="file" class="form-control" id="pic">

                                    <input type="hidden" id="picUrl" name="picUrl" value="">
                                </div>




                            </div>
                        </div>
                    </div>
                </div>

                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Problem Description</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-9 space-y-4">

                                <div class="mb-4">
                                    <label class="form-label" for="ticket_no">Ticket Number</label>
                                    <input type="text" class="form-control" id="ticket_no" name="ticket_no" rows="4"
                                           placeholder=""></input>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="problem">Problem</label>
                                    <textarea class="form-control" id="problem" name="problem" rows="4" required></textarea>
                                    <div class="invalid-feedback">
                                        Field cannot be empty.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="taken_by">Taken By</label>
                                    <select class="form-select" id="taken_by" name="taken_by" required>
                                        <option selected disabled value="">Users</option>

                                        @foreach($data as $user)

                                            <option value='{{$user['id']}}'>{{$user['name']}}</option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a person.
                                    </div>
                                </div>

                                <div class="mb-4">

                                    <div class="row align-items-center mb-2 ">

                                    <label class="form-label col-3" for="client_sig_req">Client Signature</label>
                                        <a class="btn btn-alt-secondary col-1 " onclick="clearSig()"> <i class="fa fa-fw fa-eraser"></i></a>

                                    </div>


                                        <div class="col">
                                            <canvas id="sig" class="border border-light"></canvas>

                                            <input type="hidden" name="client_sig_req" value="" id="hiddenSig">
                                        </div>



                                </div>

                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary" onsubmit="hideButton(this)">Submit</button>
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

    <script>
        function hideButton(button)
        {
            $(button).hide();
        }
    </script>

    <script>
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach( function(form) {

            form.addEventListener('submit', function(event){

                if(!form.checkValidity()){
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');

            },false);

        });
    </script>



    <script>
        const fileInput = document.getElementById('pic');
        const hiddenField = document.getElementById('picUrl');

        fileInput.addEventListener("change", e =>{
           const file = fileInput.files[0];
           const reader = new FileReader();

           reader.addEventListener("load",()=>{
               hiddenField.value = reader.result;
               console.log(hiddenField.value);
           });

           reader.readAsDataURL(file);

        });

    </script>

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
@endsection



