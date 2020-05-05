<?php $title = 'Tous les Commentaires du site'; ?>
<!--affichage liste des commentaires-->
<?php ob_start(); ?>
<?php require('include/navAdmin.php'); ?>


<div align="center">
    <h2><span class="titleAdmin">Administration</span></h2><br>
</div>


    <table id="moderationTable">
        <caption class="soustitleAdmin">Gestion des commentaires du site :</caption>
        <thead>
            <tr>
                <th class="postColumnTitle">ID Commentaires</th>
                <th class="postColumnTitle">ID Post</th>
                <th class="authorColumnTitle">Date</th>
                <th class="commentColumnTitle">Commentaires</th>
                <th class="commentColumnTitle">Action</th>
            </tr>
        </thead>

        <tbody align="center">

<?php
   while ($data = $allcomments->fetch()) {
   ?>

                        <tr>
                            <td class="postColumn">
                                <?= $data['id'] ?>
                            </td>

                            <td class="postColumn">
                                <?= $data['id_billet'] ?>
                            </td>

                            <td class="dateColumn">
                                <?= $data['comment_date_fr'] ?>
                            </td>

                            <td class="commentColumn">
                                <?= nl2br(htmlspecialchars($data['comment'])) ?> 
                            </td>

                            <td>
                                
                                <button type="submit" name="delComment"class="delButton"><a href="index.php?action=delComment&amp;id=<?=$data['id'] ?>">Supprimer le commentaire !</a></button>
                            </td>
                        </tr>

<?php
   }
   $allcomments->closeCursor();	
   ?>

</tbody>
    </table>

<?php $content = ob_get_clean(); ?>
<?php require('templateAdmin.php'); ?>