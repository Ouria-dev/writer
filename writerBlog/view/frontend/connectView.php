<?php $title = 'connexion'; ?>
<?php ob_start(); ?>



<section>
   <div id="login-body">
      <h2>S'identifier</h2>
      <br><br>

      <form action="index.php?action=connexion" method="POST">

         <input type="text" name="pseudo" placeholder="Pseudo" required/>

         <input type="password" name="mdp" placeholder="Mot de passe" required/>
         <br /><br />

         <button type="submit" name="connexion" class="button">S'identifier</button>

      </form>
      <p class="grey">Première visite sur notre blog ? <a href="index.php?action=displayContact"> Inscrivez-vous</a>.</p><br>
      <p id="retour"><a href="index.php">Accueil</a></p>
   </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require('include/headConnexion.php'); ?> 