<?php $title = 'Liste des chapitres'; ?>
<?php ob_start(); ?>
<?php require('include/navAdmin.php'); ?>

<div>
  <div align="center">
  <h2><span class="titleAdmin">Administration</span></h2><br>
  <h3><span class="soustitleAdmin">Modification de chapitres...</span></h3>

   <?php
   while ($data = $posts->fetch())
   {
   ?>  

    <div class="postContent"> <!--affiche titre, date et contenu chapitre-->
        <div class="newpost"> 
    <h4 class="newpostTitle">
       <?=($data['title']) ?>
       <em>le <?= $data['creation_date_fr'] ?></em>
     </h4>

     <p>
       <?= nl2br($data['content']) ?><br>
       <p class="postContentButtons"><a href="index.php?action=postAdmin&amp;id=<?= $data['id'] ?>">Modifier</a></p>
     </p>
     </div>
    </div>

   <?php
   }
   $posts->closeCursor();	
   ?>

  </div>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('templateAdmin.php'); ?>

