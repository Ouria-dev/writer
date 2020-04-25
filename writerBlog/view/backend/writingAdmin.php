<?php $title = 'Rédaction des chapitres'; ?>
<?php ob_start(); ?>
<?php require('include/navAdmin.php'); ?>

 <!--menu liens-->
<div class="container">
    <div align="center" id="witingBlock">
        <h2><span class="titleAdmin">Administration</span></h2><br>
        <h3><span class="soustitleAdmin">Rédaction d'un chapitre : </span></h3>

  
   <!--formulaire pour un nouveau chapitre-->
  

        <form class="form" id="form" method="post" action="index.php?action=addPost&amp;id= ">
          <input type="text" placeholder="Ton titre de chapitre" id="title" name="title" /><br><br>
          <textarea name="content"  id="content" placeholder="Ton nouveau Chapitre"></textarea><br>
          <button type="submit" name="envoi_message" id="commentButton">Envoie ton chapitre !</button><br><br>
        </form>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('templateAdmin.php'); ?> 
