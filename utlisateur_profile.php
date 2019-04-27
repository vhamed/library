<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="css/style_login.css" rel="stylesheet">
    <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
  <script src="js/prefixfree.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
	
	<?php  	session_start();
			if(isset($_SESSION["nom"]) && $_SESSION["nom"]=="utilisateur")
				{
				include("connexionSQL.php");
				if(isset($_GET["not"]))
				{
				$reqNot = "UPDATE `prets` SET `notification`=0 WHERE `Lecteur_id`='".$_SESSION["id"]."'";
				$resNot = mysqli_query($connexion, $reqNot);	if (!$resNot)     die('Could not query resNot:' . mysql_error());
				}
				$req = "SELECT count(*) FROM `prets` WHERE `Lecteur_id`='".$_SESSION["id"]."' AND `notification`=1";
				$res = mysqli_query($connexion, $req);	 if (!$res)     die('Could not query:' . mysql_error());
				$rowNot = mysqli_fetch_array($res, MYSQLI_ASSOC);
				if ( $rowNot["count(*)"]>0 ) $notif=$rowNot["count(*)"]; else $notif=""; ?>	
<body class="background_livre">
<header>

	 <nav class="navbar navbar-default navbar-fixed-top menu "  role="navigation">
	 
    <div class="container">
      <div class="navbar-header">
  
        <a class="navbar-brand" href="index.php"><h1> Bibliothèque <span class="subhead">LIBRARY</span> </h1></a>
      </div>
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
          <li ><a href="index.php">Home</a></li>
		  <li><a href="index.php#services">recherche livres</a></li>

		<li class="dropdown active">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Espace utilisateur <span class="badge"><?php echo $notif; ?></span><span class="caret"></span></a>
		  <ol class="dropdown-menu" role="menu">
			<li><a href="utlisateur_profile.php" class="active">Profile <span class="badge"><?php echo $notif; ?></span></a></li>
			<li class="divider"></li>
			<li><a href="utlisateur_historique.php">Historique</a></li>
		  </ol>
		</li>
          <?php  if(isset($_SESSION["nom"])) { ?> <li><a href="logout.php">Logout</a></li> <?php } else { ?> <li><a href="login.php">Login</a></li> <?php } ?> 
        </ul>        
      </div>
    </div>
  </nav>
</header>

<?php 
	$req = "SELECT * FROM `lecteurs` WHERE user_id='".$_SESSION["id"]."'";
	$res = mysqli_query($connexion, $req);	 if (!$res)     die('Could not query:' . mysql_error());
	$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
	
	$reqPrets = "SELECT count(*) FROM `prets` where `Lecteur_id`='".$_SESSION["id"]."' AND Date_retour=0000-00-00";
	$resPrets = mysqli_query($connexion, $reqPrets);	if (!$resPrets)     die('Could not query:' . mysql_error());
	$row2 = mysqli_fetch_array($resPrets, MYSQLI_ASSOC);
	
	$reqLimit = "SELECT * FROM `parametres`";
	$resLimit = mysqli_query($connexion, $reqLimit);	if (!$resLimit)     die('Could not query Limit:' . mysql_error());
	$row3 = mysqli_fetch_array($resLimit, MYSQLI_ASSOC);
?>
<div class="container">
<div class="row">
  <div class=" col-md-offset-3 ">
  
   

    <div class="row">
        <div class="col-sm-7">
		<?php 	
				if ( $rowNot["count(*)"]>0 )
				{
				  ?> <div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Notice!</strong> Vous avez <b><?php echo $rowNot["count(*)"]; ?></b> prêts avec date dépassé qu'il faut les retourner aussi tôt que possible. 
				  <form role="form" action="utlisateur_profile.php" method="GET">
				  <button class="btn btn-danger btn-xs" type="submit" data-dismiss="modal"  name="not" value="hide">caché definitivement</button>
				  <form>
				  </div><?php
				}
						?>
			
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center">Profile ID <?php echo $row["user_id"]; ?><span class="glyphicon glyphicon-user pull-right"></span></h4>
                </div>
                <div class="panel-body text-center">
                    <p class="lead">
                        <strong><?php echo $row["nom"]." ".$row["prenom"]; ?></strong>
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    <li style="color:blue;"  class="list-group-item liitem">N° de la carte
                        <span style="color:black;"  class="pull-right"><?php echo $row["num_carte"]; ?></span>
                    </li>
                    <li style="color:blue;"  class="list-group-item liitem">EMAIL
                        <span style="color:black;"  class="pull-right" style="display: inline-block;"><?php echo $row["email"]; ?> <form action="utlisateur_profile.php" method="GET" style="display: inline-block;"><button type="submit" name="modmail"  data-tooltip="left" title="Modifier email"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> </form> </span>
                    </li>
					
                    <li style="color:blue;"  class="list-group-item liitem">PASSWORD
                        <span style="color:black;"  class="pull-right" style="display: inline-block;"> ******   <form action="utlisateur_profile.php" method="GET" style="display: inline-block;"><button type="submit" name="modpass"  data-tooltip="left" title="Modifier mot de pass"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> </form> </span> 
                    </li>
                    <li style="color:blue;"  class="list-group-item liitem">Spécialité
                       <span style="color:black;"  class="pull-right"><?php echo $row["specialite"]; ?></span>
                    </li>
					<li style="color:blue;"  class="list-group-item liitem">Année d'étude
                       <span style="color:black;"  class="pull-right"><?php echo $row["annee_etude"]; ?></span>
                    </li>
					<li style="color:blue;"  class="list-group-item liitem">STATUS
						<?php if($row["status"]==1) 
								{ ?><span class='pull-right label label-info label-mini'>Peut prêter</span><?php  }
							else 
								{ ?><span class='pull-right label label-danger label-mini'>Ne peut pas prêter</span><?php  }
						?>
                    </li>
					<li style="color:blue;"  class="list-group-item liitem">Prêt non retourner
                       <span style="color:black;"  class="pull-right"><?php echo $row2["count(*)"]."/".$row3["limit_prets"]; ?></span>
                    </li>
                </ul>
            </div>
			
        </div>
		</br></br>
		

<?php if(isset($_GET["modpass"]) or isset($_POST["pass1"])) { ?>
        <form role="form" action="utlisateur_profile.php" method="POST" name="pass">
            
                </br></br>
                <div class="form-group">
                    <label for="InputName">Ancient motdepass</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="pass1" id="InputName" placeholder="Enter Name" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass">Nouveau motdepass</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="InputEmailFirst" name="pass2" placeholder="Enter Email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass">Confirm motdepass</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="InputEmailSecond" name="pass3" placeholder="Confirm Email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>
		<?php 
		if(isset($_POST["pass1"]) ) { 
				if($row["pass"] == $_POST["pass1"] and $_POST["pass2"]==$_POST["pass3"])
				{
				$reqCha = "UPDATE `lecteurs` SET `pass`='".$_POST["pass2"]."' WHERE user_id='".$_SESSION["id"]."'";
				$resReq = mysqli_query($connexion, $reqCha);	if (!$resReq)     die('Could not query:' . mysql_error());
				?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp mot de pass changer!</div></center>
				<script type="text/javascript">setTimeout('window.location.replace("utlisateur_profile.php")', 3000);</script>
				<?php
				}
				else
				{
				?></br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veuillez vérifier vos champs!</div></center> <?php
				}
			

			}
} ?> 
<?php if(isset($_GET["modmail"]) or isset($_POST["mail"])) { ?>
        <form role="form" action="utlisateur_profile.php" method="POST">
            
                </br></br>
                <div class="form-group">
                    <label for="pass">Nouveau E-mail</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="InputEmailFirst" name="mail" placeholder="Enter Email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>
		<?php 
		if(isset($_POST["mail"]) ) { 

				$reqCha = "UPDATE `lecteurs` SET `email`='".$_POST["mail"]."' WHERE user_id='".$_SESSION["id"]."'";
				$resReq = mysqli_query($connexion, $reqCha);	if (!$resReq)     die('</br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp email existe!</div></center>' . mysql_error());
				?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp email changer!</div></center>
				<script type="text/javascript">setTimeout('window.location.replace("utlisateur_profile.php")', 3000);</script>
				<?php
			}
}


 ?> 
    </div>
</div>

<?php 
	}
	else
		{
		?></br></br></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Accés non autorisé </div></center><?php
		header( "refresh:0;url=index.php" );
		}
	?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/myscript.js"></script>
</body>
</html>