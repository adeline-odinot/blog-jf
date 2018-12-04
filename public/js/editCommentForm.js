function editComment(id)
{
    $('#edit-comment-form').submit(function(e) 
    {
        e.preventDefault();
        $('#authorError').empty();
        $('#commentError').empty();
        var postdata = $('#edit-comment-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'index.php?action=verifCommentEdit&id='+id,
            data: postdata,
            dataType: 'json',
            success: function(json) 
            {
                if(json.isSuccess) 
                {
                    window.location.replace('index.php?action=admin');

                }
                else
                {
                    $('#authorError').html(json.authorError);
                    $('#commentError').html(json.commentError);
                }                
            }
        });
    });
}