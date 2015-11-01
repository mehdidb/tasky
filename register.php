<?php
	session_start();
	/**
	Connection à la base de données à MODIFIER !!!!!!!
	*/
	try
	{
		$db = new PDO('mysql:host=br-cdbr-azure-south-a.cloudapp.net;dbname=laposte;charset=utf8', 'ba01ebbeda3449', '0db11376');
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

	//$reqT = $db->prepare('SELECT LAST(idF) FROM file WHERE idC=?');
	//$reqT->execute(array($_SESSION['idC']));
	//$donneesT = $reqT->fetch();
	$last_id = $req->insert_id;
	
	$_SESSION['ticketiD'] = $last_id;
	echo $_SESSION['ticketiD'];
	echo "Ticket : " . $_SESSION['nom'] . "_" . $_SESSION['prenom'] . "_";
	
	//header('Refresh: 3; url=index.html');
?>
