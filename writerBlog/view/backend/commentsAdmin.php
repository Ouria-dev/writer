<?php $title = 'Commentaires Signalés(admin)'; ?>
<!--affichage liste des commentaires signalés-->
<?php ob_start(); ?>
<?php require('include/navAdmin.php'); ?>


<div align="center">
    <h2><span class="titleAdmin">Administration</span></h2><br>
</div>


    <table id="moderationTable">
        <caption class="soustitleAdmin">Gestion des commentaires signalés :</caption>
        <thead>
            <tr>
                <th class="postColumnTitle">ID</th>
                <th class="authorColumnTitle">Date</th>
                <th class="commentColumnTitle">Commentaires</th>
                <th class="commentColumnTitle">Action</th>
            </tr>
        </thead>

        <tbody align="center">
            <?php
                    while ($comment = $comments->fetch())
                    {
                      ?>


                        <tr>
                            <td class="postColumn">
                                <?= $comment['id'] ?>
                            </td>

                            <td class="dateColumn">
                                <?= $comment['comment_date_fr'] ?>
                            </td>

                            <td class="commentColumn">
                                <?= nl2br(htmlspecialchars($comment['comment'])) ?> 
                            </td>

                            <td>
                                <button type="submit" class="buttonOk"><a href="index.php?action=delReports&amp;id=<?=$comment['id'] ?>">Conserver le commentaire !</a></button>

                                <button type="submit" name="delComments"class="delButton"><a href="index.php?action=delComments&amp;id=<?=$comment['id'] ?>">Supprimer le commentaire !</a></button>
                            </td>
                        </tr>

                        <?php } 
                        $comments->closeCursor();?>
        </tbody>
    </table>

<?php $content = ob_get_clean(); ?>
<?php require('templateAdmin.php'); ?>