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
  <script src="js/jquery.min.js"></script>
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
					<li class="active"><a href="prets_liste.php">Liste</a></li>
					<li><a href="prets_ajout.php">Ajout</a></li>
					</ul>
            <li><a href="parametres.php">Paramètres</a></li>
        </ul>
         
        </div>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><b>Listes prêts</b></h1>
		</div>
		<div class="col-md-10 col-md-offset-2 ">
							
			<div class="col-md-offset-3 ">
			<form class="navbar-form navbar-left" role="search" action="prets_liste.php" method="GET">
				<select class="form-control" name="selection" >
					<option value="Prets_id">N° prêts:</option>
					<option value="Livre_id">Livre cote:</option>
					<option value="Lecteur_id">Lecteur id: </option>
					<option value="Date_pret">Date du prêt: </option>
					<option value="Date_retour">Date du retour: </option>
				</select>
			<div class="form-group">
			<input type="text" class="form-control" placeholder="mot" name="recherche">
			</div>

			<button type="submit" class="btn btn-default">chercher</button>
			</form>
			</div>

			<?php  
			if (isset($_GET["mod"]))  
				{  
				include("connexionSQL.php");
				$reqRech = "SELECT * FROM `prets` WHERE `Prets_id`='".$_GET["mod"]."'";
				$resReq = mysqli_query($connexion, $reqRech);	
					if (!$resReq) die('Could not query:' . mysql_error());
					if(mysqli_affected_rows($connexion)==1){
					$row = mysqli_fetch_array($resReq, MYSQLI_ASSOC);
					?></br></br>
					<form action="prets_liste.php" method="GET">
					 <table class="table table-condensed table-responsive">
					 <thead>
						<tr <?php if($row["temps_ecoule"]==1 and $row["Date_retour"]=="0000-00-00"){echo "style=\"background-color: rgba(210, 0, 0, 0.7)\"";} //rouge
												elseif($row["temps_ecoule"]==1 and $row["Date_retour"]!="0000-00-00"){echo "style=\"background-color: rgba(255, 147, 0, 0.7)\"";} //orange
												elseif($row["Date_retour"]!="0000-00-00" and $row["temps_ecoule"]==0) { echo "style=\"background-color: rgba(0, 124, 0, 0.7)\"";} //vert 
												else { echo "style=\"background-color: rgba(44, 137, 210, 0.7)\"";} //bleu ?>>
						  <th width="5%">N°</th>
						  <th width="11%">Livre cote:</th>
						  <th width="11%">Lecteur id:</th>
						  <th>Date du prêt:</th>
						  <th>Date du retour:</th>
						</tr>
					  </thead>
					  <tbody class="table">
						<tr>
									 
							  <th scope="row"> <?php echo $row["Prets_id"]; ?></th> 
							  <td> <?php $x=0;
										if ( isset($_GET["Livre_id"]) )
										{
										include("connexionSQL.php");
										$reqRech = "SELECT * FROM `livres` WHERE `livre_id`='{$_GET["Livre_id"]}'";
										$res = mysqli_query($connexion, $reqRech);	
										if (!$res)     die('Could not query:' . mysql_error());
										if ( mysqli_num_rows($res) == 0) 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="Livre_id" value="<?php echo $_GET["Livre_id"]; ?>">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="Livre_id" value="<?php echo $_GET["Livre_id"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input size="5" name="Livre_id" type="text" value="<?php echo $row["Livre_id"]; ?>">  <?php } ?>
								</td>
								<td><?php
										if ( isset($_GET["Lecteur_id"]) )
										{
										include("connexionSQL.php");
										$reqRech = "SELECT * FROM `lecteurs` WHERE `user_id`='{$_GET["Lecteur_id"]}'";
										$res = mysqli_query($connexion, $reqRech);	
										if (!$res)     die('Could not query:' . mysql_error());
										if ( mysqli_num_rows($res) == 0) 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="Lecteur_id" value="<?php echo $_GET["Lecteur_id"]; ?>">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="Lecteur_id" value="<?php echo $_GET["Lecteur_id"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input size="5" name="Lecteur_id" type="text" value="<?php echo $row["Lecteur_id"]; ?>">  <?php } ?>
							  </td>
							  <td><?php
										if ( isset($_GET["Date_pret"]) ) 
										{ $Date_pret = strlen((string) $_GET["Date_pret"]);
										if ($_GET["Date_pret"]=='' or $Date_pret!=10 ) 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input type="text" size="3" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="Date_pret" value="<?php echo $_GET["Date_pret"]; ?>">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input type="text" size="3" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="Date_pret" value="<?php echo $_GET["Date_pret"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input name="Date_pret" type="text" value="<?php echo $row["Date_pret"]; ?>">  <?php } ?>
							  </td>
							  <td><?php
										if ( isset($_GET["Date_retour"]) )
										{	$Date_retour = strlen((string) $_GET["Date_retour"]);
										if ($_GET["Date_retour"]=='' or $Date_retour!=10 ) 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input size="5" type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="Date_retour" value="<?php echo $_GET["Date_retour"]; ?>">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input  size="5" type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="Date_retour" value="<?php echo $_GET["Date_retour"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input name="Date_retour" type="text" value="<?php echo $row["Date_retour"]; ?>">  <?php } ?>
							  </td>
							</tr>
					  </tbody>
					</table>
					<p class="text-center">
					<button type="submit" class="btn btn-primary btn-lg " name="mod" value="<?php echo $row["Prets_id"]; ?>">Valider</button>
					<button type="reset" class="btn btn-default btn-lg ">Reset</button>  </form>
					</p>
					<div class="progress">
					  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo 8+23*$x;?>%">
					  </div>
					</div>
					<?php
					if ( $x==4 )
						{
						$reqMaj = "UPDATE `prets` SET `Lecteur_id`='".$_GET["Lecteur_id"]."',`Livre_id`='".$_GET["Livre_id"]."',`Date_pret`='".$_GET["Date_pret"]."',`Date_retour`='".$_GET["Date_retour"]."' WHERE `Prets_id`='".$row["Prets_id"]."'";
						$resReq = mysqli_query($connexion, $reqMaj);	
						if (!$resReq)     die('Could not query:' . mysql_error());
						else {
							?></br></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Prêt modifier avec succés</div></center><?php 
							echo("<script>window.setTimeout(function() {location.href = 'prets_liste.php'}, 3000);</script>");
						}
					}
				}
		}
			elseif ( isset($_GET["sup"]) && is_numeric($_GET["sup"]) && $_GET["sup"]>0  ){
				include("connexionSQL.php");
				$reqSup = "Delete FROM `prets` WHERE `Prets_id`='".$_GET["sup"]."'";
				$resReq = mysqli_query($connexion, $reqSup);	
					if (!$resReq)     die('Could not query:' . mysql_error());
				if (mysqli_affected_rows($connexion)==1){
					?></br></br></br></br><div class="alert alert-success" role="alert"><center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp Livre N°<?php echo $_GET["sup"]; ?> Prêt supprimer avec succés</center></div><?php
				}
				}	
			elseif ( isset($_GET["recherche"]) )
						{	
								if(isset($_GET["ret"]))
								{
								include("connexionSQL.php");
								$req = "SELECT Date_retour FROM `prets` WHERE Prets_id='".$_GET["ret"]."'";
								$res = mysqli_query($connexion, $req);	 if (!$res)     die('Could not query res:' . mysql_error());
								$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
								if($row["Date_retour"]!="0000-00-00") {	?><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp prêt deja retourner!</div></center><?php  }
								else
								{
									$date=date("Y-m-d");
									$reqRet = "UPDATE `prets` SET `Date_retour`='{$date}'  WHERE Prets_id='".$_GET["ret"]."'";
									$resRet = mysqli_query($connexion, $reqRet);	if (!$resRet)     die('Could not query resRet:' . mysql_error());
									$reqEx = "UPDATE `livres` SET `livre_exemplaires`=livre_exemplaires+1  WHERE livre_id='".$_GET["ret_livid"]."'";
									$resEx = mysqli_query($connexion, $reqEx);	if (!$resEx)     die('Could not query resEx:' . mysql_error());
									?><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp prêt retourner avec succés</div></center><?php 
								}
								}
								if(isset($_GET["ren"]))
								{
								include("connexionSQL.php");
								$date=date("Y-m-d");
								$reqRen = "UPDATE `prets` SET `Date_pret`='{$date}', Date_retour='0000-00-00', temps_ecoule=0, notification=0 WHERE Prets_id='".$_GET["ren"]."'";
								$resRen = mysqli_query($connexion, $reqRen);	if (!$resRen)     die('Could not query resRet:' . mysql_error());
								?><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp prêt renouvler avec succés</div></center><?php 
								}
							if (isset($_GET['start'])) 
							{
								$start=$_GET['start'];
								if(strlen($start) > 0 and !is_numeric($start) or $start<0 ){ echo "Erreur parametres url"; exit; } 
							}
							else  $start=0;
							$page_name="prets_liste.php";
							include("connexionSQL.php");
							$reqNbrLignes = "SELECT nbrlignes FROM `parametres`";
							$resReqNbr = mysqli_query($connexion, $reqNbrLignes);	
							$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
							$limit =  $row["nbrlignes"];
							$back = $start - $limit;
							$next = $start + $limit;
							$reqRech = "SELECT * FROM `prets` WHERE `".$_GET["selection"]."`='".$_GET["recherche"]."' LIMIT {$start},{$limit} ";
							if (isset($_GET['order'])) 
							{ 
								$order=$_GET['order'];
								if($order!="Prets_id" and $order!="Livre_id" and $order!="Lecteur_id" and $order!="Date_pret" and $order!="Date_retour"){ echo "attributs invalides"; exit; } 
								$reqRech = "SELECT * FROM `prets` WHERE `".$_GET["selection"]."`='".$_GET["recherche"]."' order by {$_GET['order']} LIMIT {$start},{$limit}";
								$order="&order=".$_GET['order'];
							}
							else $order="";
							$resReq = mysqli_query($connexion, $reqRech);	
								if (!$resReq)     die('Could not query:' . mysql_error());
								$reqNbr = "SELECT count(*) FROM `prets` WHERE `".$_GET["selection"]."`='".$_GET["recherche"]."'";
								$resReqNbr = mysqli_query($connexion, $reqNbr); 
								$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
								$nbrLignes =  $row["count(*)"]; 
								if ( mysqli_num_rows($resReq) > 0 )	
									{ 
									?>
									<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp recherche avec succés</div>
									 <table class="table table-hover table-condensed table-responsive">
									 <thead>
										<tr>
										  <th width="5%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=Prets_id";?>">N°</a></th>
										  <th width="11%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=Livre_id";?>">Livre cote:</a></th>
										  <th width="11%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=Lecteur_id";?>">Lecteur id:</a></th>
										  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=Date_pret";?>">Date du prêt:</a></th>
										  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=Date_retour";?>">Date du retour:</a></th>
										  <th width="19%">&nbsp&nbsp Action:</th>
										</tr>
									  </thead>
									  <tbody class="table table-hover">
										<?php  while ($row = mysqli_fetch_array($resReq, MYSQLI_ASSOC) ) { ?>
											<tr <?php if($row["temps_ecoule"]==1 and $row["Date_retour"]=="0000-00-00"){echo "style=\"background-color: rgba(210, 0, 0, 0.6)\"";} //rouge
												elseif($row["temps_ecoule"]==1 and $row["Date_retour"]!="0000-00-00"){echo "style=\"background-color: rgba(255, 147, 0, 0.7)\"";} //orange
												elseif($row["Date_retour"]!="0000-00-00" and $row["temps_ecoule"]==0) { echo "style=\"background-color: rgba(0, 124, 0, 0.7)\"";} //vert 
												else { echo "style=\"background-color: rgba(44, 137, 210, 0.7)\"";} //bleu ?> >
											  <th scope="row"> <?php echo $row["Prets_id"]; ?></th>
											  <td> <?php echo $row["Livre_id"]; ?> </td>
											  <td><?php echo $row["Lecteur_id"]; ?> </td>
											  <td><?php echo $row["Date_pret"]; ?> </td>
											  <td><?php if($row["Date_retour"]==0000-00-00){echo "non retourné";} else echo $row["Date_retour"]; ?> </td>
											   <td>
													<button  class="livre_list_form" data-toggle="modal" data-target="#myModal<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Afficher tous les details sur ce prêt"><div class="o"> <span class="glyphicon glyphicon-list"></span></div> </button>
														<div class="modal fade" id="myModal<?php echo $row["Prets_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														  <div class="modal-dialog">
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Details du prêt N°<?php echo $row["Prets_id"]; ?> <form action="prets_liste.php" method="GET" class="livre_list_form"><button type="submit" name="mod" value="<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Modifier ce prêt"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> </form> </h4>
																
															  </div>
															  <div class="modal-body">
															  <?php $reqLivre = "SELECT * FROM `lecteurs` where user_id='{$row["Lecteur_id"]}'";
																	$resLivre = mysqli_query($connexion, $reqLivre); 
																	if (!$resLivre)     die('Could not query:' . mysql_error());
																	if(mysqli_num_rows($resLivre)==0) echo "Utilisateur n'éxiste plus <hr></hr>";
																	else {	$row2=mysqli_fetch_array($resLivre, MYSQLI_ASSOC);
																			echo "<center><B>Lecteur N° {$row2["user_id"]} "; ?><form action="lecteur.php" method="GET" class="livre_list_form"><button type="submit" name="mod" value="<?php echo $row2["user_id"]; ?>" data-tooltip="top" title="Modifier ce lecteur"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> </form></B></center></br><?php 
																			echo "<table><tr> <td><B>N° Carte: &nbsp</B> </td><td>{$row2["num_carte"]} </td></tr><tr><td><B>nom:</B></td><td>{$row2["nom"]}</td></tr><tr> <td><B>Prenom: &nbsp</B> </td><td>{$row2["prenom"]} </td></tr>
																			<tr> <td><B>Spécialité: &nbsp</B> </td><td>{$row2["specialite"]} </td></tr><tr> <td><B>Année d'étude: &nbsp</B> </td><td>{$row2["annee_etude"]} </td></tr><tr> <td><B>email: &nbsp</B> </td><td>{$row2["email"]} </td></tr></table><hr></hr>";
																	}
																	$reqLecteur = "SELECT * FROM `livres` where livre_id='{$row["Livre_id"]}'";
																	$resLecteur = mysqli_query($connexion, $reqLecteur); 
																	if (!$resLecteur)     die('Could not query:' . mysql_error());
																	if(mysqli_num_rows($resLecteur)==0) echo "Livre n'éxiste plus <hr></hr>";
																	else {	$row2 = mysqli_fetch_array($resLecteur, MYSQLI_ASSOC);
																			echo "<center><B>Livre N°{$row2["livre_id"]} "; ?><form action="livres_liste.php" method="GET" class="livre_list_form"><button type="submit" name="mod" value="<?php echo $row["Livre_id"]; ?>" data-tooltip="top" title="Modifier ce livre"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> </form></B></center></br> <?php
																			echo "<table><tr><td><B>titre:</B></td><td>{$row2["livre_titre"]}</td></tr><tr><td> <B>auteur:</B></td><td>{$row2["livre_auteur"]}</td></tr><tr><td> <B>année:</B> </td><td>{$row2["livre_annee"]}</td></tr><tr> <td><B>spécialitée:</B> </td><td>{$row2["livre_specialitee"]}</td></tr><tr><td> <B>éxemplaires: &nbsp</B></td><td>{$row2["livre_exemplaires"]}/{$row2["livre_exemplaires_total"]}</td></tr></table><hr></hr>";
																	}
																	echo "<table><tr><td><B>Livre prêt le:</B></td><td> {$row["Date_pret"]}</td></tr><tr><td><B> Livre retourné le:</B></td><td> &nbsp"; if($row["Date_retour"]==0000-00-00){echo "non retourné";} else echo $row["Date_retour"]; echo"</td></tr></table>";
																?>
															  </div>
															  <div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
														 </div></div></div></div>
														 <button  class="livre_list_form" data-toggle="modal" data-target="#myModal2<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Retourner ce prêt"><div class="o"> <span class="glyphicon glyphicon-check"></span></div> </button>
																					<div class="modal fade" id="myModal2<?php echo $row["Prets_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																					  <div class="modal-dialog"><div class="modal-content">
																					  <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>																						  </div>
																						  <div class="modal-body">
																								<b> Confirmer le retour du prêt ?</b></br>
																								 <form action="prets_liste.php" method="GET" class="livre_list_form">
																									<button class="btn btn-success btn-xs" type="submit" name="ret" value="<?php echo $row["Prets_id"]; ?>"  >oui</button>
																									 <input type="hidden" name="ret_livid" value="<?php echo $row["Livre_id"]; ?>"> 
																									<button class="btn btn-danger btn-xs" type="button" data-dismiss="modal">non</button>
																							</form> 
																						</div></div></div></div>
												 <button  class="livre_list_form" data-toggle="modal" data-target="#myModal3<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Renouvler ce prêt"><div class="o"> <span class="glyphicon glyphicon-refresh"></span></div> </button>
																					<div class="modal fade" id="myModal3<?php echo $row["Prets_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																					  <div class="modal-dialog"><div class="modal-content">
																					  <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>																						  </div>
																						  <div class="modal-body">
																								<b> Confirmer le renouvlement du prêt ?</b></br>
																								 <form action="prets_liste.php" method="GET" class="livre_list_form">
																									<button class="btn btn-success btn-xs" type="submit" name="ren" value="<?php echo $row["Prets_id"]; ?>"  >oui</button>
																									<button class="btn btn-danger btn-xs" type="button" data-dismiss="modal">non</button>
																							</form> 
																						</div></div></div></div>
														 <form action="prets_liste.php" method="GET" class="livre_list_form">
															<button type="submit" name="mod" value="<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Modifier ce prêt"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> 
															<button type="submit" name="sup" value="<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Supprimer ce prêt"><div class="o"> <span class="glyphicon glyphicon-remove"></span></div> </button>
														</form> 
												</td> 
											</tr>
										<?php } ?>
									  </tbody>
									</table>
									<center>
									<nav>
									  <ul class="pagination">
										<?php if($back >=0) { ?> <li class="previous"><a href="<?php echo $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&start=".($start-$limit).$order;?>"><span aria-hidden="true">&larr;</span> Precedent </a></li> <?php } ?> 
										<?php 
										$p=1;
										for($i=0;$i<$nbrLignes;$i+=$limit)
											{
											if ($i<>$start) { echo "<li><a href=\"{$page_name}?selection={$_GET["selection"]}&recherche={$_GET["recherche"]}&start={$i}{$order}\">{$p}</a></li>"; }
											else {	?> <li class="active"><a><?php echo $p;?></a></li>	<?php } 
											$p++;
											}
										?>
										<?php if($next < $nbrLignes) { ?> <li   class="next"><a href="<?php echo $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&start=".($start+$limit).$order;?>">Suivant <span aria-hidden="true">&rarr;</span></a></li> <?php  } ?>
									  </ul>
									</nav>
									</center>
									<?php 
									}
								else{ 
									?><div class="alert alert-info" role="alert"><div class="col-md-offset-9 "><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp aucun prêt trouver</div></div><?php
									
									}
						}

					else{
								if(isset($_GET["ret"]))
								{
								include("connexionSQL.php");
								$req = "SELECT Date_retour FROM `prets` WHERE Prets_id='".$_GET["ret"]."'";
								$res = mysqli_query($connexion, $req);	 if (!$res)     die('Could not query res:' . mysql_error());
								$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
								if($row["Date_retour"]!="0000-00-00") {	?><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp prêt deja retourner!</div></center><?php  }
								else
								{
									$date=date("Y-m-d");
									$reqRet = "UPDATE `prets` SET `Date_retour`='{$date}'  WHERE Prets_id='".$_GET["ret"]."'";
									$resRet = mysqli_query($connexion, $reqRet);	if (!$resRet)     die('Could not query resRet:' . mysql_error());
									$reqEx = "UPDATE `livres` SET `livre_exemplaires`=livre_exemplaires+1  WHERE livre_id='".$_GET["ret_livid"]."'";
									$resEx = mysqli_query($connexion, $reqEx);	if (!$resEx)     die('Could not query resEx:' . mysql_error());
									?><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp prêt retourner avec succés</div></center><?php 
								}
								}
								if(isset($_GET["ren"]))
								{
								include("connexionSQL.php");
								$date=date("Y-m-d");
								$reqRen = "UPDATE `prets` SET `Date_pret`='{$date}', Date_retour='0000-00-00', temps_ecoule=0, notification=0 WHERE Prets_id='".$_GET["ren"]."'";
								$resRen = mysqli_query($connexion, $reqRen);	if (!$resRen)     die('Could not query resRet:' . mysql_error());
								?><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp prêt renouvler avec succés</div></center><?php 
								}
						if (isset($_GET['start'])) 
						{
							$start=$_GET['start'];
							if(strlen($start) > 0 and !is_numeric($start) or $start<0 ){ echo "attributs invalides"; exit; } 
						}
						else  $start=0;
						$page_name="prets_liste.php";
						include("connexionSQL.php");
						$reqNbrLignes = "SELECT nbrlignes FROM `parametres`";
						$resReqNbr = mysqli_query($connexion, $reqNbrLignes);	
						$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
						$limit =  $row["nbrlignes"];
						$back = $start - $limit;
						$next = $start + $limit;
						$reqRech = "SELECT * FROM `prets` LIMIT {$start},{$limit}";
						if (isset($_GET['order'])) 
						{ 
							$order=$_GET['order'];
							if($order!="Prets_id" and $order!="Livre_id" and $order!="Lecteur_id" and $order!="Date_pret" and $order!="Date_retour" ){ echo "attributs invalides"; exit; } 
							$reqRech = "SELECT * FROM `prets` order by {$_GET['order']} LIMIT {$start},{$limit}";
							$order="&order=".$_GET['order'];
						}
						else $order="";
						$resReq = mysqli_query($connexion, $reqRech);	
						if (!$resReq)     die('Could not query:' . mysql_error());
						$reqNbr = "SELECT count(*) FROM `prets`";
						$resReqNbr = mysqli_query($connexion, $reqNbr); 
						$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
						$nbrLignes =  $row["count(*)"]; 
						if ( mysqli_num_rows($resReq) > 0 )	
						{ ?>
							<table class="table table-hover table-condensed table-responsive">
							  <thead>
								<tr>
								  <th width="5%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Prets_id";?>">N°</a></th>
								  <th width="11%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Livre_id";?>">Livre cote:</a></th>
								  <th width="11%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Lecteur_id";?>">Lecteur id:</a></th>
								  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Date_pret";?>">Date du prêt:</a></th>
								  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=Date_retour";?>">Date du retour:</a></th>
								  <th width="19%">&nbsp&nbsp Actions:</th>
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
														<form action="prets_liste.php" method="GET" class="livre_list_form"><button type="submit" name="mod" value="<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Modifier ce prêt"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> </form> 
														</h4>
													  </div>
													  <div class="modal-body">
													  <?php $reqLivre = "SELECT * FROM `lecteurs` where user_id='{$row["Lecteur_id"]}'";
															$resLivre = mysqli_query($connexion, $reqLivre); 
															if (!$resLivre)     die('Could not query:' . mysql_error());
															if(mysqli_num_rows($resLivre)==0) echo "Utilisateur n'éxiste plus <hr></hr>";
															else {	$row2=mysqli_fetch_array($resLivre, MYSQLI_ASSOC);
																	echo "<center><B>Lecteur N° {$row2["user_id"]} "; ?><form action="lecteur.php" method="GET" class="livre_list_form"><button type="submit" name="mod" value="<?php echo $row2["user_id"]; ?>" data-tooltip="top" title="Modifier ce lecteur"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> </form></B></center></br><?php 
																	echo "<table><tr> <td><B>N° Carte: &nbsp</B> </td><td>{$row2["num_carte"]} </td></tr><tr><td><B>nom:</B></td><td>{$row2["nom"]}</td></tr><tr> <td><B>Prenom: &nbsp</B> </td><td>{$row2["prenom"]} </td></tr>
																	<tr> <td><B>Spécialité: &nbsp</B> </td><td>{$row2["specialite"]} </td></tr><tr> <td><B>Année d'étude: &nbsp</B> </td><td>{$row2["annee_etude"]} </td></tr><tr> <td><B>email: &nbsp</B> </td><td>{$row2["email"]} </td></tr></table><hr></hr>";
															}
															$reqLecteur = "SELECT * FROM `livres` where livre_id='{$row["Livre_id"]}'";
															$resLecteur = mysqli_query($connexion, $reqLecteur); 
															if (!$resLecteur)     die('Could not query:' . mysql_error());
															if(mysqli_num_rows($resLecteur)==0) echo "Livre n'éxiste plus <hr></hr>";
															else {	$row2 = mysqli_fetch_array($resLecteur, MYSQLI_ASSOC);
																	echo "<center><B>Livre N°{$row2["livre_id"]}  "; ?><form action="livres_liste.php" method="GET" class="livre_list_form"><button type="submit" name="mod" value="<?php echo $row["Livre_id"]; ?>" data-tooltip="top" title="Modifier ce livre"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> </form></B></center></br> <?php
																	echo "<table><tr><td><B>titre:</B></td><td>{$row2["livre_titre"]}</td></tr><tr><td> <B>auteur:</B></td><td>{$row2["livre_auteur"]}</td></tr><tr><td> <B>année:</B> </td><td>{$row2["livre_annee"]}</td></tr><tr> <td><B>spécialitée:</B> </td><td>{$row2["livre_specialitee"]}</td></tr><tr><td> <B>éxemplaires: &nbsp</B></td><td>{$row2["livre_exemplaires"]}/{$row2["livre_exemplaires_total"]}</td></tr></table><hr></hr>";
															}
															echo "<table><tr><td><B>Livre prêt le:</B></td><td> {$row["Date_pret"]}</td></tr><tr><td><B> Livre retourné le:</B></td><td> &nbsp"; if($row["Date_retour"]==0000-00-00){echo "non retourné";} else echo $row["Date_retour"]; echo"</td></tr></table>";
														?>
													  </div>
													  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												 </div></div></div></div>
												 
												 
												<button  class="livre_list_form" data-toggle="modal" data-target="#myModal2<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Retourner ce prêt"><div class="o"> <span class="glyphicon glyphicon-check"></span></div> </button>
																					<div class="modal fade" id="myModal2<?php echo $row["Prets_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																					  <div class="modal-dialog"><div class="modal-content">
																					  <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>																						  </div>
																						  <div class="modal-body">
																								<b> Confirmer le retour du prêt ?</b></br>
																								 <form action="prets_liste.php" method="GET" class="livre_list_form">
																									<button class="btn btn-success btn-xs" type="submit" name="ret" value="<?php echo $row["Prets_id"]; ?>"  >oui</button>
																									 <input type="hidden" name="ret_livid" value="<?php echo $row["Livre_id"]; ?>"> 
																									<button class="btn btn-danger btn-xs" type="button" data-dismiss="modal">non</button>
																							</form> 
																						</div></div></div></div>
												 <button  class="livre_list_form" data-toggle="modal" data-target="#myModal3<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Renouvler ce prêt"><div class="o"> <span class="glyphicon glyphicon-refresh"></span></div> </button>
																					<div class="modal fade" id="myModal3<?php echo $row["Prets_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																					  <div class="modal-dialog"><div class="modal-content">
																					  <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>																						  </div>
																						  <div class="modal-body">
																								<b> Confirmer le renouvlement du prêt ?</b></br>
																								 <form action="prets_liste.php" method="GET" class="livre_list_form">
																									<button class="btn btn-success btn-xs" type="submit" name="ren" value="<?php echo $row["Prets_id"]; ?>"  >oui</button>
																									<button class="btn btn-danger btn-xs" type="button" data-dismiss="modal">non</button>
																							</form> 
																						</div></div></div></div>
																						
												 <form action="prets_liste.php" method="GET" class="livre_list_form">
													<button type="submit" name="mod" value="<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Modifier ce prêt"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> 
													<button type="submit" name="sup" value="<?php echo $row["Prets_id"]; ?>" data-tooltip="left" title="Supprimer ce prêt"><div class="o"> <span class="glyphicon glyphicon-remove"></span></div> </button>
												</form> 
	
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

							<?php
						}
					else{ 
						?><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp aucun livre trouver</div><?php
						}
				}
				?>
			
			<div class="color-swatches">
			<h5 style="display: inline-block"><b>Index couleurs: &nbsp </b></h5>
			  <div class="color-swatch brand-success" data-tooltip="top" title="livre retourné"></div>
			  <div class="color-swatch brand-blue" data-tooltip="top" title="livre non retourné"></div>
			  <div class="color-swatch brand-warning" data-tooltip="top" title="livre retourné + temps prêt écoulé "></div>
			  <div class="color-swatch brand-danger" data-tooltip="top" title="livre non retourné + temps prêt écoulé"></div>
			</div>



	<?php 
	}
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
