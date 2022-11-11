@extends('admin.includes.master')


@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="content">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
                <div class="flex-grow-1 mb-1 mb-md-0">
                    <h1 class="h3 fw-bold mb-2">
                        Closed Work Orders
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
                    <h3 class="block-title">Orders</h3>
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
                                   href="javascript:void(0)">
                                    Pending
                                    <span class="badge bg-primary rounded-pill">20</span>
                                </a>
                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   href="javascript:void(0)">
                                    Active
                                    <span class="badge bg-primary rounded-pill">72</span>
                                </a>
                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   href="javascript:void(0)">
                                    Completed
                                    <span class="badge bg-primary rounded-pill">890</span>
                                </a>
                                <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                   href="javascript:void(0)">
                                    All
                                    <span class="badge bg-primary rounded-pill">997</span>
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
                                <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search"
                                       name="one-ecom-orders-search" placeholder="Search all orders..">
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
                        <table class="table table-hover table-vcenter">
                            <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell text-center">ID</th>
                                <th class="d-none d-xl-table-cell pl-6">Client</th>
                                <th class="d-none d-sm-table-cell text-center">Contact</th>
                                <th class="d-none d-sm-table-cell text-center">Product</th>

                                <th class="d-none d-sm-table-cell text-center">Last Changed</th>

                            </tr>
                            </thead>
                            <tbody class="fs-sm">


                            @foreach($data['data'] as $x)

                                <tr>
                                    <td class="text-center">
                                        <a class="fw-semibold text-default"
                                           href=" {{ route("admin.workorders.details",['id'=>$x['id']]) }} ">BI {{$x['id']}}</a>

                                    </td>
                                    <td class="d-none d-xl-table-cell pl-6">
                                        <strong>{{$x['client']}}</strong>

                                    </td>

                                    <td class="d-none d-sm-table-cell fw-semibold text-muted text-center">{{$x['client_contact_no']}}</td>

                                    <td class="d-none d-sm-table-cell fw-semibold text-muted text-center">{{$x['product']}}</td>


                                    <td class="d-none d-sm-table-cell fw-semibold text-muted text-center">{{\Carbon\Carbon::parse($x['updated_at'])->diffForHumans()}}</td>

                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- END Recent Orders Table -->
                </div>
                <div class="block-content block-content-full bg-body-light">


                    <!-- Pagination -->
                    <nav aria-label="Photos Search Navigation">
                        <ul class="pagination pagination-sm justify-content-end mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                                    Prev
                                </a>
                            </li>


                            <li class="page-item active">
                                <a class="page-link" href="javascript:void(0)">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- END Pagination -->
                </div>
            </div>
            <!-- END Recent Orders -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

@endsection
