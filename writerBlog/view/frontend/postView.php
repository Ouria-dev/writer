<!--Affichage interface commentaires-->
<?php $title = ($post['title']) ?>
<?php ob_start(); ?>
<?php require('include/nav.php'); ?>

<div class="postContent">
    <div align="center"><br>
        <h2 >Billet simple pour l'Alaska, un nouveau chapitre !</h2>
            <p class="backToPosts"><a href="#ancre bas de page">Les commentaires</a></p>
              <div class="newpost">
              <h3 id="newpostTitle">
                    <?= ($post['title']) ?>
                    <p><em> le <?= $post['creation_date_fr'] ?></em></p>
                    </h3>
                    

                      <p>
                        <?= nl2br($post['content']) ?>
                      </p>
              </div>

                        <?php  if(isset($_SESSION['id'])) { ?> 

        <div class="commentaires" >
              <h2>Mon commentaire :</h2><br/>

                  <form action="index.php?action=addComment&amp;id=<?=$post['id'] ?>"method="post">
                  <div>
                    <textarea id="commentBox" name="comment" placeholder="Votre texte"></textarea>
                  </div>
                  <div><br>
                    <button type="submit" id="commentButton">J'envoie mon commentaire !</button><br>
                  </div>
                </form>
   
                        <?php 
                      }else{
                        echo '<h3 id="error">Pour l\'ajout d\'un commentaire, veuillez vous connecter !</h3>
                        <div class="butonLine"><p class="backToPosts"><a href="index.php?action=displayContact">Inscription</a></p><p class="backToPosts"><a href="index.php?action=displayConnexion">Connexion</a></p></div>'; 
                      }
                      ?>

              <div>
                <h2 id="ancre bas de page" >Commentaires :</h2><br>
                    <?php
                              while ($comment = $comments->fetch()) //renvoit dans $comment les infos du commentaire
                              {
                                ?> <!--affiche l'auteur la date et le commentaire-->
                                <div class="commentOld"><br>
                                  <p><em>Envoyé le : </em><?= $comment['comment_date_fr'] ?></p>
                                  <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                  <p>Commentaires écrit par : <?= $comment['pseudo'] ?></p>
                                  <?php  if(isset($_SESSION['id'])) { ?>
                                    <p class="backToPosts"><a href="index.php?action=signal&amp;id=<?=$comment['id'] ?>">Signaler ce commentaire !</a></p><br><br>
                                    <?php } ?>
                                </div>
                                <?php
                              }
                              ?>
              </div>
        </div>
      </div>
    </div>

    <?php require('include/footer.php'); ?>
    <?php $content = ob_get_clean(); ?>
    <?php require('template.php'); ?>