<?php
require_once("model/Manager.php");

class CommentManager extends Manager {

/* Insertion des commentaires dans la table comments */
	public function addCommentBdd($idBillet, $idUser, $comment)	{
		$db = $this->dbConnect();
		$comments = $db->prepare('INSERT INTO comments(id_billet, id_user, comment, comment_date) VALUES( ?, ?, ?, NOW())');
		$addComment = $comments->execute(array($idBillet, $idUser, $comment));

		return $addComment;
	}

/* Récupération des commentaires et du pseudo de l'user dans la Bdd */
	public function getCommentsBdd($idBillet) {
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT comments.id, users.pseudo, comments.comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments INNER JOIN users ON comments.id_user = users.id WHERE id_billet = ? ORDER BY comment_date DESC');
		$comments->execute(array($idBillet));

		return $comments;
	}

/* Récupération de tout les commentaires dans la Bdd*/
	public function allGetCommentsBdd() {
		$db = $this->dbConnect();
		$allcomments = $db->prepare('SELECT id, id_billet, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY comment_date DESC');
		$allcomments->execute(array());

		return $allcomments;
	}

/* Récupération des commentaires signalés dans la Bdd */
	public function getCommentReportsBdd($signalement) {
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, comment, signalement, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE signalement = 1 ORDER BY comment_date DESC');
		$comments->execute(array($signalement));
		
		return $comments;
	}

/* Requete pour signaler un commentaire */
	public function reportsBdd($commentId) {
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET signalement = 1 WHERE id = ?');
		$req->execute(array($commentId));

		return $req;
	}

/* Supprime un commentaire dans la Bdd */
	public function delCommentBdd($commentId) {
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comments WHERE id = ?');
		$req->execute(array($commentId));
		
		return $req;
	}

/* Supprime le signalement du commentaire dans la Bdd */
	public function delReportsBdd($commentId) {
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET signalement = 0 WHERE id = ?');
		$req->execute(array($commentId));

		return $req;
	}
	
}