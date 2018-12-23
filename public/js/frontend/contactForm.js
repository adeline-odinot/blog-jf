$(function () {
    
    $('#contact-form').submit(function(e) {
        e.preventDefault();
        $('#nameError').empty();
        $('#emailError').empty();
        $('#phoneError').empty();
        $('#messageError').empty();
        $('.thank-you').html('');
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'index.php?action=verifContact',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.isSuccess) 
                {
                    $('.thank-you').html("Votre message a bien été envoyé. <br /> Merci de m'avoir contacté !<p class='author-sign'><em>Jean FORTEROCHE</em></p>");
                    $('#contact-form')[0].reset();
                }
                else
                {
                    $('#nameError').html(json.nameError);
                    $('#emailError').html(json.emailError);
                    $('#phoneError').html(json.phoneError);
                    $('#messageError').html(json.messageError);
                }                
            }
        });
    });

})