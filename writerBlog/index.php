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

/* Affiche le formulaire de connexion */
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'displayConnexion') {
      FrontendController::displayConnexion(); 
    }
  }       
  
/* Déconnexion */
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'deconnexion') {
      FrontendController::deconnexion();
    } 
  }

/* Signale un commentaire USER */  
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'signal') {
      FrontendController::signal($_GET['id']);
    }
  }

/* Connexion gestion Admin */
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'adminViewConnect') {
      BackendController::adminViewConnect();
  }
}

/* Liste chapitres ADMIN */
if (isset($_GET['action'])) { 
  if ($_GET['action'] == 'listPostViewAdmin') {
        BackendController::listPostViewAdmin(); 
    }
  } 

/* Supprime chapitre ADMIN */
if (isset($_GET['action'])) { 
  if ($_GET['action'] == 'delPost') {
        BackendController::delPost($_GET['id']);
        header('Location: index.php?action=listPostViewAdmin');
    }
  }

/* Chapitre à modif ou del ADMIN*/
  if (isset($_GET['action'])) { 
    if ($_GET['action'] == 'postAdmin') {
        BackendController::postAdmin();
    } 
  }

/* Modifie un chapitre ADMIN */
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'editPost') {
      BackendController::editPost($_POST['title'], $_POST['content'], $_GET['id']);
      }
    }

/* Liste commentaires ADMIN */
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'commentViewAdmin') {
      BackendController::allCommentViewAdmin();
    }
  }

/* Supprime un commentaire signalé */
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'delComments') {
      BackendController::delComments($_GET['id']);
  }
}

/* Supprime un commentaire */
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'delComment') {
      BackendController::delComment($_GET['id']);
  }
}

/* Récupère les commentaires signalés */
if (isset($_GET['action'])) { 
  if ($_GET['action'] == 'commentsAdmin') {
      BackendController::commentsAdmin($_GET['signalement']);
  }
} 

/* Dé-signale commentaire signalé */
if (isset($_GET['action'])) { 
  if ($_GET['action'] == 'delReports') {
        BackendController::delReports($_GET['id']);
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

/* Chapitre et commentaire USER*/
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'listPosts') {
    FrontendController::listPosts();
  }elseif ($_GET['action'] == 'post') {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
      FrontendController::post();
    }else{
      echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">>Erreur. Aucun identifiant chapitre envoyé !</p>';
    }

/* Ajout d'un commentaire */
  }elseif ($_GET['action'] == 'addComment') { 
    if (isset($_GET['id']) && $_GET['id'] > 0) {
     if(!empty($_GET['id']) && ($_POST['comment'])) {
       FrontendController::addComment($_GET['id'], $_SESSION['id'], $_POST['comment']);
     }else{
       echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Tous les champs ne sont pas remplis !<br><br><a </p><a href="index.php?action=listChapitres">Retour aux Chapitres</a></p>';
      }
    }else{
     echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Aucun identifiant de chapitre envoyé !<br><br><a </p><a href="index.php?action=listChapitres">Retour aux Chapitres</a></p>';
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
       echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Vous n\'avez pas saisi de texte !</p>';
       require('view/backend/writingAdmin.php');
 
       }             
     }
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

  /* Affiche la page d'accueil */ 
}else{ 
  FrontendController::pageAccueil(); //si aucune action, alors affiche la page d'accueil
}

