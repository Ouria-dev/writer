<?php $title = 'Chapitre à modifier'; ?>
<?php ob_start(); ?>
<?php require('include/navAdmin.php'); ?>

<div>
	<div align="center">
	<h2><span class="titleAdmin">Administration</span></h2><br>
	<h3><span class="soustitleAdmin">Modifier chapitre</span></h3>
		<?php
		while ($data = $chapitre->fetch())
		{
			?>
			<div>
				<form method="post" action="index.php?action=editPost&amp;id=<?=$data['id'] ?>">
					<h4>Id : <?= $data['id'] ?></h4><br>
					<h5 class="soustitleAdmin">Modifier le Titre:</h5>
					<textarea type="text" name="title" rows="1" cols="50" placeholder="title"><?=$data['title'] ?></textarea><br><br>
					<h5 class="soustitleAdmin">Modifier le Texte:</h5>
					<textarea id="adminContent" name="content"  rows="5" cols="50" placeholder="content"><?=$data['content'] ?></textarea><br><br>
					<button type="submit" name="delPost" class="buttonOk">Modifie ton chapitre !</button><br>
				</form>

			</div>

			<div>
				<form class="form"method="post" action="index.php?action=delPost&amp;id=<?=$data['id'] ?>">
					<button type="submit" name="delPost" class="delButton">Supprime ton chapitre !</button><br>
				</form>
			</div>

		<?php
		}
		$chapitre->closeCursor();	
		?>
	</div>
	
</div>

<?php

?>
<?php $content = ob_get_clean(); ?>
<?php require('templateAdmin.php'); ?>