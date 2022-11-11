$(document).ready(function(){
    $(".edit").click(function(){

        if($(this).hasClass('edit-customer'))
        {
            $('.customer-input input').removeAttr('disabled');
        }

        $(this).hide();
        $('.customer-input .save').removeAttr('hidden');
        $('.customer-input .cancel').removeAttr('hidden');
    });
});
