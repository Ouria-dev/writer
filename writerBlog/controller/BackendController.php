<?php 
/* --- CONTROLLER BACKEND --- */


require_once('model/PostManager.php');// chargement classes
require_once('model/CommentManager.php');
require_once('model/MembersManager.php');

class BackendController {


/* Connexion gestion Admin affiche page writing*/ 
    static function adminViewConnect() {

        if (isset($_SESSION) && $_SESSION['droits'] == '1') {
            require('view/backend/writingAdmin.php');
          }elseif (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
          }else { 
            echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Vous n\'avez pas de droit administrateur !</p>';
          }
    }


/* -- CHAPITRE -- */

/* Récupération chapitre admin par id */
    static function postAdmin() { 	
        $postManager = new PostManager();
        $chapitre = $postManager->getPostIdBdd($_GET['id']);

        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
            }
             if (isset($_GET['id']) && $_GET['id'] > 0) {
                require('view/backend/postAdmin.php');
            
            }else{
                echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Problème d\'affichage du chapitre !</p>';
            }
    }

/* Affichage de la liste des chapitres "Admin" */
    static function listPostViewAdmin() {
        $postManager = new PostManager();
        $posts = $postManager->getPostsAdminBdd();

        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
            }else{
            require('view/backend/listPostViewAdmin.php');
            }
    }

/* Rédation, création d'un chapitre */
static function addPost($title, $content) {
    $chapEdit = new PostManager();//création objet nouvel objet
    $chapitre = $chapEdit->addPostBdd($title, $content);
    
    if($chapitre === false) {//condition si false on arrête le script
        die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur... Impossible d \'ajouter un chapitre !');
    }else{//sinon affiche la liste des chapitres
        header('Location: index.php?action=listPostViewAdmin');
    }
}

/* Modification de chapitre existant "admin" */
    static function editPost($title, $content, $postId) {
        $chapModif = new PostManager();
        $chapOk = $chapModif->updatePostBdd($title, $content, $postId);
    
        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
            }
        if($chapOk === false) {
            die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur...Impossible de modifier ce chapitre!</p>');
            require('view/backend/postAdmin.php');
        }else{
            if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
            header('Location: index.php?action=listPostViewAdmin');
            }
        }
    }

/* Supprime un chapitre */
    static function delPost($dataId) {
        $supprime = new PostManager();
        $deletedPost = $supprime->delPostBdd($dataId);

        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
        
        if($deletedPost === false) {
            die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Impossible de supprimer ce chapitre !</p>');
            require('view/backend/postAdmin.php');

        }else{
            header('Location: index.php');
        }
    }
}

/* -- COMMENTAIRES -- */

/* Récupération de tout les commentaires pour les afficher dans l'admin*/	
    static function allCommentViewAdmin() { 	
        $commentsManager = new CommentManager();
        $allcomments = $commentsManager->allGetCommentsBdd();

        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
          }else{
            require('view/backend/allCommentsViewAdmin.php');
          }
    }

/* Récupère les commentaires signalés pour les afficher dans l'admin */
    static function commentsAdmin()	{ 	
        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentReportsBdd($_GET['signalement']);

        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
        }else{
          if (isset($_GET['signalement']) && $_GET['signalement'] == '1') {
            require('view/backend/commentsAdmin.php');
          }else{
            echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. problème d\'affichage du signalement !<br><br><a </p><a href="index.php?action=commentsAdmin&amp;signalement=1">Retour aux Commentaires signalés</a>';
          }
        }
    }

/* Dé-signale le commentaire signalé */
    static function delReports($commentId) { 	
        $commentManager = new CommentManager();
        $comments = $commentManager->delReportsBdd($commentId);

        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
        }elseif($comments === false) {
            die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur... Impossible de designaler le commentaire!</p>');
        }else{
            if ((isset($_GET['id'])) && (!empty($_GET['id']))){
                header('Location: index.php?action=commentsAdmin&signalement=1');
                }else{ 
                    echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Impossible de dé-signaler le commentaire !</p>';
                    require('view/backend/commentsAdmin.php');
                }
        }
    }

/* Supprime le commentaire signalé */
    static function delComments($commentId) {
        $supprime = new CommentManager();
        $deletedComment = $supprime->delCommentBdd($commentId);


        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
          }elseif($deletedComment === false) {
            die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Impossible de supprimer ce commentaire...</p>');
            require('view/backend/commentsAdmin.php');
        }else{
            if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
                header('Location: index.php?action=commentsAdmin&signalement=1');
            }
        }
    }


/* Supprime le commentaire */
    static function delComment($commentId) {
        $supprime = new CommentManager();
        $deletedComment = $supprime->delCommentBdd($commentId);

        if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
            header('Location: index.php');
          }elseif($deletedComment === false) {
            die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Impossible de supprimer ce commentaire...</p>');
            require('view/backend/allCommentsViewAdmin.php');
        }else{
            if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
                header('Location: index.php?action=commentViewAdmin');
            }
        }
    }
//end
}