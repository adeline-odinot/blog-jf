$(function () {
    
    $('#add-chapter-form').submit(function(e) 
    {
        e.preventDefault();
        $('#titleError').empty();
        $('#authorError').empty();
        $('#contentError').empty();
        var postdata = $('#add-chapter-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'index.php?action=verifAddChapter',
            data: postdata,
            dataType: 'json',
            success: function(json) 
            {
                if(json.isSuccess) 
                {
                    window.location.replace('index.php?action=listChapters');

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

})