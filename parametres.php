<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/prefixfree.min.js"></script>
  <link href="css/style_login.css" rel="stylesheet">
   <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
  <link href="css/dashboard.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php  	session_start();
		if(isset($_SESSION["nom"]) && $_SESSION["nom"]=="admin")
			{
	?>

<header>
	
	 <nav class="navbar navbar-default navbar-fixed-top menu "  role="navigation">
	 <a class="main-logo pull-left" href="index.php"></a>
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><h1> Bibliothèque <span class="subhead">LIBRARY</span> </h1></a>
      </div>
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Home</a></li>
		  <li  class="active"><a>dashboard</a></li>
		  <li><a href="logout.php">logout</a></li>
        </ul>        
      </div>
    </div>
  </nav>
 

</header>
<body class="background_livre">

		  

 <div class="container-fluid">
      <div class="row">
        <div class="col-sm-1 col-md-2  sidebar">
          <ul class="nav nav-sidebar sidebar-a" >
            <li><a href="dashboard.php">Aperçu <span class="sr-only">(current)</span></a></li>
            <li><a href="livres_liste.php">Livres</a></li>

            <li><a href="lecteur.php">Lecteurs</a></li>
			<li><a href="prets_liste.php">Prêts</a></li>
            <li class="active"><a href="parametres.php">Paramétres</a></li>
        </ul>
         
        </div>
		
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><b>Paramétres</b></h1>
			<div class="col-sm-offset-1"><h2><b>Changer mot de pass:</b></h2></div><h2 class="sub-header"></h2></br>
			<div class="col-sm-offset-1">
			<form class="form-inline" action="parametres.php" method="POST">
			<div class="form-group">
			<input data-tooltip="top" title="Tapper l'ancien mot de pass" type="text" class="form-control" id="inputPassword2" placeholder="Ancien Mot de pass" name="oldpass">
			<input data-tooltip="top" title="Tapper un nouveau mot de pass" type="password" class="form-control" id="inputPassword2" placeholder="Nouveau Mot de pass" name="pass">
			<input data-tooltip="top" title="Confirmer votre nouveau mot de pass" type="password" class="form-control" id="inputPassword2" placeholder="Confirmer Mot de pass" name="pass2">
			</div>
			<button type="submit" class="btn btn-default">Valider</button>
			</form></div>
			
			<?php 
			include("connexionSQL.php");
			if ( isset($_POST["pass"]) or isset($_POST["pass2"]) or isset($_POST["oldpass"]) )
			{ 
				$reqPass = "SELECT admin_pass FROM `administrateur`";
				$resPass = mysqli_query($connexion, $reqPass);	
				if (!$resPass)     die('Could not query:' . mysql_error());
				$row = mysqli_fetch_array($resPass, MYSQLI_ASSOC);
				$oldPass =  $row["admin_pass"];
				if ( $_POST["pass"]=='' or $_POST["pass2"]=='' or $_POST["oldpass"]=='' or $_POST["pass"]<>$_POST["pass2"]or $_POST["oldpass"]<>$oldPass) 
				{
				?></br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veuillez vérifier vos champs!</div></center> <?php
				}
			  else{
				$reqCha = "UPDATE `administrateur` SET `admin_pass`='".$_POST["pass"]."'";
				$resReq = mysqli_query($connexion, $reqCha);	if (!$resReq)     die('Could not query:' . mysql_error());
				?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp mot de pass changer!</div></center><?php
				}
			}
			$reqNbrLignes = "SELECT * FROM `parametres`";
			$resReqNbr = mysqli_query($connexion, $reqNbrLignes);	
			if (!$resReqNbr)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
			$row["nbrlignes"];
			?>
			</br><div class="col-sm-offset-1"><h2><b>Changer Nombres lignes par page:</b></h2></div><h2 class="sub-header"></h2></br>
			<div class="col-sm-offset-1"><form class="form-inline" action="parametres.php" method="POST">
			<div class="form-group">
			<label for="inputPassword2" class="sr-only">Nbr</label>
			<input data-tooltip="top" title="Tapper le nombre de lignes du tableau des listes" size="4" type="test" class="form-control" id="inputPassword2" placeholder="<?php echo $row["nbrlignes"];?>" name="Nbr">
			</div>
			<button type="submit" class="btn btn-default">Valider</button>
			</form></div>
			<?php 
			if ( isset($_POST["Nbr"]) )
				{
				if ( $_POST["Nbr"]=='' or $_POST["Nbr"]<=0 or !is_numeric($_POST["Nbr"]) )
					{
					?></br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veiller vérifier vos champs!</div></center> <?php
					}
				else 
					{
					
					$reqChaNbr = "UPDATE `parametres` SET `nbrlignes`='".$_POST["Nbr"]."'";
					$resReq = mysqli_query($connexion, $reqChaNbr);	if (!$resReq)     die('Could not query:' . mysql_error());
					?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp nombre lignes changer!</div></center><?php
					}
				}
				?>
			</br><div class="col-sm-offset-1"><h2><b>Changer nombres des prêts autorisé:</b></h2></div><h2 class="sub-header"></h2></br>
			<div class="col-sm-offset-1"><form class="form-inline" action="parametres.php" method="POST">
			<div class="form-group">
			<label for="inputPassword2" class="sr-only">Nbr</label>
			<input data-tooltip="top" title="Tapper le nombre max des prêts autorisé pour chaque lecteur" size="4" type="test" class="form-control" id="inputPassword2" placeholder="<?php echo $row["limit_prets"];?>" name="limit">
			</div>
			<button type="submit" class="btn btn-default">Valider</button>
			</form></div>
			<?php 
			if ( isset($_POST["limit"]) )
				{
				if ( $_POST["limit"]=='' or $_POST["limit"]<=0 or !is_numeric($_POST["limit"]) )
					{
					?></br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veiller vérifier vos champs!</div></center> <?php
					}
				else 
					{
					
					$reqChaNbr = "UPDATE `parametres` SET `limit_prets`='".$_POST["limit"]."'";
					$resReq = mysqli_query($connexion, $reqChaNbr);	if (!$resReq)     die('Could not query:' . mysql_error());
					?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp nombres des prêts autorisé changer!</div></center><?php
					}
				}
				?>
			
		</div>
		
		
	<?php 
	}
	else
		{
		?></br></br></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Accés non autorisé </div></center><?php
		header( "refresh:0;url=index.php" );
		}
	?>
		</div>
	</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/myscript.js"></script>
</body>
</html>
