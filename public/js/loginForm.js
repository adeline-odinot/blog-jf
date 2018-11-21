$(function () {
    
    $('#login-form').submit(function(e) {
        e.preventDefault();
        $('#messageError').empty();
        $('#idError').empty();
        $('#passwordError').empty();
        var postdata = $('#login-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'index.php?action=verifLogin',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.isSuccess) 
                {
                    $('#login-form')[0].reset();
                }
                else
                {
                    $('#messageError').html(json.messageError);
                    $('#idError').html(json.idError);
                    $('#passwordError').html(json.passwordError);
                }                
            }
        });
    });

})