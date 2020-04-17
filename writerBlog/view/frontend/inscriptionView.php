<?php $title = 'Inscription'; ?>
<?php ob_start(); ?>
<section>
	<div id="login-body">
		<h2>Inscription</h2>
        <br><br>
        
		<form  action="index.php?action=addMember" method="POST">

					<input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" required value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
						
					<input type="email" placeholder="Votre mail" id="mail" name="mail" required value="<?php if(isset($mail)) { echo $mail; } ?>" />

                    <input type="password" placeholder="Entrez un mot de passe" id="mdp" name="mdp" required/>
					<br><br>

					<button type="submit"name="addMember"class="button">Je veux créer mon compte !</button>
					<br><br>
        </form>
        <p id="retour"><a href="index.php">Accueil</a></p>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require('include/headConnexion.php'); ?> 