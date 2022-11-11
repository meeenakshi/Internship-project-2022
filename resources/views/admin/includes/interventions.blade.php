<!-- START Interventions Card-->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Intervention</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="row justify-content-center">

            <div class="col-lg-11 space-y-4">


                <div class="row pt-3 justify-content-center">

                    <!-- IF No Interventions-->
                    @if(count($data['interventions'])==0)
                        <div class="col-8 text-center">
                            <h4>No Interventions</h4>
                        </div>

                        <!-- ELSE Show Table of interventions-->
                    @else
                        <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                            <thead>
                            <tr>

                                <th>Name</th>
                                <th class="text-center">Time From</th>
                                <th class="text-center">Time To</th>

                                <th class="d-none d-sm-table-cell text-center" style="width: 20%;">Date</th>
                            </tr>
                            </thead>
                            <tbody>


                            <!-- For each intervention show a row-->
                            @foreach($data['interventions'] as $inter)
                                <tr>

                                    <td class="fs-sm">
                                        <p class="fw-semibold mb-1">
                                            <a class="text-default">{{ $inter['name'] }}</a>
                                        </p>
                                        <p class="text-muted mb-0">
                                            {{ $inter['remarks'] }}
                                        </p>
                                    </td>

                                    <td class="text-center">{{ date('H:i', strtotime($inter['time_from'])) }}</td>

                                    <td class="text-center">{{ date('H:i', strtotime($inter['time_to']))  }}</td>

                                    <td class="d-none d-sm-table-cell text-center">
                                        <em class="fs-sm text-muted">{{ date('j F Y', strtotime($inter['date'])) }}</em>


                                    </td>
                                </tr>
                            @endforeach




                            </tbody>
                        </table>


                        <!-- If technicians have completed work, show close button -->
                        @if($status=='Complete')
                            <form action="{{ route('admin.workorders.close_work_order') }}" method="POST">
                                @csrf

                                <input type="hidden" id="id" name="work_id" value="{{ $data['details']['id'] }}">

                                <div class="pt-3 text-center">
                                    <button type="submit" class="btn btn-success push mx-2 px-5">Close</button>
                                </div>
                            </form>

                            <form action="{{ route('admin.workorders.reassign') }}" method="POST">
                                @csrf

                                <input type="hidden" id="id" name="work_id" value="{{ $data['details']['id'] }}">

                                <div class="pt-3 text-center">
                                    <button type="submit" class="btn btn-warning push mx-2 px-5">Reassign</button>
                                </div>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END Interventions Card-->
