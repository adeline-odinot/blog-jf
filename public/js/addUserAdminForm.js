$(function () {
    
    $('#user-admin-form').submit(function(e) {
        e.preventDefault();
        $('#idError').empty();
        $('#passError').empty();
        $('#passConfirmError').empty();
        $('#emailError').empty();
        $('.thank-you').html('');
        var postdata = $('#user-admin-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'index.php?action=verifUserAdminForm',
            data: postdata,
            dataType: 'json',
            success: function(json) 
            {
                if(json.isSuccess) 
                {
                    $('.thank-you').html('L\'inscription à bien été prise en compte.');
                    $('#user-admin-form')[0].reset();
                }
                else
                {
                    $('#idError').html(json.idError);
                    $('#passError').html(json.passError);
                    $('#passConfirmError').html(json.passConfirmError);
                    $('#emailError').html(json.emailError);
                }                
            }
        });
    });

})