@extends('admin.includes.master')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.css"/>



@endsection


@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="content">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
                <div class="flex-grow-1 mb-1 mb-md-0">
                    <h1 class="h3 fw-bold mb-2">
                        Work Orders List
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
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" onclick="filterbyTime('month')"><span>This month</span>
                                <i class="time-active month-f "></i></a>

                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" onclick="filterbyTime('3month')"><span>Last 3 months</span>
                                <i class="time-active 3month-f"></i></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" onclick="filterbyTime('year')"><span>This year</span>
                                <i class="time-active year-f"></i>
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                               onclick="filterbyTime('all')">
                                <span>All time</span>
                                <i class="time-active all-f fa fa-check"></i>
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
                                <a id="Pending"
                                   class="dropdown-item s_filter fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Pending')">
                                    Pending
                                    <span class="badge bg-primary rounded-pill">{{ $data[1]['pending'] }}</span>
                                </a>
                                <a id="Assigned"
                                   class="dropdown-item s_filter fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Assigned')">
                                    Assigned
                                    <span class="badge bg-primary rounded-pill">{{ $data[1]['assigned'] }}</span>
                                </a>
                                <a id="Ready"
                                   class="dropdown-item s_filter fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Ready')">
                                    Ready
                                    <span class="badge bg-primary rounded-pill">{{ $data[1]['ready'] }}</span>
                                </a>
                                <a id="WIP"
                                   class="dropdown-item s_filter fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('WIP')">
                                    Work In Progress
                                    <span class="badge bg-primary rounded-pill">{{ $data[1]['wip'] }}</span>
                                </a>
                                <a id="Completed"
                                   class="dropdown-item s_filter fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Completed')">
                                    Complete
                                    <span class="badge bg-primary rounded-pill">{{ $data[1]['completed'] }}</span>
                                </a>
                                <a id="Closed"
                                   class="dropdown-item s_filter fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Closed')">
                                    Closed
                                    <span class="badge bg-primary rounded-pill ">{{ $data[1]['closed'] }}</span>
                                </a>
                                <a id="Warranty"
                                   class="dropdown-item s_filter fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('Warranty')">
                                    Warranty
                                    <span class="badge bg-primary rounded-pill ">{{ $data[1]['warranty'] }}</span>
                                </a>
                                <a id="all"
                                   class="dropdown-item s_filter fw-medium d-flex align-items-center justify-content-between active"
                                   onclick="filterbyStatus('all')">
                                    All
                                    <span class="badge bg-primary rounded-pill">{{ $data[1]['total'] }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                    <!-- Search Form -->
                    <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
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


                <div class="block-content block-content-full fs-sm">

                    <!-- Recent Orders Table -->

                    <div class="table-responsive  ">

                        <table class="table table-hover js-table-checkable m-auto"  id="try" width="98%">
                            <thead>

                            <tr>

                                <th class=" d-xl-table-cell text-center">ID</th>
                                <th class="">Client</th>
                                <th class=" d-sm-table-cell text-center">Contact</th>
                                <th class=" d-sm-table-cell text-center">Product</th>
                                <th class="text-center">Status</th>
                                <th class=" d-sm-table-cell  text-center">Updated At</th>
                                <th width="5%"></th>

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
    <script src=" {{asset('assets/js/lib/jquery.min.js')}}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.js"></script>

    <script>

            var dataTable= $('#try').DataTable({
                processing: true,
                serverSide: true,
                "aaSorting": [[5, "desc"]],
                ajax: {
                    url:'{{route('api_get_datatable')}}',
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
                        searchable: true,
                        render: function(data,type,row)
                        {
                            return '<strong>'+data+'</strong>'
                        }
                    },
                    {
                        data: 'client_contact_no',
                        className: 'd-sm-table-cell text-center',
                        name: 'client_contact_no',
                        searchable: false,


                    },
                    {
                        data: 'product',
                        className: ' d-sm-table-cell text-center',
                        name: 'product'
                    },
                    {
                        data: 'status',
                        className:'text-center',
                        name: 'status',
                        render:

                            function(data,type,row)
                        {

                            let status = data;
                             let style="";

                            switch (status)
                            {
                                case 'Pending':
                                    style="bg-warning-light text-warning";
                                    break;
                                case 'Assigned':
                                    style="bg-info-light text-info";
                                    break;
                                case 'Diagnosed':
                                    style="bg-amethyst-lighter text-amethyst";
                                    break;
                                case 'Complete' :
                                case 'Closed':
                                    style="bg-success-light text-success";
                                    break;
                                case 'Warranty':
                                    style="bg-city-lighter text-city";
                                    break;
                                case 'WIP' :
                                    style="bg-amethyst-lighter text-primary";
                                    break;
                                default:
                                    style="bg-smooth-lighter text-smooth"

                            }



                            return ' <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill '+style+'">'+data+'</span>';
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
                    {
                        data: 'bell',
                        className:  'text-center',
                        sortable:false,
                        searchable: false,

                    },
                ],

                createdRow: function( row, data, dataIndex ) {
                    // Set the data-status attribute, and add a class
                    $( row ).attr('data-href', '/admin/workorders/details/'+data['id']);

                },

                dom: 'rt<"mt-4"p>',


            });

            $('#searchWork').keyup(function(){
                dataTable.search(this.value).draw();
            });


            $('#try').on( 'click', 'tbody tr', function () {
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

            if(status==="all")
            {
                url='{{route('api_get_datatable')}}';
                console.log(url)
            } else {
                url = '{{route('api_get_datatable')}}?status%5Beq%5D='+status;
            }

            $('#'+status).addClass('active');
            $('#'+status).siblings().removeClass('active');

            dataTable.ajax.url(url).load();


        }
    </script>

    @if(isset($_GET['filter']))
    <script>

        $( document ).ready(function() {

            let sts= '{{ $_GET['filter']}}';

            filterbyStatus(sts);

            const nextURL = '{{route('admin.workorders')}}';
            const nextTitle = 'Cybernaptics';
            const nextState = { additionalInformation: 'Updated the URL with JS' };

            // This will create a new entry in the browser's history, without reloading
            window.history.pushState(nextState, nextTitle, nextURL);

        });

    </script>

    @endif

    <script>


        function toggleNotify(button)
        {


            let bi= $(button).attr('bi');
            $.ajax({
                url: "{{route('api_toggle_notification')}}",
                method:"PATCH",
                headers: {
                    Authorization: 'Bearer '+ '{{session('token')}}'
                },
                data:{notifiable: $(button).attr('notifiable'), id: bi, _token : '{{csrf_token()}}'},

                success: function(data){

                    if(data['state']==0)
                    {
                        $(button).removeClass('fa-solid');
                        $(button).addClass('fa-regular');
                    } else {
                        $(button).removeClass('fa-regular');
                        $(button).addClass('fa-solid');
                    }
                    $(button).attr('notifiable',data['state']);

                }
            });



        }

    </script>

    <script>


        function filterbyTime(time)
        {

            var today = new Date();
            let priorDate="";
            if(time==='month')
            {

                priorDate = new Date(new Date().setDate(today.getDate() - 30)).toISOString().slice(0, 9);



            } else if(time==='3month')
            {
                 priorDate = new Date(new Date().setDate(today.getDate() - 90)).toISOString().slice(0, 9);
            } else if(time==='year')
            {
                 priorDate = new Date(new Date().setDate(today.getDate() - 365)).toISOString().slice(0, 9);
            }

            if(time==="all")
            {
                url = '{{route('api_get_datatable')}}';
            } else {
                url = '{{route('api_get_datatable')}}?createdAt%5Bgte%5D='+priorDate;
            }

            dataTable.ajax.url(url).load();

            $(".time-active").removeClass('fa fa-check');
            $("."+time+"-f").addClass('fa fa-check');
        }
    </script>

@endsection
