<!--Liste des chapitres mis en ligne pour lecture-->
<?php $title = 'Chapitres du blog'; ?>
<?php ob_start();?>
<?php require('include/nav.php'); ?>

<div>
	<div class="postContent" >
		<h2>Mon livre "Billet simple pour l'Alaska"</h2>
		<h3>Les chapitres...</h3>
		<?php   while ($data = $posts->fetch())   { ?>
		
		<div class="newpost">
			<h3 id="newpostTitle">
				<?=($data['title']) ?>
				<p>Posté le <?= $data['creation_date_fr'] ?></p>
			</h3>
			<p class="newpost">
				<?= nl2br($data['content']) ?>
				<br>
				<p class="postContentButtons">
					<a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a>
				</p>
			</p>
		</div>

		<?php } $posts->closeCursor(); ?>
	</div>
</div>

<?php require('include/footer.php'); ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
