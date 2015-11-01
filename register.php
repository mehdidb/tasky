<?php
	session_start();
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
	
	$req = $db->prepare("INSERT INTO file(idC, idG, idP, temps_entre, temps_sortie, actif) VALUES(:idc, :idg, :idp, :temp_entre, :temps_sortie, 1)");
	$req->execute(array(
	'idc' => $_SESSION['idC'],
	'idg' => $_SESSION['idG'],
	'idp' => $_SESSION['idP'],
	'temp_entre' => date("Y-m-d"),
	'temps_sortie' => date("Y-m-d")
	));

echo 	date("Y-m-d");
	
	//header('Location: index.html');
?>