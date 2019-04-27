<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Installation de la bibliothéque</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style_login.css">  
</head>

<body class="background_dashboard">
	
	<div class="col-md-6 col-md-offset-3">
	<center><h1 class="page-header">Installation de la bibliothéque</h1></center>
	<form action="Installation.php" method="POST" class="form-horizontal" >
	<div class="datagrid">
	<table>
		<thead><tr><th colspan="2">Information</th></tr></thead>
		<tr><td colspan="2">Ce application permet d'installer et de configurer la page de l'administrateur dans ce serveur, veuillez remplir les champs necessaire correctement puis valider.</td></tr>
		
		<thead><tr><th colspan="2">Page de l'administrateur</th></tr></thead>
		<tr><td>Nom:</td><td><input type="text" value="<?php if(isset($_POST["admin_name"])) echo $_POST["admin_name"]; else echo "admin";?>" name="admin_name"></td></tr>
		<tr><td>Mot de passe:</td><td><input type="text" value="<?php if(isset($_POST["admin_pass"])) echo $_POST["admin_pass"]; else echo "admin";?>" name="admin_pass"></td></tr>
		
		<thead><tr><th colspan="2">Serveur MYSQL</th></tr></thead>
		<tr><td>Adresse du serveur:</td><td><input type="text" value="<?php if(isset($_POST["host"])) echo $_POST["host"]; else echo "localhost";?>" name="host"></td></tr>
		<tr><td>Nom de la BDD:</td><td><input type="text" value="<?php if(isset($_POST["db_name"])) echo $_POST["db_name"]; else echo "bibliotheque";?>" name="db_name"></td></tr>
		<tr><td>Nom utilisateur de la BDD:</td><td><input type="text" value="<?php if(isset($_POST["db_user"])) echo $_POST["db_user"]; else echo "root";?>" name="db_user"></td></tr>
		<tr><td>Mot de passe de la BDD:</td><td><input type="text" value="<?php if(isset($_POST["db_pass"])) echo $_POST["db_pass"]; else echo "";?>" name="db_pass"></td></tr>
		
		<thead><tr><th colspan="2">Options</th></tr></thead>
		<tr><td>Nombres lignes dans chaque page:</td><td><input type="text" value="<?php if(isset($_POST["nbrLignes"])) echo $_POST["nbrLignes"]; else echo "10";?>" name="nbrLignes"></td></tr>
		<tr><td>nombres des prêts autorisé::</td><td><input type="text" value="<?php if(isset($_POST["limit_prets"])) echo $_POST["limit_prets"]; else echo "2";?>" name="limit_prets"></td></tr>

	</table>
	</div> 
	</br>
	<center><button type="submit" class="btn btn-primary btn-lg " name="envoi">Valider</button></center>
	</form>
<?php
if( isset($_POST["envoi"]) )
	
{
	if($_POST["admin_name"]=="" or $_POST["admin_pass"]=="" or $_POST["db_user"]=="" or $_POST["db_name"]=="" or $_POST["host"]=="" or $_POST["nbrLignes"]=="" or $_POST["nbrLignes"]<1 or $_POST["limit_prets"]=="" or $_POST["limit_prets"]<1)
	{
	?></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veuillez vérifier vos champs!</div></center><?php
	}
	else
	$myfile = fopen("connexionSQL.php", "w") or die("impossible d'ouvrire le fichier!");
	{
	$txt = '<?php
	$connexion=mysqli_connect("'.$_POST["host"].'","'.$_POST["db_user"].'","'.$_POST["db_pass"].'","'.$_POST["db_name"].'"); if (!$connexion) { die("Connection a la base de donnés impossible: " . mysqli_connect_error()); }
	?>
	';
	fwrite($myfile, $txt);
	fclose($myfile);
	$connexion=mysqli_connect("{$_POST["host"]}","{$_POST["db_user"]}","{$_POST["db_pass"]}"); if (!$connexion) { die("Connection a la base de donnés impossible: " . mysqli_connect_error()); }
	if (!mysqli_query($connexion, "CREATE DATABASE IF NOT EXISTS {$_POST["db_name"]}"))  die('erreur creation BDD:' . mysql_error());
	if ($_POST["db_pass"]=="")
		{ exec("c:/xampp/mysql/bin/mysql -h {$_POST["host"]} -u '{$_POST["db_user"]}'  {$_POST["db_name"]} < BDD.sql"); }
	else
		{ exec("c:/xampp/mysql/bin/mysql -h {$_POST["host"]} -u '{$_POST["db_user"]}'  -p\"{$_POST["db_pass"]}\" {$_POST["db_name"]} < BDD.sql"); }
	

	include("connexionSQL.php");
	$reqEvent = "SET GLOBAL event_scheduler=ON ";
	$resReq = mysqli_query($connexion, $reqEvent);	if (!$resReq)     die('Could not query reqEvent:' . mysql_error());
		
	$reqAjAdmin = "INSERT INTO `administrateur`(`admin_nom`, `admin_pass`) VALUES ('{$_POST["admin_name"]}','{$_POST["admin_pass"]}')";
	$resReq = mysqli_query($connexion, $reqAjAdmin);	if (!$resReq)     die('Could not query reqAjAdmin:' . mysql_error());
	
	$reqAjPar = "INSERT INTO `parametres`(`nbrlignes`, `limit_prets`) VALUES ('{$_POST["nbrLignes"]}','{$_POST["limit_prets"]}')";
	$resReq = mysqli_query($connexion, $reqAjPar);	if (!$resReq)     die('Could not query reqAjPar:' . mysql_error());
	

	?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Installation avec succés</div></center><?php 
	?><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Pour votre sécurité il faut supprimer ce fichier! <form action="login.php" method="GET"><button type="submit" class="btn btn-danger btn-sm " name="sup">Supprimer</button><form></div></center><?php


	
	}
}




?> 

</body>
</html>