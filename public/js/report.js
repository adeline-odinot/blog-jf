function report(id)
{
    $.ajax({
        type: 'GET',
        url: 'index.php?action=report&id_comment='+id,
        success: function(data) 
        {
            if(data) 
            {
                $('#report-'+id).removeAttr('onclick').removeClass('button-design').addClass('design-report').html("<em>Le commentaire a bien été signalé.</em>");
            }
            else
            {
                alert('Erreur du signalement');
            }                
        }
    });
}