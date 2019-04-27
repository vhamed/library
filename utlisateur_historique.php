<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/style.css">
    <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
  <link href="css/style_login.css" rel="stylesheet">
  <script src="js/prefixfree.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
	
	<?php  	session_start();
			if(isset($_SESSION["nom"]) && $_SESSION["nom"]=="utilisateur")
				{
				include("connexionSQL.php");
				$req = "SELECT count(*) FROM `prets` WHERE `Lecteur_id`='".$_SESSION["id"]."' AND `notification`=1";
				$res = mysqli_query($connexion, $req);	 if (!$res)     die('Could not query:' . mysql_error());
				$rowNot = mysqli_fetch_array($res, MYSQLI_ASSOC);
				if ( $rowNot["count(*)"]>0 ) $notif=$rowNot["count(*)"]; else $notif=""; ?>
		?>
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

<div class="container">
<div class="row">
  <div class=" col-md-offset-0 "></br>
		<div class="col-sm-9  col-md-12  main">
          <h1 class="page-header"><b>Historique des prêts</b></h1>
		</div></br>
<?php
if (isset($_GET['start'])) 
	{
		$start=$_GET['start'];
		if(strlen($start) > 0 and !is_numeric($start) or $start<0 ){ echo "attributs invalides"; exit; } 
	}
	else  $start=0;
	$page_name="utlisateur_historique.php";
	include("connexionSQL.php");
	$reqNbrLignes = "SELECT nbrlignes FROM `parametres`";
	$resReqNbr = mysqli_query($connexion, $reqNbrLignes);	
	$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
	$limit =  $row["nbrlignes"];
	$back = $start - $limit;
	$next = $start + $limit;
	$reqRech = "SELECT * FROM `prets` WHERE Lecteur_id='".$_SESSION["id"]."' LIMIT {$start},{$limit} ";
	if (isset($_GET['order'])) 
	{ 
		$order=$_GET['order'];
		if($order!="Prets_id" and $order!="Livre_id" and $order!="Lecteur_id" and $order!="Date_pret" and $order!="Date_retour" ){ echo "attributs invalides"; exit; } 
		$reqRech = "SELECT * FROM `prets`  WHERE Lecteur_id='".$_SESSION["id"]."' order by {$_GET['order']}  LIMIT {$start},{$limit} ";
		$order="&order=".$_GET['order'];
	}
	else $order="";
	$resReq = mysqli_query($connexion, $reqRech);	
	if (!$resReq)     die('Could not query1:' . mysql_error());
	$reqNbr = "SELECT count(*) FROM `prets` WHERE Lecteur_id='".$_SESSION["id"]."'";
	$resReqNbr = mysqli_query($connexion, $reqNbr); 
	$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
	$nbrLignes =  $row["count(*)"]; 
	if ( mysqli_num_rows($resReq) > 0 )	
	{ ?>
		<table class="table table-hover table-condensed table-responsive head" >
		  <thead>
			<tr>
			  <th width="5%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Prets_id";?>"><u>N°</u></a></th>
			  <th width="11%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Livre_id";?>"><u>Livre cote:</u></a></th>
			  <th width="11%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Lecteur_id";?>"><u>Lecteur id:</u></a></th>
			  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Date_pret";?>"><u>Date du prêt:</u></a></th>
			  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Date_retour";?>"><u>Date du retour:</u></a></th>
			  <th width="4%">Actions:</th>
			</tr>
		  </thead>
		  <tbody class="table table-hover">
			<?php  while ($row = mysqli_fetch_array($resReq, MYSQLI_ASSOC) ) { ?>
				<tr <?php if($row["temps_ecoule"]==1 and $row["Date_retour"]=="0000-00-00"){echo "style=\"background-color: rgba(210, 0, 0, 0.6)\"";} //rouge
							elseif($row["temps_ecoule"]==1 and $row["Date_retour"]!="0000-00-00"){echo "style=\"background-color: rgba(255, 147, 0, 0.7)\"";} //orange
							elseif($row["Date_retour"]!="0000-00-00" and $row["temps_ecoule"]==0) { echo "style=\"background-color: rgba(0, 124, 0, 0.7)\"";} //vert 
							else { echo "style=\"background-color: rgba(44, 137, 210, 0.7)\"";} //bleu ?> >
				  <th scope="row"> <?php echo $row["Prets_id"]; ?></th> 
				  <td><center> <?php echo $row["Livre_id"]; ?> </td></center>
				  <td><center> <?php echo $row["Lecteur_id"]; ?> </td></center>
				  <td><?php echo $row["Date_pret"]; ?> </td>
				  <td><?php if($row["Date_retour"]==0000-00-00){echo "non retourné";} else echo $row["Date_retour"]; ?> </td>
				   <td>
						<button  class="livre_list_form" data-toggle="modal" data-target="#myModal<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Afficher tous les details sur ce prêt"><div class="o"> <span class="glyphicon glyphicon-list"></span></div> </button>
							<div class="modal fade" id="myModal<?php echo $row["Prets_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Details du prêt N°<?php echo $row["Prets_id"]; ?>
									</h4>
								  </div>
								  <div class="modal-body">
								  <?php $reqLivre = "SELECT * FROM `lecteurs` where user_id='{$row["Lecteur_id"]}'";
										$resLivre = mysqli_query($connexion, $reqLivre); 
										if (!$resLivre)     die('Could not query:' . mysql_error());
										if(mysqli_num_rows($resLivre)==0) echo "Utilisateur n'éxiste plus <hr></hr>";
										else {	$row2=mysqli_fetch_array($resLivre, MYSQLI_ASSOC);
												echo "<center><B>Lecteur N° {$row2["user_id"]} </B></center></br>"; 
												echo "<table><tr> <td><B>N° Carte: &nbsp</B> </td><td>{$row2["num_carte"]} </td></tr><tr><td><B>nom:</B></td><td>{$row2["nom"]}</td></tr><tr> <td><B>Prenom: &nbsp</B> </td><td>{$row2["prenom"]} </td></tr>
												<tr> <td><B>Spécialité: &nbsp</B> </td><td>{$row2["specialite"]} </td></tr><tr> <td><B>Année d'étude: &nbsp</B> </td><td>{$row2["annee_etude"]} </td></tr><tr> <td><B>email: &nbsp</B> </td><td>{$row2["email"]} </td></tr></table><hr></hr>";
										}
										$reqLecteur = "SELECT * FROM `livres` where livre_id='{$row["Livre_id"]}'";
										$resLecteur = mysqli_query($connexion, $reqLecteur); 
										if (!$resLecteur)     die('Could not query:' . mysql_error());
										if(mysqli_num_rows($resLecteur)==0) echo "Livre n'éxiste plus <hr></hr>";
										else {	$row2 = mysqli_fetch_array($resLecteur, MYSQLI_ASSOC);
												echo "<center><B>Livre N°{$row2["livre_id"]}  "; ?></B></center></br> <?php
												echo "<table><tr><td><B>titre:</B></td><td>{$row2["livre_titre"]}</td></tr><tr><td> <B>auteur:</B></td><td>{$row2["livre_auteur"]}</td></tr><tr><td> <B>année:</B> </td><td>{$row2["livre_annee"]}</td></tr><tr> <td><B>spécialitée:</B> </td><td>{$row2["livre_specialitee"]}</td></tr><tr><td> <B>éxemplaires: &nbsp</B></td><td>{$row2["livre_exemplaires"]}/{$row2["livre_exemplaires_total"]}</td></tr></table><hr></hr>";
										}
										echo "<table><tr><td><B>Livre prêt le:</B></td><td> {$row["Date_pret"]}</td></tr><tr><td><B> Livre retourné le:</B></td><td> &nbsp"; if($row["Date_retour"]==0000-00-00){echo "non retourné";} else echo $row["Date_retour"]; echo"</td></tr></table>";
									?>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
							 </div></div></div></div>
							</td> 
				</tr>
			<?php } ?>
		  </tbody>
		</table>
		<center>
		<nav>
		  <ul class="pagination">
			<?php if($back >=0) { ?> <li class="previous"><a href="<?php echo $page_name."?start=".($start-$limit).$order;?>"><span aria-hidden="true">&larr;</span> Precedent </a></li> <?php } ?> 
			<?php 
			$p=1;
			for($i=0;$i<$nbrLignes;$i+=$limit)
				{
				if ($i<>$start) { ?> <li><a href="<?php echo $page_name;?>?start=<?php echo $i.$order;?>"><?php echo $p;?></a></li> <?php }
				else {	?> <li class="active"><a><?php echo $p;?></a></li>	<?php } 
				$p++;
				}
			?>
			<?php if($next < $nbrLignes) { ?> <li   class="next"><a href="<?php echo $page_name."?start=".($start+$limit).$order;?>">Suivant <span aria-hidden="true">&rarr;</span></a></li> <?php  } ?>
		  </ul>
									
		</nav>
		</center>
			<div class="color-swatches">
			<h5 style="display: inline-block"><b>Index couleurs: &nbsp </b></h5>
			  <div class="color-swatch brand-success" data-tooltip="top" title="livre retourné"></div>
			  <div class="color-swatch brand-blue" data-tooltip="top" title="livre non retourné"></div>
			  <div class="color-swatch brand-warning" data-tooltip="top" title="livre retourné + temps prêt écoulé "></div>
			  <div class="color-swatch brand-danger" data-tooltip="top" title="livre non retourné + temps prêt écoulé"></div>
			</div>
		<?php
	}
else{ 
	?><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp aucun livre trouver</div><?php
	}

 ?> 
    </div>
</div>
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