




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

function sendJson(){
    var filtered = technicianIds.filter (x => x);

    if(filtered.length===0)
    {
        return false;
    }

    $('#json-hidden').val( JSON.stringify(filtered) );

}
