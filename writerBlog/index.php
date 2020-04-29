<?php 
 /* --- ROUTEUR --- */

require('controller/FrontendController.php');
require('controller/BackendController.php');
session_start();  // garde la session

/* Affichage page d'accueil */
if (isset($_GET['action'])) { 
  if ($_GET['action'] == 'pageAccueil') {
    FrontendController::pageAccueil(); 
  }
/* chapitre et commentaire USER*/
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
      FrontendController::listPosts();
    }elseif ($_GET['action'] == 'post') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        FrontendController::post();
      }else{
        echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">>Erreur. Aucun identifiant chapitre envoyé !</p>';
      }
    }elseif ($_GET['action'] == 'addComment') { //ajout d'un commentaire
      if (isset($_GET['id']) && $_GET['id'] > 0) {
       if(!empty($_GET['id']) && ($_POST['comment'])) {
         FrontendController::addComment($_GET['id'], $_SESSION['id'], $_POST['comment']);
       }else{
         echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Tous les champs ne sont pas remplis !</p>';
        }
      }else{
       echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Aucun identifiant de chapitre envoyé !</p>';
      }
    }
  }

/* Commentaire USER */  
  if (isset($_GET['action'])) { //signale un commentaire
    if ($_GET['action'] == 'signal') {
      if ((isset($_GET['id'])) && (!empty($_GET['id']))){
        FrontendController::signal($_GET['id']);
      }else{
        echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur de signalement !</p>';}
      }
  }

/* Liste chapitres ADMIN */
if (isset($_GET['action'])) { //affichage liste des chapitres Admin
  if ($_GET['action'] == 'listPostViewAdmin') {
    if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
        header('Location: index.php');
      }else{
        BackendController::listPostViewAdmin(); 
      }
    }
}

/* Liste commentaires ADMIN */
if (isset($_GET['action'])) { //affichage liste des chapitres Admin
  if ($_GET['action'] == 'commentViewAdmin') {
    if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
        header('Location: index.php');
      }else{
        BackendController::allCommentViewAdmin();
      }
    }
}


/* Un Chapitre ADMIN*/
  if (isset($_GET['action'])) { //affiche un chapitre à modifier ou à supprimer Admin
    if ($_GET['action'] == 'postAdmin') {
      if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
          header('Location: index.php');
        }else{
          if (isset($_GET['id']) && $_GET['id'] > 0) {
            BackendController::postAdmin();
        }else {
          echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Problème d\'affichage du chapitre !</p>';
        }
      }
    } 
  }

/* Ajoute un chapitre ADMIN */
if (isset($_GET['action'])) { // rédation nouveau chapitre
 if ($_GET['action'] == 'addPost') {
   if (isset($_POST['envoi_message']) && isset($_POST['title']) && isset($_POST['content'])) 
   {
    $title = ($_POST['title']);
    $content = ($_POST['content']);
    if(!empty(trim($_POST['title'])) && !empty(trim($_POST['content'])))
    {         
      BackendController::addPost($_POST['title'], $_POST['content']); 
    }else{
      echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Vous n\'avez pas saisi de texte ! Cliquez sur Rédaction</p>';
      require('view/backend/writingAdmin.php');

      }             
    }
  }
}

/* Supprime chapitre */
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'delPost') {
      if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
        header('Location: index.php');
      }else{
        if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
          BackendController::delPost($_GET['id']);
        }
      }
    }
  }

/* Modifie un chapitre ADMIN */
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'editPost') {
      if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
        header('Location: index.php');
      }else{
        if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
        BackendController::editPost($_POST['title'], $_POST['content'], $_GET['id']);
        }
      }
    }
  }

/* Récupère les commentaires signalés */
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'commentsAdmin') {
      if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
          header('Location: index.php');
      }else{
        if (isset($_GET['signalement']) && $_GET['signalement'] == '1') {
          BackendController::commentsAdmin($_GET['signalement']);
        }else{
          echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. problème d\'affichage du signalement !</p>';
          require('view/backend/commentsAdmin.php');
        }
      }
    } 
  }

/* Dé-signale commentaire signalé */
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'delReports') {
      if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
          header('Location: index.php');
      }else{
        if ((isset($_GET['id'])) && (!empty($_GET['id']))){
          BackendController::delReports($_GET['id']);
        }else{ 
          echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Impossible de dé-signaler le commentaire !</p>';
          require('view/backend/commentsAdmin.php');
        }
      }
    }
  }

/* Supprime un commentaire signalé */
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delComments') {
      if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
        header('Location: index.php');
      }else{
        if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
          BackendController::delComments($_GET['id']);
        }
      }
    }
  }

/* Supprime un commentaire */
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'delComment') {
    if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
      header('Location: index.php');
    }else{
      if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
        BackendController::delComment($_GET['id']);
      }
    }
  }
}

/* Affiche le formulaire de connexion */
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'displayConnexion') {
      FrontendController::displayConnexion(); 
    }       
  }

/* Connexion */
  if(isset($_GET['action'])) { 
    if ($_GET['action'] == 'connexion') {
      if (isset($_POST['connexion']) && isset($_POST['pseudo']) && isset($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
      if(!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['mdp']))){
        FrontendController::connexion($_POST['pseudo'], $_POST['mdp']); 
      }else{
        echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Tous les champs doivent-être remplis !</p>';
        require('view/frontend/connectView.php');
      }   
      }
    }
  }

/* Déconnexion */
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'deconnexion') {
      FrontendController::deconnexion();
    } 
  }

/* Affiche la liste les chapitres */
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'listChapitres') {
      FrontendController::listChapitres(); 
    }
  }

/* Affichage formulaire d'inscription */
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'displayContact') {
      FrontendController::displayContact(); 
    }     
  }

/* Ajout membre */ 
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'addMember') {
      if (isset($_POST['addMember']) && isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['mdp'])) { 
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        if(!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['mdp'])) {
          $pseudolength = strlen($pseudo);
          if($pseudolength > 2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
              FrontendController::addMember($_POST['pseudo'], $_POST['mail'], $_POST['mdp']); 
              header('Location: index.php?action=displayConnexion');
            } else {
           echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Adresse mail non valide !</p>';
           require('view/frontend/inscriptionView.php');
          }
          } else {
            echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Votre pseudo doit contenir plus de 2 caractères !</p>';
            require('view/frontend/inscriptionView.php');
          }
        }else {
          echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Tous les champs doivent être complétés !</p>';
          require('view/frontend/inscriptionView.php');
        }
      }
    }
  }

/* Connexion gestion Admin */
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'adminViewConnect') {
      if (!isset($_SESSION['droits']) || ($_SESSION['droits'] == 0)) {
          header('Location: index.php');
        }else{
          if (isset($_SESSION) && $_SESSION['droits'] == '1') {
            BackendController::adminViewConnect();
          }else { 
            echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Vous n\'avez pas de droit administrateur !</p>';
          }
        }
    }
  }

/* Affiche la page d'accueil */ 
}else{ 
  FrontendController::pageAccueil(); //si aucune action, alors affiche la page d'accueil
}