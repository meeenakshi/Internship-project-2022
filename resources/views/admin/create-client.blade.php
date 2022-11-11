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
                            Create Client
                        </h1>
                        <h2 class="fs-base lh-base fw-medium text-muted mb-0">


                        </h2>
                    </div>
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="{{route("admin.dashboard")}}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="{{route("admin.clients")}}">Clients</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Create New Client
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

            <form action="{{route('admin.clients.create')}}" method="POST" class="needs-validation" novalidate>
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
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Please enter a proper email address.
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="quota">Quota</label>
                                    <input type="number" class="form-control" id="quota" name="quota" value="" required>
                                    <div class="invalid-feedback">
                                        Field cannot be empty.
                                    </div>
                                </div>


                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
