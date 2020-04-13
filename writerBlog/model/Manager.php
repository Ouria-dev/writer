<?php
class Manager
{
	protected function dbConnect()// méthode de connexion à la bdd
	{
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=pj4openclass;charset=utf8', 'root', '');
			return $db;
		}
		catch (Exception $e)
		{
			die('Erreur : ' .$e->getMessage());
		}
	}
}