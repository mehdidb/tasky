<!DOCTYPE html>
<html>
    <head>
        <title>Réserver une place</title>
        <meta charset="utf-8" />
    </head>
<?php
	session_start();
	if (!isset($_SESSION['idC']))
	{
	    $_SESSION['idC'] = rand(1, 100);
		$_SESSION['nom'] = "foulen";
		$_SESSION['prenom'] = "ben foulen";
	}
	
	if (!(isset($_GET['guichet']) AND isset($_GET['region'])))
	{
		header('Location: erreur.html');
	}
	
	// Connection BDD à MODIFIER !!!!!
	try
	{
		$db = new PDO('mysql:host=br-cdbr-azure-south-a.cloudapp.net;dbname=laposte;charset=utf8', 'ba01ebbeda3449', '0db11376');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	$reqG = $db->prepare('SELECT idP FROM poste WHERE region=?');
	$reqG->execute(array($_GET['region']));
	$donneesG = $reqG->fetch();
	
	$_SESSION['idG'] = $_GET['guichet'];
	$_SESSION['idP'] = $donneesG['idP'];

	function gensAvant()
	{
		global $db;
		$reqA = $db->prepare('SELECT count(*) FROM file WHERE actif=1 AND idG=? AND idP=?');
		$reqA->execute(array($_SESSION['idG'], $_SESSION['idP']));
		$donneesA = $reqA->fetch();
		echo $donneesA['count(*)'];
	}
	
	function tempRest()
	{
		global $db;
		$temps = 5;
		echo gensAvant() * $temps;
	}
?>
    <body>
        <h2 style="color:red;">Réserver une place</h2>
		
		<h3 style="color:blue;">Nom : <span><?php echo $_SESSION['nom'];?></span></h3>
		<h3 style="color:blue;">Prenom : <span><?php echo $_SESSION['prenom'];?></span></h3>
		<h3 style="color:blue;">Nombre de gens avant : <span><?php echo gensAvant();?></span></h3>
        	<h3 style="color:blue;">Temps d'attente estimé : <span><?php echo tempRest();?></span> minutes</h3>
		<?php
if (isset($_SESSION['ticketiD']))
{
    echo "<h3 style=\"color:blue;\"> Ticket info : " . $_SESSION['nom'] . "_" . $_SESSION['prenom'] . "_" . $_SESSION['ticketiD'] . "</h3>";
}
else
{
	echo '<p>
			<form action="register.php" method="post">
				<input type="submit" name="button" value="Prendre un ticket" />
			</form>
		</p>';
}
?>
    </body>
</html>
