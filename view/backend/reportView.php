<h3 class="title-admin underline">Commentaires signalés</h3>
<br />
<div class="row table-responsive-sm">
    <table class="table table-bordered">
        <thead class="table-design">
            <tr class="text-center">
                <th>Auteur</th>
                <th>Commentaire</th>
                <th>Nombre de signalement(s)</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
        <?php
        
        foreach ($comments as $comment)
        {
        ?>
        <tr class="text-center">
            <td><?= htmlspecialchars($comment->getAuthor()) ?></td>
            <td><?= htmlspecialchars($comment->getComment()) ?></td>
            <td><?= htmlspecialchars($comment->getNb_report()) ?></td>
            <td>
                <a href="#">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td>
                <i class="fas fa-trash"></i>
            </td>
        </tr>
        <?php
        }
        
        ?>
        </tbody>

    </table>
</div>