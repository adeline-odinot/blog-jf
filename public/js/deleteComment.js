function deleteComment(id)
{   
    if(confirm('Confirmez-vous la suppression du commentaire ?'))
    {
        $.ajax
        ({
            type: 'GET',
            url: 'index.php?action=deleteComment&id='+id,
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