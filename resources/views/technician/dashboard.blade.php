@extends('technician.includes.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>


@endsection


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
                        Welcome <a class="fw-semibold" href="be_pages_generic_profile.html">{{session('name')}}</a>,
                        everything looks
                        great.
                    </h2>
                </div>

            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">

            <div class="row items-push">
                <div class="col-sm-4 col-xxl-4">

                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['diagnostic']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Diagnostic</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="far fa-gem fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               onclick="filterbyStatus('Diagnostic')"  role="button">
                                <span>View All</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4 col-xxl-4">

                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{$data['interventions']}}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Intervention</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="far fa-user-circle fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                               onclick="filterbyStatus('Intervention')"  role="button">
                                <span>View All</span>
                                <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-sm-4 col-xxl-4">


                    <div class="block block-rounded d-flex flex-column h-100 mb-0">

                        <div
                            class="block-content  block-content-full flex-grow-1 d-flex justify-content-center align-items-center" >
                            <div class="fs-2 fw-semibold text-primary">
                               <a href="{{route("technician.sla.create")}}"> <i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="bg-body-light rounded-bottom">
                            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center text-primary justify-content-center"
                               href="{{route("technician.sla.create")}}">
                                <span>Create SLA</span>

                            </a>
                        </div>

                    </div>


                </div>


            </div>
            <!-- END Overview -->



            <!-- Recent Orders -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Tasks</h3>
                    <div class="block-options space-x-1">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                                data-target="#one-dashboard-search-orders" data-class="d-none">
                            <i class="fa fa-search"></i>
                        </button>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                    id="dropdown-recent-orders-filters" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <i class="fa fa-fw fa-flask"></i>
                                Filters
                                <i class="fa fa-angle-down ms-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm"
                                 aria-labelledby="dropdown-recent-orders-filters">
                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Intervention')" id="Intervention">
                                    Intervention
                                    <span class="badge bg-primary rounded-pill">{{$data['interventions']}}</span>
                                </a>
                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Diagnostic')" id="Diagnostic">
                                    Diagnostic
                                    <span class="badge bg-primary rounded-pill">{{$data['diagnostic']}}</span>
                                </a>

                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('All')" id="All">
                                    All
                                    <span class="badge bg-primary rounded-pill">{{$data['diagnostic']+$data['interventions']}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                    <!-- Search Form -->
                    <form >
                        <div class="push">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-alt" id="searchWork"
                                       name="one-ecom-orders-search" placeholder="Search all orders..">
                                <span class="input-group-text bg-body border-0">
                      <i class="fa fa-search"></i>
                    </span>
                            </div>
                        </div>
                    </form>
                    <!-- END Search Form -->
                </div>


                    <!-- Recent Orders Table -->

                <div class="block-content block-content-full">

                    <div class="table-responsive">
                            <table class="table table-hover js-table-checkable m-auto" id="techtable" width="98%">
                                <thead>
                                <tr>
                                    <th class=" text-center">ID</th>
                                    <th class=" ">Client</th>
                                    <th class=" text-center">Contact</th>
                                    <th class=" text-center">Product</th>
                                    <th class="text-center">Type</th>
                                    <th class=" text-center">Created</th>

                                </tr>
                                </thead>


                                <tbody class="fs-sm">




                                </tbody>

                            </table>
                    </div>

                    <!-- END Recent Orders Table -->
                </div>


            </div>



        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection

@section('scripts')

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>



        var dataTable= $('#techtable').DataTable({


            processing: true,
            serverSide: true,
            "aaSorting": [[5, "desc"]],
            ajax: {
                url:'{{route('api_get_technician_datatable')}}',
                method:"GET",
                headers: {
                    Authorization: 'Bearer '+ '{{session('token')}}'
                },
            },
            columns: [

                {
                    data: 'id',
                    className: 'text-center',
                    name: 'id',
                    searchable: true,
                    render: function(data,type,row)
                    {
                        return '<span class="text-primary fw-bold">BI '+data+'</span>'
                    }
                },
                {
                    data: 'client',
                    className: '',
                    name: 'client',

                    render: function(data,type,row)
                    {
                        return '<strong>'+data+'</strong>'
                    }
                },
                {
                    data: 'client_contact_no',
                    className: 'd-sm-table-cell fw-semibold text-muted text-center',
                    name: 'client_contact_no',



                },
                {
                    data: 'product',
                    className: ' d-sm-table-cell fw-semibold text-muted text-center',
                    name: 'product'
                },
                {
                    data: 'status',
                    className:'text-center',
                    name: 'status',
                    searchable: true,
                    render:

                        function(data,type,row)
                        {

                            let status = data;
                            let style="";

                            let actual="";

                            switch (status)
                            {

                                case 'Assigned':
                                    style="bg-info-light text-info";
                                    actual="Diagnostic";
                                    break;
                                case 'Complete' :
                                case 'WIP' :
                                    style="bg-success-light text-success";
                                    actual="Intervention";
                                    break;

                                default:
                                    style="bg-smooth-lighter text-smooth"

                            }




                            return ' <span class="fs-xs  fw-semibold d-inline-block py-1 px-3 rounded-pill '+style+'">'+actual+'</span>';
                        }
                },
                {
                    className:'text-center',
                    data: {
                        _: 'display',
                        sort: 'updated_at',
                    },
                    name: 'updated_at'
                },
            ],

            createdRow: function( row, data, dataIndex ) {
                // Set the data-status attribute, and add a class
                $( row ).attr('data-href', '/technician/workorders/details/'+data['id']);

            },
            dom: 'rt<"my-3"p>',


        });

        $('#searchWork').keyup(function(){
            dataTable.search(this.value).draw();
        });

        $('#techtable').on( 'click', 'tbody tr', function () {
            if($(this).data('href')!=null)
            {
                window.location.href = $(this).data('href');
            }

        });



    </script>

    <script>
        function filterbyStatus(status)
        {
            let url="";

            if(status==="Intervention")
            {
                url='{{route('api_get_technician_datatable',['filter'=>'Interventions'])}}';

            } else if(status==="Diagnostic") {


                url='{{route('api_get_technician_datatable',['filter'=>'Diagnostic'])}}';
            } else {
                url='{{route('api_get_technician_datatable')}}';
            }


            $('#'+status).addClass('active');
            $('#'+status).siblings().removeClass('active');



            dataTable.ajax.url(url).load();


        }
    </script>



@endsection
