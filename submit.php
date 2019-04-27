<?php
// Error reporting:
error_reporting(E_ALL^E_NOTICE);

// This is the URL your users are redirected,
// when registered succesfully:

$redirectURL = 'lecteur.php';

$errors = array();

// Checking the input data and adding potential errors to the $errors array:
if(!$_POST['Ncarte'] || strlen($_POST['Ncarte'])<1 || strlen($_POST['Ncarte'])>50 || !preg_match("/[0-9]/", $_POST['Ncarte']))
{
	$errors['Ncarte']='Please fill in a valid Ncarte!<br />Must be between 3 and 50 characters.';
}
if(!$_POST['nom'] || strlen($_POST['nom'])<3 || strlen($_POST['nom'])>50)
{
	$errors['nom']='Please fill in a valid nom!<br />Must be between 3 and 50 characters.';
}
if(!$_POST['prenom'] || strlen($_POST['prenom'])<3 || strlen($_POST['prenom'])>50)
{
	$errors['prenom']='Please fill in a valid prenom!<br />Must be between 3 and 50 characters.';
}
if(!$_POST['pass'] || strlen($_POST['pass'])<5)
{
	$errors['pass']='Please fill in a valid password!<br />Must be at least 5 characters long.';
}
if(!$_POST['spec'] || strlen($_POST['spec'])<2 || strlen($_POST['spec'])>50 )
{
	$errors['spec']='Please fill in a valid spécialité!<br />Must be between 3 and 50 characters.';
}

if(!$_POST['email'] || !preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['email']))
{
	$errors['email']='Please fill in a valid email!';
}
// Checking whether the request was sent via AJAX
// (we manually send the fromAjax var with the AJAX request):

if($_POST['fromAjax'])
{
	if(count($errors))
	{
		$errString = array();
		foreach($errors as $k=>$v)
		{
			// The name of the field that caused the error, and the
			// error text are grouped as key/value pair for the JSON response:
			$errString[]='"'.$k.'":"'.$v.'"';
		}
		
		// JSON error response:
		die	('{"status":0,'.join(',',$errString).'}');
	}
	else
	{
		include("connexionSQL.php");
		$annee= date("Y",strtotime("-1 year"))."/".date("Y");
		$reqAj = "INSERT INTO `bibliotheque`.`lecteurs` (`num_carte`, `nom`, `prenom`, `pass`, `specialite`, `annee_etude`, `email`) VALUES ('".$_POST["Ncarte"]."','".$_POST["nom"]."','".$_POST["prenom"]."','".$_POST["pass"]."','".$_POST["spec"]."','".$annee."','".$_POST["email"]."')";
		$resReq = mysqli_query($connexion, $reqAj);	
		if (!$resReq)     die('Could not query:' . mysql_error());
	// JSON success response. Returns the redirect URL:
	echo '{"status":1,"redirectURL":"'.$redirectURL.'"}';

	exit;
	}
}

// If the request was not sent via AJAX (probably JavaScript
// has been disabled in the visitors' browser):

if(count($errors))
{
	echo '<h2>'.join('<br /><br />',$errors).'</h2>';
	exit;
}

// Directly redirecting the visitor:

header("Location: ".$redirectURL);
?>