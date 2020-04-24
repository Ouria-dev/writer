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







































}