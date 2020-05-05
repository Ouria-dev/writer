<?php
require_once("model/Manager.php");

class PostManager extends Manager {


/* Ajoute chapitre à la BDD */
public function addPostBdd($title, $content) {
	$db = $this->dbConnect();
	$insertPost = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES (?, ?, NOW())');
	$chapitre = $insertPost->execute(array($title, $content));
	
	return $chapitre;
}

/* Modif chapitre dans la BDD */
	public function updatePostBdd($title, $content, $postId) {
		$db = $this->dbConnect();
		$editPost = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
		$chapitreEdit = $editPost->execute(array($title, $content, $postId));
		
		return $chapitreEdit;
	}

/* Supprime un chapitre et ses commentaires dans la BDD */
	public function delPostBdd($dataId)	{ 
        $db = $this->dbConnect();
        $comment = $db->prepare('DELETE FROM comments WHERE id_billet = ?');
        $comment->execute([$dataId]);
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
		$req->execute(array($dataId));
		
       	return $req;
	}

/* Récupération de tous les chapitres par ordre décroissant "users" */	
	public function getPostsBdd() {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 30');
		$req->execute(array());
		return $req;
	}

/* Récupération chapitre par id */
	public function getPostBdd($postId)	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
		$req->execute(array($postId));
		$post = $req->fetch();

		return $post;
	}

/* Récupération de tous les chapitres par ordre décroissant "Admin" */
	public function getPostsAdminBdd() {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 10');
		$req->execute(array());
		return $req;
	}


/* Récupération chapitre par id "Admin" */
    public function getPostIdBdd($postId) {
    	$db = $this->dbConnect();
    	$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
		$req->execute(array($postId));
	
    	return $req;
	}

}