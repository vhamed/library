<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
  <script src="js/prefixfree.min.js"></script>
  <link href="css/style_login.css" rel="stylesheet">
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
            <li class="active"><a href="livres_liste.php">Livres</a></li>
					<ul class="nav nav-sidebar sidebar-b">
					<li class="active"><a href="livres_liste.php">Liste</a></li>
					<li><a href="livres_ajout.php">Ajout</a></li>
					</ul>
            <li><a href="lecteur.php">Lecteurs</a></li>
			<li><a href="prets_liste.php">Prêts</a></li>
            <li><a href="parametres.php">Paramètres</a></li>
        </ul>
         
        </div>
		
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><b>Listes livres</b></h1>
		</div>
			<div class="col-md-10 col-md-offset-2 ">
			
						<div class="col-md-offset-3 ">
			<form class="navbar-form navbar-left" role="search" action="livres_liste.php" method="GET">
				<select class="form-control" name="selection" >
				<option value="livre_id">id:</option>
				<option value="livre_titre">titre:</option>
				<option value="livre_auteur">auteur: </option>
				<option value="livre_annee">année: </option>
				<option value="livre_specialitee">spécialite: </option>
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
				$reqRech = "SELECT * FROM `livres` WHERE `livre_id`='".$_GET["mod"]."'";
				$resReq = mysqli_query($connexion, $reqRech);	
				if (!$resReq) die('Could not query:' . mysql_error());
					if(mysqli_affected_rows($connexion)==1){
					$row = mysqli_fetch_array($resReq, MYSQLI_ASSOC);
					?></br></br>	
					<form action="livres_liste.php" method="GET">
					 <table class="table table-condensed table-responsive">
					 <thead>
						<tr <?php if($row["livre_exemplaires"]==0){echo "style=\"background-color: rgba(210, 0, 0, 0.7)\"";} //rouge 
									else { echo "style=\"background-color: rgba(255, 255,255, 0.9)\"";} //blanc ?>>
						  <th width="5%">#id</th>
						  <th>Titre:</th>
						  <th>Auteur:</th>
						  <th width="9%">Année:</th>
						  <th width="15%">Spécialitée:</th>
						  <th width="5%">Exemplaires:</th>
						</tr>
					  </thead>
					  <tbody class="table">
						<tr>
							  <th scope="row"> <?php echo $row["livre_id"]; ?></th> 
							  <td> <?php $x=0;
										if ( isset($_GET["titre"]) )
										{
										if ($_GET["titre"]=='') 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="titre" placeholder="invalide">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="titre" value="<?php echo $_GET["titre"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input name="titre" type="text" size="20" value="<?php echo $row["livre_titre"]; ?>">  <?php } ?>
								</td>
								<td><?php
										if ( isset($_GET["auteur"]) )
										{
										if ($_GET["auteur"]=='') 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="auteur" placeholder="invalide">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="auteur" value="<?php echo $_GET["auteur"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input name="auteur" type="text" size="20" value="<?php echo $row["livre_auteur"]; ?>">  <?php } ?>
							  </td>
							  <td><?php
										if ( isset($_GET["année"]) ) 
										{ $long_annee = strlen((string) $_GET["année"]);
										if ($_GET["année"]=='' or $long_annee!=4 or !is_numeric($_GET["année"]) ) 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input type="text" size="3" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="année" placeholder="invalide">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input type="text" size="3" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="année" value="<?php echo $_GET["année"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input name="année" type="text" size="3" value="<?php echo $row["livre_annee"]; ?>">  <?php } ?>
							  </td>
							  <td><?php
										if ( isset($_GET["spécialitée"]) )
										{
										if ($_GET["spécialitée"]=='') 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input size="5" type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="spécialitée" placeholder="invalide">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input  size="5" type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="spécialitée" value="<?php echo $_GET["spécialitée"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input name="spécialitée" type="text" size="5" value="<?php echo $row["livre_specialitee"]; ?>">  <?php } ?>
							  </td>
							  <td><?php
										if ( isset($_GET["exemplaires"]) )
										{
										if ($_GET["exemplaires"]<0 or !is_numeric($_GET["exemplaires"])) 
											{		?>
													<div class="form-group has-error  has-feedback">
													<input type="text" size="1" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="exemplaires" placeholder="invalide">
													<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
													<span id="inputError2Status" class="sr-only">(error)</span>
													</div>	<?php
											}
										else{		?>
													<div class="form-group has-success has-feedback">
													<input type="text" size="1" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="exemplaires" value="<?php echo $_GET["exemplaires"]?>">
													<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
													<span id="inputSuccess3Status" class="sr-only">(success)</span>
													</div>	<?php $x++;	
										} 
									}
									else {	?><input name="exemplaires" type="text" size="1" value="<?php echo $row["livre_exemplaires"]; ?>">  <?php } ?>
							  </td>
							</tr>
					  </tbody>
					</table>
					<p class="text-center">
					<button type="submit" class="btn btn-primary btn-lg " name="mod" value="<?php echo $row["livre_id"]; ?>">Valider</button>
					<button type="reset" class="btn btn-default btn-lg ">Reset</button>  </form>
					</p>
					<div class="progress">
					  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo 5+19*$x;?>%">
					  </div>
					</div>
					<?php
					if ( $x==5 )
						{
						$reqMaj = "UPDATE `livres` SET `livre_titre`='".$_GET["titre"]."',`livre_auteur`='".$_GET["auteur"]."',`livre_annee`='".$_GET["année"]."',`livre_specialitee`='".$_GET["spécialitée"]."',`livre_exemplaires`='".$_GET["exemplaires"]."' WHERE `livre_id`='".$_GET["mod"]."'";
						$resReq = mysqli_query($connexion, $reqMaj);	
						if (!$resReq)     die('Could not query:' . mysql_error());
						else {
							?></br></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp livre modifier avec succés</div></center><?php 
							echo("<script>window.setTimeout(function() {location.href = 'livres_liste.php'}, 3000);</script>");
						}
					}
				}
			}
			elseif ( isset($_GET["sup"]) && is_numeric($_GET["sup"]) && $_GET["sup"]>0  ){
				include("connexionSQL.php");
				$reqSup = "Delete FROM `livres` WHERE `livre_id`='".$_GET["sup"]."'";
				$resReq = mysqli_query($connexion, $reqSup);	
					if (!$resReq)     die('Could not query:' . mysql_error());
				if (mysqli_affected_rows($connexion)==1){
					?></br></br></br></br><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp <center>Livre N°<?php echo $_GET["sup"]; ?> supprimer avec succés</center></div><?php
				}
				}	
			elseif ( isset($_GET["recherche"]) )
						{	
							if (isset($_GET['start'])) 
							{
								$start=$_GET['start'];
								if(strlen($start) > 0 and !is_numeric($start) or $start<0 ){ echo "Erreur parametres url"; exit; } 
							}
							else  $start=0;
							$page_name="livres_liste.php";
							include("connexionSQL.php");
							$reqNbrLignes = "SELECT nbrlignes FROM `parametres`";
							$resReqNbr = mysqli_query($connexion, $reqNbrLignes);	
							$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
							$limit =  $row["nbrlignes"];
							$back = $start - $limit;
							$next = $start + $limit;
							$reqRech = "SELECT * FROM `livres` WHERE `".$_GET["selection"]."`='".$_GET["recherche"]."' LIMIT {$start},{$limit} ";
							if (isset($_GET['order'])) 
							{ 
								$order=$_GET['order'];
								if($order!="livre_id" and $order!="livre_titre" and $order!="livre_auteur" and $order!="livre_annee" and $order!="livre_specialitee" and $order!="livre_exemplaires"){ echo "attributs invalides"; exit; } 
								$reqRech = "SELECT * FROM `livres` WHERE `".$_GET["selection"]."`='".$_GET["recherche"]."' order by {$_GET['order']} LIMIT {$start},{$limit}";
								$order="&order=".$_GET['order'];
							}
							else $order="";
							$resReq = mysqli_query($connexion, $reqRech);	
								if (!$resReq)     die('Could not query:' . mysql_error());
								$reqNbr = "SELECT count(*) FROM `livres` WHERE `".$_GET["selection"]."`='".$_GET["recherche"]."'";
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
										  <th width="5%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=livre_id";?>">#id</a></th>
										  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=livre_titre";?>">Titre:</a></th>
										  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=livre_auteur";?>">Auteur:</a></th>
										  <th width="9%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=livre_annee";?>">Année:</a></th>
										  <th width="15%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=livre_specialitee";?>">Spécialitée:</a></th>
										  <th width="5%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?selection=".$_GET["selection"]."&recherche=".$_GET["recherche"]."&order=livre_exemplaires";?>">Exemplaires:</a></th>
										  <th width="16%">&nbsp&nbsp&nbsp Action:</th>
										</tr>
									  </thead>
									  <tbody class="table table-hover">
										<?php  while ($row = mysqli_fetch_array($resReq, MYSQLI_ASSOC) ) { ?>
											<tr <?php if($row["livre_exemplaires"]==0){echo "style=\"background-color: rgba(210, 0, 0, 0.7)\"";} //rouge ?>>
											  <th scope="row"> <?php echo $row["livre_id"]; ?></th>
											  <td> <?php echo $row["livre_titre"]; ?> </td>
											  <td><?php echo $row["livre_auteur"]; ?> </td>
											  <td><?php echo $row["livre_annee"]; ?> </td>
											  <td><?php echo $row["livre_specialitee"]; ?> </td>
											  <td><?php echo $row["livre_exemplaires"]."/". $row["livre_exemplaires_total"]; ?> </td>
											  <td>	<form action="livres_liste.php" method="GET" class="livre_list_form">
													<button data-tooltip="left" title="Modifier ce livre" type="submit" name="mod" value="<?php echo $row["livre_id"]; ?>"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> 
													<button data-tooltip="left" title="Supprimer ce livre" type="submit" name="sup" value="<?php echo $row["livre_id"]; ?>"><div class="o"> <span class="glyphicon glyphicon-remove"></span></div> </button>
													</form> 
													<form action="prets_ajout.php" method="GET" class="livre_list_form">
													<button data-tooltip="left" title="Ajouter ce livre à un prêt" type="submit" name="id_liv" value="<?php echo $row["livre_id"]; ?>"><div class="o"> <span class="glyphicon glyphicon-plus"></span></div> </button>
													</form> 
													<form action="prets_liste.php" method="GET" class="livre_list_form">
													<input type="hidden" name="selection" value="Livre_id" /> 
													<button data-tooltip="left" title="Rechercher les prêts sur ce livre" type="submit" name="recherche" value="<?php echo $row["livre_id"]; ?>"><div class="o"> <span class="glyphicon glyphicon-search"></span></div> </button>
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
									?><div class="alert alert-info" role="alert"><div class="col-md-offset-9 "><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp aucun resultat trouver</div></div><?php
									
									}
						}
				else{
					if (isset($_GET['start'])) 
					{
						$start=$_GET['start'];
						if(strlen($start) > 0 and !is_numeric($start) or $start<0 ){ echo "attributs invalides"; exit; } 
					}
					else  $start=0;
					$page_name="livres_liste.php";
					include("connexionSQL.php");
					$reqNbrLignes = "SELECT nbrlignes FROM `parametres`";
					$resReqNbr = mysqli_query($connexion, $reqNbrLignes);	
					$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
					$limit =  $row["nbrlignes"];
					$back = $start - $limit;
					$next = $start + $limit;
					$reqRech = "SELECT * FROM `livres` LIMIT {$start},{$limit}";
					if (isset($_GET['order'])) 
					{ 
						$order=$_GET['order'];
						if($order!="livre_id" and $order!="livre_titre" and $order!="livre_auteur" and $order!="livre_annee" and $order!="livre_specialitee" and $order!="livre_exemplaires"){ echo "attributs invalides"; exit; } 
						$reqRech = "SELECT * FROM `livres` order by {$_GET['order']} LIMIT {$start},{$limit}";
						$order="&order=".$_GET['order'];
					}
					else $order="";
					$resReq = mysqli_query($connexion, $reqRech);	
					if (!$resReq)     die('Could not query:' . mysql_error());
					else {
						$reqNbr = "SELECT count(*) FROM `livres`";
						$resReqNbr = mysqli_query($connexion, $reqNbr); 
						$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
						$nbrLignes =  $row["count(*)"]; 
						if ( mysqli_num_rows($resReq) > 0 )	
						{ ?>
							<table class="table table-hover table-condensed table-responsive">
							  <thead>
								<tr>
								  <th width="5%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=livre_id";?>">#id</a></th>
								  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=livre_titre";?>">Titre:</a></th>
								  <th><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=livre_auteur";?>">Auteur:</a></th>
								  <th width="9%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=livre_annee";?>">Année:</a></th>
								  <th width="15%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=livre_specialitee";?>">Spécialitée:</a></th>
								  <th width="5%"><a data-tooltip="top" title="Trier par:" class="lien_listes" href="<?php  echo  $page_name."?order=livre_exemplaires";?>">Exemplaires:</a></th>
								  <th width="15%">&nbsp&nbsp&nbsp Action:</th>
								</tr>
							  </thead>
							  <tbody class="table table-hover">
								<?php  while ($row = mysqli_fetch_array($resReq, MYSQLI_ASSOC) ) { ?>
									<tr <?php if($row["livre_exemplaires"]==0){echo "style=\"background-color: rgba(210, 0, 0, 0.7)\"";} //rouge ?>>
									  <th scope="row"> <?php echo $row["livre_id"]; ?></th>
									  <td> <?php echo $row["livre_titre"]; ?> </td>
									  <td><?php echo $row["livre_auteur"]; ?> </td>
									  <td><?php echo $row["livre_annee"]; ?> </td>
									  <td><?php echo $row["livre_specialitee"]; ?> </td>
									  <td><?php echo $row["livre_exemplaires"]."/". $row["livre_exemplaires_total"]; ?> </td>
									  <td>	<form action="livres_liste.php" method="GET" class="livre_list_form">
													<button data-tooltip="left" title="Modifier ce livre" type="submit" name="mod" value="<?php echo $row["livre_id"]; ?>"><div class="o"> <span class="glyphicon glyphicon-pencil"></span></div> </button> 
													<button data-tooltip="left" title="Supprimer ce livre" type="submit" name="sup" value="<?php echo $row["livre_id"]; ?>"><div class="o"> <span class="glyphicon glyphicon-remove"></span></div> </button>
													</form> 
													<form action="prets_ajout.php" method="GET" class="livre_list_form">
													<button data-tooltip="left" title="Ajouter ce livre à un prêt" type="submit" name="id_liv" value="<?php echo $row["livre_id"]; ?>"><div class="o"> <span class="glyphicon glyphicon-plus"></span></div> </button>
													</form> 
													<form action="prets_liste.php" method="GET" class="livre_list_form">
													<input type="hidden" name="selection" value="Livre_id" /> 
													<button data-tooltip="left" title="Rechercher les prêts sur ce livre" type="submit" name="recherche" value="<?php echo $row["livre_id"]; ?>"><div class="o"> <span class="glyphicon glyphicon-search"></span></div> </button>
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
				}
				?>
			<div class="color-swatches">
			<h5 style="display: inline-block"><b>Index couleurs: &nbsp </b></h5>
			  <div class="color-swatch brand-white" data-tooltip="top" title="exemplaires disponible"></div>
			  <div class="color-swatch brand-danger" data-tooltip="top" title="0 exemplaires restent"></div>
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
