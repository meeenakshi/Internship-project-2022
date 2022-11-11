




    @for($i=0;$i<count($data['assigned']);$i++)



@if($data['assigned'][$i]['status']!='Removed')
    <div class="col-sm-5 pb-3 technicianbox" id="{{$i}}" tech_id="{{$data['assigned'][$i]['id']}}">
        <div class="form-check form-block techBlock ">

            <label class="form-check-label" for="example-checkbox-block1">
                            <span class="d-flex align-items-center justify-content-between {{ $data['assigned'][$i]['status'] != "Done"? 'tech-block-content': null}}">
                                  <span>
                            <img class="img-avatar img-avatar48" src="{{ asset('assets/media/avatars/avatar1.jpg') }}" alt="">

                             <span class="ms-2">
                                <span class="fw-bold">{{$data['assigned'][$i]['name']}}</span>
                                </span>

                                </span>


                                @if($data['assigned'][$i]['status'] == "Done")

                                 <i class="fa fa-fw fa-2x fa-check text-success" ></i>
                                @endif

                            </span>
            </label>
        </div>
    </div>
@endif
    @endfor


<script>



    console.log(technicianIds);
</script>
