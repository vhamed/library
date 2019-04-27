<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style_login.css">
    <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
  <script src="js/prefixfree.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="background_login">

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
		  <li><a href="index.php#services">recherche livres</a></li>
          <?php  session_start(); if(isset($_SESSION["nom"])) { ?> <li><a href="logout.php">Logout</a></li> <?php } else { ?> <li class="active"><a href="login.php">Login</a></li> <?php } ?> 
		 

        </ul>        
      </div>
    </div>
  </nav>
 


</header>
<?php
if (isset($_SESSION["nom"]))
	{ 
	?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp vous étes déja connecter !</div></center><?php
	header( "refresh:0;url=index.php" );
	}
	else
	{
	?>

	
<form action="login.php" method="POST" class="form-horizontal" >
  <div class="form-group">
    <label for="inputName3" class="col-sm-5 control-label">Name</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="inputName3" placeholder="Name" name="nom" <?php if ( isset($_POST["nom"])) echo"value=\"{$_POST["nom"]}\"";?>>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">Password</label>
    <div class="col-sm-3">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pass">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-5">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-5">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>
<?php 
if (isset($_GET["sup"]))
{
   $file = "Installation.php";
   if (file_exists($file)) {
		  unlink($file);
		  ?></br></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Fichier d'installation supprimer avec succés</div></center><?php 
		  header( "refresh:2;url=login.php" );
    } else {
		?></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Fichier d'installation n'existe pas!</div></center><?php
		header( "refresh:2;url=login.php" );
	}
	
}
?>
	<?php 

		if ( isset($_POST["pass"]) and isset($_POST["nom"]))
		{
			if ( $_POST["pass"]=='' or $_POST["nom"]=='')
			{?></br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veuillez remplir les champs vides!</div></center> <?php } 
			elseif ($_POST["nom"]=='admin')
			{
			include("connexionSQL.php");
			$reqPass = "SELECT admin_pass FROM `Administrateur` WHERE `admin_pass`='{$_POST["pass"]}'";
			$resReq = mysqli_query($connexion, $reqPass);	if (!$resReq)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($resReq, MYSQLI_ASSOC);
			if ( mysqli_num_rows($resReq) > 0 && $_POST["pass"]=== $row["admin_pass"])	{ 
				?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp connexion avec succés</div></center><?php
			$_SESSION["nom"]=$_POST["nom"];
			header( "refresh:1;url=dashboard.php" );
				
				}
			else 
				{
				?></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp nom ou mot de passe incorrect ...</div></center><?php
				}
			
			mysqli_close($connexion);
			}
			elseif ($_POST["nom"]!='admin')
			{
			include("connexionSQL.php");
			$reqId = "SELECT * FROM `lecteurs` WHERE (`user_id`='{$_POST["nom"]}' OR `email`='{$_POST["nom"]}') AND `pass`='{$_POST["pass"]}'";
			$resReq = mysqli_query($connexion, $reqId);	if (!$resReq)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($resReq, MYSQLI_ASSOC);
			if ( mysqli_num_rows($resReq) > 0 and $row["pass"]==$_POST["pass"] )	
				{ 
				?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp connexion avec succés</div></center><?php
				$_SESSION["nom"]="utilisateur";
				$_SESSION["id"]=$row["user_id"];
				header( "refresh:1;url=utlisateur_profile.php" );
				
				}
			else 
				{
				?></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp nom ou mot de passe incorrect ...</div></center><?php
				}
			
			mysqli_close($connexion);

			}
			else 
					{
					?></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp nom ou mot de passe incorrect ...</div></center><?php
					}
		}		
	}
	?>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/myscript.js"></script>
</body>
</html>
