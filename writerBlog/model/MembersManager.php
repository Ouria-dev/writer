<?php
require_once("model/Manager.php");

class MembersManager extends Manager
{

/*récupère les information relative à la connexion de l'user dans la bdd*/
	public function getConnect($pseudo)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, motdepasse, droits FROM users WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' =>$pseudo));
		$connect = $req->fetch();
		return $connect;
	}

/*insertion nouveau membre dans la bdd*/	
	public function insertMemberBdd($pseudo, $mail, $mdp)
	{
		$db = $this->dbConnect();
		$insertmbr = $db->prepare("INSERT INTO users(pseudo, mail, motdepasse, droits) VALUES(?, ?, ?, 0)");
        $insertmbr->execute(array($pseudo, $mail, $mdp));
        return $insertmbr;

	}

/*test pour doublon email dans la Bdd*/	
	public function emailtestBdd($mail)
	{
		$db = $this->dbConnect();
		 $req = $db->prepare("SELECT * FROM users WHERE mail = ?");
        $req->execute(array($mail));
        $existEmail = $req->rowCount();
        return $existEmail;
	}

}