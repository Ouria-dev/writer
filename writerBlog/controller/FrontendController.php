<?php 
/* --- CONTROLLER FRONTEND --- */
//chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MembersManager.php');


class FrontendController {


/* Affichage page d'accueil */
	static function pageAccueil() {
		require('view/frontend/accueilView.php');//chargement de la page qui affichera la page d'accueil
	}

/* affichage formulaire connexion */
	static function displayConnexion() {
		require('view/frontend/connectView.php');
	}

/* affichage formulaire d'inscription */
	static function displayContact() {
		require('view/frontend/inscriptionView.php');
	}

/* Affiche les chapitres */ 
	static function listChapitres()	{
		$postManager = new PostManager();
		$posts = $postManager->getPostsBdd();//appel la fonction de récupération de tous les chapitres rangés en ordre de date descendante de cet objet
		require('view/frontend/listPostsView.php');
	}

/* Connexion */
	static function connexion($pseudo,$motdepass) {
		$membre = new MembersManager();
		$connect = $membre->getConnect($pseudo);
		$isPasswordCorrect = password_verify($_POST['mdp'], $connect['motdepasse']);

		if (!$connect)
		{
			echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Mauvais identifiant ou mot de passe !</p>';
			require('view/frontend/connectView.php');
			
		}else{

			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $connect['id'];
				$_SESSION['pseudo'] = $pseudo;
				$_SESSION['droits'] = $connect['droits'];
				header("Location: index.php");

			}else{
				echo '<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Mauvais identifiant ou mot de passe !</p>';
				require('view/frontend/connectView.php');
			}
			if(!empty($_SESSION['droits']) && $_SESSION['droits'] == '1') 
				header("Location: index.php");
		}
	}

/* Déconnexion */
	static function deconnexion() {
		session_start();
		$_SESSION = array();
		session_destroy();
		header("Location: index.php"); 
	}

/* Ajout de membre */
	static function addMember($pseudo, $mail, $mdp) {
		$membre = new MembersManager();
		$test = new MembersManager();
		$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
		$testOk = $test->emailtestBdd($mail);

		if($testOk == 0) {
			$newMembre = $membre->insertMemberBdd($pseudo, $mail, $mdp);
			header("Location: ../index.php?action=displayConnexion");
		}else{ 
			echo '<p style= "border: 1px solid red; text-align: center; font-size: 55px; margin: 90px 90px 90px;">Adresse email déjà utilisé  !</p>';
			require('view/frontend/inscriptionView.php');
		}
	}

/* Récupère la liste de tous les articles pour affichage */    
    static function listPosts() {
	    $postManager = new PostManager();//création objet
		$posts = $postManager->getPostsBdd();//appel la fonction de récupération de tous les chapitres décroissant
	    require('view/frontend/listPostsView.php'); 
    }

/* Récupération d'un chapitre et de ses commentaires */	
	static function post() { 	
		$postManager = new PostManager();
		$commentManager = new CommentManager();
		$post = $postManager->getPostBdd($_GET['id']);
		$comments = $commentManager->getCommentsBdd($_GET['id']);
		require('view/frontend/postView.php');
	}

/* Ajout d'un commentaire */
	static function addComment($idBillet, $idUser, $comment) {
		$commentManager = new CommentManager();
		$affectedLines = $commentManager->addCommentBdd($idBillet, $_SESSION['id'], $comment);
	
		if ($affectedLines === false){ //si le commentaire n'arrive pas à la bdd on arrête le script avec un die
			die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Impossible d\'ajouter le commentaire !</p>');
		}else{
			header('Location: index.php?action=post&id=' . $idBillet);
		}
	}	

/* Signale un commentaire */
	static function signal($commentId) {
		$commentManager = new CommentManager();
		$signal = $commentManager->reportsBdd($commentId);

		if($signal === false) {
			die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur. Impossible de signaler ce commentaire !</p>');
		}else{ 
			header('Location: index.php?action=listChapitres');
		}
	}
//end
}