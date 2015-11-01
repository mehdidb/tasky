<?php
	/**
	Connection à la base de données à MODIFIER !!!!!!!
	*/
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=laposte;charset=utf8', 'root', '');
		
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	$req = $db->prepare('SELECT idC, nom, prenom FROM client WHERE login=? AND password=?');
	$req->execute(array($_GET['login'], $_GET['password']));
	$donnees = $req->fetch();
	
	if(mysql_num_rows($result))
	{
		// Authentification réussi
		session_start();
		$_SESSION['idC'] = $donnees['idC'];
		$_SESSION['nom'] = $donnees['nom'];
		$_SESSION['prenom'] = $donnees['prenom'];
		header('Location: index.php');
	}
	else
	{
		header('Location: erreur.html');
	}
?>
