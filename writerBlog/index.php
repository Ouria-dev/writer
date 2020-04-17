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


}