<script>



    function addTechnician(){




        var val = $('.js-select2 :selected').text();
        var id = $('.js-select2 :selected').val();

        var block = `
               <div class="col-sm-5 pb-3 technicianbox"  id="`+technicianIds.length+`">
                <div class="form-check form-block">

                          <label class="form-check-label" for="example-checkbox-block1">
                            <span class="d-flex align-items-center justify-content-between ">
                                  <span>
                            <img class="img-avatar img-avatar48" src="`+imgUrl+`" alt="">

                             <span class="ms-2">
                                <span class="fw-bold">`+val+`</span>
                                </span>

                                </span>

                                <button type="button" class="btn btn-sm btn-alt-secondary"  onclick="removeTechnician(this)">
                                    <i class="fa fa-fw fa-times" ></i>
                                 </button>
                            </span>
                          </label>
                        </div>
                            </div>`;

        var obj = {
            "tech_id" : id
        }

        $(".techlist").append(block);

        technicianIds.push(obj);

        console.log(technicianIds);

    }

    function removeTechnician(button)
    {
        $(button).closest('.technicianbox').remove();

        var id = $(button).closest('.technicianbox').attr('id');

        delete technicianIds[id];

        console.log(technicianIds);

        console.log("lol");
    }


    function showRemoveModal(button)
    {


       $('#modal-block-normal').modal('show');


       techBlockToRemove =$(button).closest('.technicianbox').attr('id');


       techIdToRemove = $(button).closest('.technicianbox').attr('tech_id');






    }



    function sendJson(){
        var filtered = technicianIds.filter (x => x);

        if(filtered.length===0)
        {
            return false;
        }

        $('#json-hidden').val( JSON.stringify(filtered) );

    }














    function editTechnicians(button)
    {


        technicianIdsCopy = JSON.parse(JSON.stringify(technicianIds));

        $('#changesList').hide();



        $('#techListBlock').addClass('border border-primary border-2');
        $(button).prop('hidden','true')


        $('.tech-block-content').append(`<button type="button" class="btn btn-sm btn-alt-warning"  onclick="showRemoveModal(this)">
                                    <i class="fa fa-fw fa-times" ></i>
                                 </button>`);

        $('#techForm').prepend(` <div class="row pt-3 justify-content-center" id="techSelect">
                                    <div class="mb-4 col-8">
                                        <select class="js-select2 form-select" id="example-select2" name="example-select2" style="width: 100%;" data-placeholder="Choose one..">
                                            @foreach($data['technicians'] as $user)
        <option value='{{$user['id']}}'>{{$user['name']}}</option>
                                            @endforeach
        </select>
    </div>

    <div class="mb-4 col-3">
        <button type="button" class="btn btn-alt-primary push add" onclick="addTechnician()">Add Technician</button>
    </div>

    </div>`);


        $('#techForm').append('<div class="mb-4"><button type="submit" id="submitTech" class="btn btn-primary">Submit</button></div>');

        $(button).siblings('.cancel').removeAttr('hidden');
    }


    function sendEditJson()
    {

        var filtered = technicianIds.filter (x => x);

        if(filtered.length===0)
        {
            return false;
        }

        $('#json-hidden').val( JSON.stringify(filtered) );




    }



    function resetEdit(button)
    {



        technicianIds = JSON.parse(JSON.stringify(technicianIdsCopy));


        $(button).prop('hidden','true')

        $('#techListBlock').removeClass('border border-primary border-2');

        $('#techSelect').remove();
        $('#submitTech').remove();

        $(button).siblings('#edit').removeAttr('hidden');








        // change techlist back to data from database

        $('.techlist').html(`@for($i=0;$i<count($data['assigned']);$i++)

        @if($data['assigned'][$i]['status']!='Removed')
        <div class="col-sm-5 pb-3 technicianbox" id="{{$i}}">
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
@endfor `);


$('#changesList').show();



    }



     function removeEditTechnician()
    {



        let removeReason = $('#reason').val()



        $.ajax({
            url: "{{route('admin.workorders.remove_assigned_technician')}}",
            method:"POST",

            data:{dat: {
                reason: removeReason,
                tech_id: techIdToRemove,
                    work_id: {{$data['details']['id']}},

                }, _token : '{{csrf_token()}}'},

            success: function(data){



                $('#'+techBlockToRemove+".technicianbox").remove();


            console.log(data)
            }
        });




    }







</script>
