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
                        SLA List
                    </h1>

                </div>
                <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary space-x-1"
                                id="dropdown-analytics-overview" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            <i class="fa fa-fw fa-calendar-alt opacity-50"></i>
                            <span>All time</span>
                            <i class="fa fa-fw fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end fs-sm"
                             aria-labelledby="dropdown-analytics-overview">
                            <a class="dropdown-item fw-medium" href="javascript:void(0)">Last 30 days</a>
                            <a class="dropdown-item fw-medium" href="javascript:void(0)">Last month</a>
                            <a class="dropdown-item fw-medium" href="javascript:void(0)">Last 3 months</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fw-medium" href="javascript:void(0)">This year</a>
                            <a class="dropdown-item fw-medium" href="javascript:void(0)">Last Year</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                               href="javascript:void(0)">
                                <span>All time</span>
                                <i class="fa fa-check"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">

            <!-- Recent Orders -->

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title"></h3>
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

                                <th class=" fw-bold" >Client</th>
                                <th class=" fw-bold">Type</th>
                                <th class=" text-center fw-bold text-black" width="10%">Hours</th>
                                <th class="text-center fw-bold ">Created</th>

                            </tr>
                            </thead>


                            <tbody class="fs-sm">




                            </tbody>

                        </table>
                    </div>

                    <!-- END Recent Orders Table -->
                </div>


            </div>
            <!-- END Recent Orders -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

@endsection


@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>



    var dataTable= $('#slatable').DataTable({


        processing: true,
        serverSide: true,
        "aaSorting": [[3, "desc"]],
        ajax: {
            url:'{{route('api_get_client_slas')}}',
            method:"GET",
            headers: {
                Authorization: 'Bearer '+ '{{session('token')}}'
            },
        },
        columns: [

            {
                data: 'clientName',
                className: ' fw-semibold ',
                name: 'users.name'
            },

            {
                data: 'type',
                className: 'd-sm-table-cell ',
                name: 'type',



            },
            {
                data: 'hours',
                className: ' d-sm-table-cell fw-semibold text-primary text-center',
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
                className:'text-center',
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
            $( row ).attr('data-href', '/technician/sla/details/'+data['id']);

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
            url='{{route('api_get_client_slas')}}';
            console.log(url)
        } else {
            url = '{{route('api_get_client_slas')}}?type%5Beq%5D='+status;
        }

        $('#'+status).addClass('active');
        $('#'+status).siblings().removeClass('active');



        dataTable.ajax.url(url).load();


    }
</script>



@endsection
