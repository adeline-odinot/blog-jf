function addCommentForm(id) {
    
    $('#commentError').empty();
    $('#authorError').empty();
    var postdata = $('.add-comment').serialize();
    
    $.ajax({
        type: 'POST',
        url: 'index.php?action=verifAddComment&id='+id,
        data: postdata,
        dataType: 'json',
        success: function(json) {
                
            if(json.isSuccess) 
            {
                window.location.replace('index.php?action=chapter&id='+id);
            }
            else
            {
                $('#commentError').html(json.commentError);
                $('#authorError').html(json.authorError);
            }                
        }
    });
}