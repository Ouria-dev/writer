<?php $title = 'redaction des chapitres'; ?>
<?php ob_start(); ?>
<?php require('include/navAdmin.php'); ?>


<div class="container">
    <div align="center" id="witingBlock">
        <h2><span class="titleAdmin">Administration</span></h2><br>
        <h3><span class="soustitleAdmin">Rédaction d'un chapitre : </span></h3>

  
   <!--formulaire pour un nouveau chapitre-->
  

        <form class="form" id="form" method="post" action="index.php?action=addPost&amp;id= ">
          <textarea id="title" name="title">Ton titre de chapitre </textarea><br><br>
          <textarea name="content"  id="content">Ton chapitre</textarea><br>
          <button type="submit" name="envoi_message" id="commentButton">Envoie ton chapitre !</button><br><br>
        </form>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('templateAdmin.php'); ?> 
