function deleteChapter(id)
{   
    if(confirm('Confirmez-vous la suppression du chapitre ?'))
    {
        $.ajax
        ({
            type: 'GET',
            url: 'index.php?action=deleteChapter&id='+id,
            error: function()
            {
                alert('Echec de la suppression');
            },
            success: function() 
            {
                $("#delete-"+id).remove();
            }
        });
    }
}