@extends('admin.includes.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
@endsection

@section('content')
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Quick Overview -->
            <div class="row">
                <div class="col-6 col-lg-3">
                    <a class="block block-rounded block-link-shadow text-center" href="{{route('admin.users.create')}}">
                        <div class="block-content block-content-full">
                            <div class="fs-2 fw-semibold text-default">
                                <i class="fa fa-plus"></i>
                            </div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="fw-medium fs-sm text-default mb-0">
                                Add New
                            </p>
                        </div>
                    </a>
                </div>

            </div>
            <!-- END Quick Overview -->

            <!-- All Users-->
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
                                   onclick="filterbyStatus('technician')" id="technician">
                                   Technician
                                    <span class="badge bg-primary rounded-pill"></span>
                                </a>
                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('admin')" id="admin">
                                    Admin
                                    <span class="badge bg-primary rounded-pill"></span>
                                </a>

                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   onclick="filterbyStatus('helpdesk')" id="helpdesk">
                                    Help Desk
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

                                <th class=" " >Name</th>
                                <th class="">Email</th>
                                <th class=" text-center" >Designation</th>
                                <th class=" text-center">Last Changed</th>

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

        </div>
        <!-- END All Products -->

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
                url:'{{route('api_get_users_datatable')}}',
                method:"GET",
                headers: {
                    Authorization: 'Bearer '+ '{{session('token')}}'
                },
            },
            columns: [

                {
                    data: 'name',
                    className: 'fw-semibold ',
                    name: 'name'
                },

                {
                    data: 'email',
                    className: 'd-sm-table-cell  ',
                    name: 'email',



                },

                 {
                     data: 'designation',
                     className:'text-center',
                     name: 'designation',
                     searchable: true,
                     render:

                         function(data,type,row)
                         {

                             let designation = data;
                             let style="";

                             let actual="";

                             switch (designation)
                             {

                                 case 'technician':
                                     style="bg-info-light text-info";
                                     actual="Technician";
                                     break;
                                 case 'admin' :
                                     style="bg-success-light text-success";
                                     actual="Admin";
                                     break;
                                 case 'helpdesk' :
                                     style="bg-smooth-lighter text-smooth";
                                     actual="Help Desk";
                                     break;
                                 default:
                                     style="bg-smooth-lighter text-smooth"

                             }




                             return ' <span class="fs-xs  fw-semibold d-inline-block py-1 px-3 rounded-pill '+style+'">'+actual+'</span>';
                         }
                 },
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
                $( row ).attr('data-href', '/admin/users/details/'+data['id']);

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


            if(status==="All")
            {
                url='{{route('api_get_users_datatable')}}';
                console.log(url)
            } else {
                url = '{{route('api_get_users_datatable')}}?designation%5Beq%5D='+status;
            }

            $('#'+status).addClass('active');
            $('#'+status).siblings().removeClass('active');



            dataTable.ajax.url(url).load();


        }
    </script>


@endsection
