@extends('admin.includes.master')
@section('head')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>

@endsection


@section('content')
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Quick Overview -->
            <div class="row">
                <div class="col-6 col-lg-3">
                    <a class="block block-rounded block-link-shadow text-center" href="{{route('admin.clients.create')}}">
                        <div class="block-content block-content-full">
                            <div class="fs-2 fw-semibold text-primary">
                                <i class="fa fa-plus"></i>
                            </div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="fw-medium fs-sm text-primary mb-0">
                                Add New Client
                            </p>
                        </div>
                    </a>
                </div>

            </div>
            <!-- END Quick Overview -->

            <!-- All Clients-->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">All Clients</h3>
                    <div class="block-options space-x-1">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                                data-target="#one-dashboard-search-orders" data-class="d-none">
                            <i class="fa fa-search"></i>
                        </button>

                    </div>
                </div>
                <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                    <!-- Search Form -->
                    <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                        <div class="push">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-alt" id="searchWork"
                                       name="one-ecom-orders-search" placeholder="Search all clients..">
                                <span class="input-group-text bg-body border-0">
                      <i class="fa fa-search"></i>
                    </span>
                            </div>
                        </div>
                    </form>
                    <!-- END Search Form -->
                </div>
                <div class="block-content block-content-full">
                    <!-- Recent Orders Table -->
                    <div class="table-responsive">
                        <table class="table table-hover js-table-checkable m-auto " id="try" width="90%">
                            <thead>
                            <tr>

                                <th class="d-xl-table-cell ">Name</th>
                                <th class=" d-sm-table-cell ">Email</th>
                                <th class=" d-sm-table-cell text-center">Quota</th>


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
        <!-- END All Products -->

        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

@endsection

@section('scripts')
    <script src=" {{asset('assets/js/lib/jquery.min.js')}}"></script>



    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>





    <script>





        var dataTable= $('#try').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url:'{{route('api_get_clients_datatable')}}',
                method:"GET",
                headers: {
                    Authorization: 'Bearer '+ '{{session('token')}}'
                },
            },
            columns: [

                {
                    data: 'name',
                    className: '',
                    name: 'name',
                    searchable: true,
                    render: function(data,type,row)
                    {
                        return '<strong>'+data+'</strong>'
                    }
                },
                {
                    data: 'email',
                    className: 'd-sm-table-cell fw-semibold text-muted',
                    name: 'email',
                    searchable: true,


                },

                {
                    data: 'quota',
                    className: 'text-center',
                    name: 'total',
                    searchable: true,





                    render: function(data,type,row)
                    {

                        let color ="bg-amethyst";
                        let hours = row['total'];
                        let percent=0;

                       if(hours==null)
                       {
                           hours=0;
                       } else if(hours===data)
                       {
                            color="bg-success"
                       }


                        if(hours>data)
                        {
                            percent = 100;
                            color = "bg-warning";
                        } else{
                            percent = Math.round((hours/data)*100);
                        }

                        return `<div class="progress mb-1" style="height: 7px;">
                        <div class="progress-bar `+color+`" role="progressbar" style="width: `+percent+`%;" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="fs-xs fw-semibold mb-0">`+hours+`/`+data+` hours</p>`;
                    }




                },


            ],
            dom: 'rt<"mt-4"p>',

            createdRow: function( row, data, dataIndex ) {
                // Set the data-status attribute, and add a class

                    $( row ).attr('data-href', 'clients/details/'+data['id']);



            }


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



@endsection
