@extends('admin.includes.master')

@section('css')
    <style>
        .circle-progress-value {
            stroke-width: 8px;
            stroke: hsl(280, 90%, 50%);
            stroke-linecap: round;
        }
        .circle-progress-circle {
            stroke-width: 3px;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>

@endsection


@section('content')
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                    <div class="col-sm-6">

                        <div class="row">
                            <h1 class="h2 fw-bold mb-2 col-5">
                                {{$data['details']['name']}}
                            </h1>
                        </div>



                    </div>


                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">

            <div class="row items-push">
                <!-- Customer Information card-->
                <div class="col-lg-8 customer-input">
                    <div class="block block-rounded block-mode-loading-oneui h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Client Information</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="col-lg-12 space-y-3">
                                <!-- Form Horizontal - Default Style -->
                                <form class="space-y-4" action="" method="POST">
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control " id="" name="" value="{{$data['details']['name']}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" name="" value="{{$data['details']['email']}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="">Contact Number</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="" name="" value="{{$data['details']['phone']}}" disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Customer information card-->


                <!-- START show approve work order box or assign technician box-->


                <div class="col-lg-4">




                    <div style='height:100%; background-color:white' class="progress row">
                        <div class="block-header block-header-default" style="height:17.5%">
                            <h3 class="block-title">Hours Spent</h3>
                        </div>
                    </div>

                </div>

                <!-- END special box-->
            </div>


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
                                   onclick="filterbyStatus('User Support')" id="User Support">
                                   User Support
                                    <span class="badge bg-primary rounded-pill"></span>
                                </a>
                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Preventive Maintenance')" id="Preventive Maintenance">
                                    Preventive Maintenance
                                    <span class="badge bg-primary rounded-pill"></span>
                                </a>

                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Network Support')" id="Network Support">
                                    Network Support
                                    <span class="badge bg-primary rounded-pill"></span>
                                </a>

                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('All')" id="All">
                                    All
                                    <span class="badge bg-primary rounded-pill"></span>
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
                        <table class="table table-hover js-table-checkable m-auto" id="slatable" WIDTH="98%">
                            <thead>
                            <tr>

                                <th class=" " >Technician</th>
                                <th class="text-center">Type</th>
                                <th class=" text-center" width="10%">Hours</th>
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


    </main>


@endsection


@section('scripts')
    <script src=" {{asset('assets/js/lib/jquery.min.js')}}"></script>

    <script src=" {{asset('assets/js/custom/jquery.circle-progress.min.js')}}"></script>

    <script>

        $('.progress').circleProgress({
            max: {{$data['details']['quota']}},
            value: {{$data['hours']}},
            constrain: false

        });

    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>



        var dataTable= $('#slatable').DataTable({


            processing: true,
            serverSide: true,
            "aaSorting": [[3, "desc"]],
            ajax: {
                url:'{{route('api_get_client_slas',['id'=>$data['details']['id']])}}',
                method:"GET",
                headers: {
                    Authorization: 'Bearer '+ '{{session('token')}}'
                },
            },
            columns: [

                {
                    data: 'techName',
                    className: 'text-center fw-semibold ',
                    name: 'users.name'
                },

                {
                    data: 'type',
                    className: 'd-sm-table-cell text-center ',
                    name: 'type',



                },
                {
                    data: 'hours',
                    className: ' d-sm-table-cell fw-semibold  text-center',
                    name: 'hours'
                },
               /* {
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
                },*/
                {
                    className:'text-center text-muted',
                    data: {
                        _: 'display',
                        sort: 'updated_at',
                    },
                    name: 'updated_at'
                },
            ],
            dom: 'rt<"my-3"p>',

            createdRow: function( row, data, dataIndex ) {
                // Set the data-status attribute, and add a class
                $( row ).attr('data-href', '/admin/sla/details/'+data['id']);

            }


        });

        $('#searchWork').keyup(function(){
            dataTable.search(this.value).draw();
        });

        $('#slatable').on( 'click', 'tbody tr', function () {
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

            if(status==="All")
            {
                url='{{route('api_get_client_slas',['id'=>$data['details']['id']])}}';
                console.log(url)
            } else {
                url = '{{route('api_get_client_slas',['id'=>$data['details']['id']])}}?type%5Beq%5D='+status;
            }

            $('#'+status).addClass('active');
            $('#'+status).siblings().removeClass('active');



            dataTable.ajax.url(url).load();


        }
    </script>



@endsection
