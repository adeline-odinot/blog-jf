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
            <tr class="text-center">
                <td><?= htmlspecialchars($chapter->getTitle()) ?></td>
                <td><?= htmlspecialchars($chapter->getCreation_date_fr()) ?></td>
                <td>
                    <?php 
                        if ($chapter->getUpdate_date_fr() === NULL) 
                        { 
                            echo 'Aucune modification';
                        } 
                        else 
                        { 
                            echo 'Modifié le ' . htmlspecialchars($chapter->getUpdate_date_fr());
                        }
                    ?>
                </td>
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

<a href="#">
    <input class="button-design" type="submit" value="Ajouter un chapitre"/>
</a>

