<?php 
/* --- CONTROLLER BACKEND --- */


require_once('model/PostManager.php');// chargement classes
require_once('model/CommentManager.php');
require_once('model/MembersManager.php');

class BackendController {


/* Connexion gestion Admin affiche page writing*/ 
    static function adminViewConnect() {
        require('view/backend/writingAdmin.php');
    }


/* -- CHAPITRE -- */

/* Récupération chapitre admin par id */
    static function postAdmin() { 	
        $postManager = new PostManager();
        $chapy = $postManager->getPostIdBdd($_GET['id']);
        require('view/backend/postAdmin.php');
    }

 /* Affichage de la liste des chapitres "Admin" */
    static function listPostViewAdmin()     {
        $postManager = new PostManager();
        $posts = $postManager->getPostsAdminBdd();
        require('view/backend/listPostViewAdmin.php');
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
    
        if($chapOk === false) {
            die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Erreur...Impossible de modifier ce chapitre!</p>');
            require('view/backend/postAdmin.php');
        }else{
            header('Location: index.php?action=listPostViewAdmin');
        }
    }

 /* Supprime un chapitre */
    static function delPost($dataId) {
        $supprime = new PostManager();
        $deletedPost = $supprime->delPostBdd($dataId);

        if($deletedPost === false) {
            die('<p style= "color: red; text-align: center; font-size: 50px; margin: 90px;">Impossible de supprimer ce chapitre !</p>');
            require('view/backend/postAdmin.php');
        }else{
            header('Location: index.php?action=listPostViewAdmin');
        }
    }












































}