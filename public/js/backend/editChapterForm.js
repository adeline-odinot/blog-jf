function editChapter(id)
{   
    $('#edit-chapter-form').submit(function(e) 
    {
        e.preventDefault();
        $('#titleError').empty();
        $('#authorError').empty();
        $('#contentError').empty();
        var postdata = $('#edit-chapter-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'index.php?action=verifChapterEdit&id='+id,
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
                    $('#titleError').html(json.titleError);
                    $('#authorError').html(json.authorError);
                    $('#contentError').html(json.contentError);
                }                
            }
        });
    });
}