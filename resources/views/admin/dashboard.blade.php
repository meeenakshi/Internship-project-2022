@extends('admin.includes.master')


@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="content">
            <div
                    class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
                <div class="flex-grow-1 mb-1 mb-md-0">
                    <h1 class="h3 fw-bold mb-2">
                        Dashboard
                    </h1>
                    <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                        Welcome <a class="fw-semibold" href="be_pages_generic_profile.html">{{auth()->user()->name}}</a>,
                        everything looks
                        great.
                    </h2>
                </div>

            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Overview -->
            <div class="row items-push">

                <!-- Pending Orders -->
                <div class="col-sm-6">
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['pending']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Pending Work Orders</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="far fa-hourglass-half fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               href="{{route("admin.workorders",['filter'=>'Pending'])}}">
                                <span>Assign technician for diagnostic</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Pending Orders -->

                <!-- Diagnostic done -->
                <div class="col-sm-6">
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                            class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['diagnosed']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Diagnostic Completed</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="fa fa-jet-fighter fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               href="{{route("admin.workorders",['filter'=>'Diagnosed'])}}">
                                <span>Determine if chargeable</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Diagnostic done -->

                <!-- With sales-->
                <div class="col-sm-6">
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                            class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['diagnosed']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Awaiting Approval from sales</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="fa fa-hand-holding-dollar fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               href="{{route("admin.workorders",['filter'=>'With Sales'])}}">
                                <span>Determine if approved</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END with sales -->

                <!-- Ready Orders -->
                <div class="col-sm-6">
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['ready']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Ready Work Orders</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="fa fa-dolly fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               href="{{route("admin.workorders",['filter'=>'Ready'])}}">
                                <span>Assign technician for repair</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END New Customers -->

                <div class="col-sm-6">

                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                            class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['wip']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Work In Progress</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="fa fa-wrench fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               href="{{route("admin.workorders",['filter'=>'WIP'])}}">
                                <span>Work order under repair</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Completed orders -->
                <div class="col-sm-6">
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['completed']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Completed Work Orders</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="far fa-paper-plane fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               href="{{route("admin.workorders",['filter'=>'Completed'])}}">
                                <span>Check & close work order</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Completed -->


                <div class="col-sm-6">

                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['closed']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Closed Orders</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="fa fa-chart-bar fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               href="{{route("admin.workorders",['filter'=>'Closed'])}}">
                                <span>View All</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['total']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Work Orders</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="fa fa-chart-bar fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               href="{{route("admin.workorders")}}">
                                <span>View All</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Overview -->


        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
