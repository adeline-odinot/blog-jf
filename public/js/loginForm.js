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
                    window.location.replace('index.php?action=home');
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