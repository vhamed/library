<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/prefixfree.min.js"></script>
  <link href="css/style_login.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
    <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
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
			<li class="active"><a href="prets_liste.php">Prêts</a></li>
					<ul class="nav nav-sidebar sidebar-b">
					<li><a href="prets_liste.php">Liste</a></li>
					<li class="active"><a href="prets_ajout.php">Ajout</a></li>
					</ul>
            <li><a href="parametres.php">Paramètres</a></li>
        </ul>
         
        </div>
	

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		  <h1 class="page-header"><b>Ajout des prêts</b></h1>
		</div>
		<div class="col-md-10 col-md-offset-2 ">
							</br>
			<div class="col-md-offset-3 ">
			<form id="1" action="livres_liste.php" method="GET"></form>
			<form id="2" action="lecteur.php" method="GET" ></form>
			<form id="3" class="navbar-form navbar-left" role="search" action="prets_ajout.php" method="GET"></form>

			<table>
			<tr><td>
				<div class="input-group">
					<span class="input-group-addon">&nbsp&nbsp Livre id: &nbsp</span>
					<input form="3" type="text" class="form-control" placeholder="id" name="id_liv" <?php if( isset( $_GET["id_liv"] ) ) { echo" value=\"".$_GET["id_liv"]."\" " ; } ?>   >
				</div>
			</td>
			<td>
				
					<button form="1" data-tooltip="top" title="Choisir un livre depuis la liste" type="submit" name="ref" value="<?php echo "pret"; ?>"><div class="o"> <span class="glyphicon glyphicon-plus"></span></div> </button>
				
			</td></tr>
			<tr><td></br>
				<div class="input-group">
					<span class="input-group-addon">Lecteur id:</span>
					<input form="3" type="text" class="form-control" placeholder="id" name="id_lec" <?php if( isset( $_GET["id_lec"] ) ) { echo" value=\"".$_GET["id_lec"]."\" " ; } ?>   >
				</div>
			</td>
			<td></br>
				
					<button form="2" data-tooltip="top" title="Choisir un Lecteur depuis la liste" type="submit" name="id_liv" value="<?php echo "222"; ?>"><div class="o"> <span class="glyphicon glyphicon-plus"></span></div> </button>
				
			</td></tr>
			<tr><td></br>			
				<center><button form="3" type="submit" class="btn btn-default">Ajouter</button><center> 
			</td></tr>
			</table>

			
			</div>
		

			<?php 
			if ( isset($_GET["id_lec"]) and  isset($_GET["id_liv"] )  ) 
				{
				if ( $_GET["id_lec"]=="" or $_GET["id_liv"]=="")  { ?></br></br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veuillez remplir les champs vides!</div></center><?php	}
				else {
					include("connexionSQL.php");
					$reqid_liv_existe = "SELECT `livre_exemplaires` FROM `livres` WHERE `livre_id`='{$_GET["id_liv"]}'";
					$resReq = mysqli_query($connexion, $reqid_liv_existe);	if (!$resReq)     die('Could not query:' . mysql_error());
					$row = mysqli_fetch_array($resReq, MYSQLI_ASSOC);
					if( $row["livre_exemplaires"]==0 )
						{ ?></br></br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Ce livre n'a pas d'exemplaires disponible !</div></center><?php }
						else{
						$reqid_lec = "SELECT * FROM `lecteurs` where `user_id`='".$_GET["id_lec"]."'";
						$resReq = mysqli_query($connexion, $reqid_lec);	if (!$resReq)     die('Could not query:' . mysql_error());
						$row = mysqli_fetch_array($resReq, MYSQLI_ASSOC);
						if ( $row > 0 )	{ 
							$reqPrets = "SELECT count(*) FROM `prets` where `Lecteur_id`='".$_GET["id_lec"]."' AND Date_retour=0000-00-00";
							$resPrets = mysqli_query($connexion, $reqPrets);	if (!$resPrets)     die('Could not query:' . mysql_error());
							$row2 = mysqli_fetch_array($resPrets, MYSQLI_ASSOC);
							
							$reqLimit = "SELECT * FROM `parametres`";
							$resLimit = mysqli_query($connexion, $reqLimit);	if (!$resLimit)     die('Could not query Limit:' . mysql_error());
							$row3 = mysqli_fetch_array($resLimit, MYSQLI_ASSOC);
							
							if ($row["status"]==0 or $row2["count(*)"]>=$row3["limit_prets"])
								{	?></br></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Ce lecteur ne peut pas prêter!</div></center><?php	}
							else{
							$reqid_liv = "SELECT * FROM `livres` where `livre_id`='".$_GET["id_liv"]."'";
							$resReq = mysqli_query($connexion, $reqid_liv);	if (!$resReq)     die('Could not query:' . mysql_error());
							$row = mysqli_fetch_array($resReq, MYSQLI_ASSOC);
							if ( $row > 0 )	{
								$date=date("Y-m-d");	
								$reqAj = "INSERT INTO `bibliotheque`.`prets` (`Lecteur_id`,`Livre_id`,`Date_pret`) VALUES ('{$_GET["id_lec"]}','{$_GET["id_liv"]}','{$date}')";
								$resReq = mysqli_query($connexion, $reqAj);	
								if (!$resReq)     die('Could not query:' . mysql_error());
								?></br></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp prêt ajouter avec succés</div></center><?php 
							}
							else {
								?></br></br><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Livre id incorrect ...</div></center><?php
							}
							}
						}
						else {
							?></br></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Lecteur id incorrect ...</div></center><?php
						}
					}
				}
			
			}
			elseif ( isset($_GET["id_lec"]) or  isset($_GET["id_liv"] )  ) 
			{
			?></br></br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veuillez remplir les champs vides!</div></center><?php
			}
			?>
			
			
	<?php }
	else
		{
		?></br></br></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Accés non autorisé </div></center><?php
		header( "refresh:0;url=index.php" );
		}
	if (isset($connexion)) mysqli_close($connexion);
	?>
		
	

</div>
</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/myscript.js"></script>
</body>
</html>
