<h3 class="title-admin underline">Liste des chapitres</h3>
<br />
<div class="row table-responsive-sm">
    <table class="table table-bordered">
        <thead class="table-design">
            <tr class="text-center">
                <th>Titre</th>
                <th>Date de publication</th>
                <th>Dernière modification</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
        
            <?php 
            foreach ($chapters as $chapter)
            {
            ?>
            <tr class="text-center" id="delete-<?= $chapter->getId() ?>">
                <td><?= htmlspecialchars_decode($chapter->getTitle()) ?></td>
                <td><?= htmlspecialchars_decode($chapter->getCreation_date_fr()) ?></td>
                <td>
                    <?php 
                        if ($chapter->getUpdate_date_fr() === NULL) 
                        { 
                            echo 'Aucune modification';
                        } 
                        else 
                        { 
                            echo 'Modifié le ' . htmlspecialchars_decode($chapter->getUpdate_date_fr());
                        }
                    ?>
                </td>
                <td>
                <a href="index.php?action=chapterEdit&amp;id=<?= $chapter->getId() ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td>
                     <i class="fas fa-trash" onclick="deleteChapter(<?= $chapter->getId() ?>)"></i>
                </td>
            </tr>
            <?php
            }
            ?>
        
        </tbody>
    </table>
</div>

<div class="button-add-chapter">
    <a href="index.php?action=addChapter">
        <input class="btn button-design" type="submit" value="Ajouter un chapitre"/>
    </a>
</div>


