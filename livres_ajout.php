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
            <li class="active"><a>Livres</a></li>
					<ul class="nav nav-sidebar sidebar-b">
					<li><a href="livres_liste.php">Liste</a></li>
					<li class="active"><a>Ajout</a></li>
					</ul>
            <li><a href="lecteur.php">Lecteurs</a></li>
			<li><a href="prets_liste.php">Prêts</a></li>
            <li><a href="parametres.php">Paramètres</a></li>
        </ul>
         
        </div>
		
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><b>Ajouter livres</b></h1>
		</div>
		
		<div class="col-md-12 col-md-offset-0 ">
        <form action="livres_ajout.php" method="POST" class="form-horizontal" >
		<?php  $x=0; if ( isset($_POST["titre"]) )
					{
					if ($_POST["titre"]=='') 
						{		?>
								<div class="form-group has-error  has-feedback">
								<label class="control-label col-sm-5" for="inputError2">titre</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="titre" placeholder="invalide">
								<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
								</div>
								</div>	<?php
						}
					else{		?>
								<div class="form-group has-success has-feedback">
								<label class="control-label col-sm-5" for="inputSuccess3">titre</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="titre" value="<?php echo $_POST["titre"]?>">
								<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
								<span id="inputSuccess3Status" class="sr-only">(success)</span>
								</div>
								</div>	<?php	$x++;
					} 
					
				}
				else {	?>
						<div class="form-group">
						<label class="col-sm-5 control-label">titre</label>
						<div class="col-sm-4 col-xs-6">
						<input type="text" class="form-control" placeholder="titre" name="titre">
						</div>
						</div>	<?php
					
				}
				if ( isset($_POST["auteur"]) )
					{
					if ($_POST["auteur"]=='') 
						{		?>
								<div class="form-group has-error  has-feedback">
								<label class="control-label col-sm-5" for="inputError2">auteur</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="auteur" placeholder="invalide">
								<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
								</div>
								</div>	<?php
						}
					else{		?>
								<div class="form-group has-success has-feedback">
								<label class="control-label col-sm-5" for="inputSuccess3">auteur</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="auteur" value="<?php echo $_POST["auteur"]?>">
								<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
								<span id="inputSuccess3Status" class="sr-only">(success)</span>
								</div>
								</div>	<?php	$x++;
					} 
					
				}
				else {	?>
						<div class="form-group">
						<label class="col-sm-5 control-label">auteur</label>
						<div class="col-sm-4 col-xs-6">
						<input type="text" class="form-control" placeholder="auteur" name="auteur">
						</div>
						</div>	<?php
					
				}
				if ( isset($_POST["année"]) )
					{ $long_annee = strlen((string) $_POST["année"]);
					if ($_POST["année"]=='' or $long_annee!=4 or !is_numeric($_POST["année"]) ) 
						{		?>
								<div class="form-group has-error  has-feedback">
								<label class="control-label col-sm-5" for="inputError2">année</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="année" placeholder="invalide">
								<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
								</div>
								</div>	<?php
						}
					else{		?>
								<div class="form-group has-success has-feedback">
								<label class="control-label col-sm-5" for="inputSuccess3">année</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="année" value="<?php echo $_POST["année"]?>">
								<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
								<span id="inputSuccess3Status" class="sr-only">(success)</span>
								</div>
								</div>	<?php	$x++;
					} 
					
				}
				else {	?>
						<div class="form-group">
						<label class="col-sm-5 control-label">année</label>
						<div class="col-sm-4 col-xs-6">
						<input type="text" class="form-control" placeholder="année" name="année">
						</div>
						</div>	<?php
					
				}
				if ( isset($_POST["spécialitée"]) )
					{
					if ($_POST["spécialitée"]=='') 
						{		?>
								<div class="form-group has-error  has-feedback">
								<label class="control-label col-sm-5" for="inputError2">spécialitée</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="spécialitée" placeholder="invalide">
								<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
								</div>
								</div>	<?php
						}
					else{		?>
								<div class="form-group has-success has-feedback">
								<label class="control-label col-sm-5" for="inputSuccess3">spécialitée</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status"  name="spécialitée" value="<?php echo $_POST["spécialitée"]?>">
								<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
								<span id="inputSuccess3Status" class="sr-only">(success)</span>
								</div>
								</div>	<?php	$x++;
					} 
					
				}
				else {	?>
						<div class="form-group">
						<label class="col-sm-5 control-label">spécialitée</label>
						<div class="col-sm-4 col-xs-6">
						<input type="text" class="form-control" placeholder="spécialitée" name="spécialitée">
						</div>
						</div>	<?php
					
				}
				if ( isset($_POST["exemplaires"]) )
					{
					if ($_POST["exemplaires"]<=0 or !is_numeric($_POST["exemplaires"])) 
						{		?>
								<div class="form-group has-error  has-feedback">
								<label class="control-label col-sm-5" for="inputError2">exemplaires</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status"  name="exemplaires" placeholder="invalide ( 1 minimum )">
								<span class="glyphicon glyphicon-remove  form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
								</div>
								</div>	<?php
						}
					else{		?>
								<div class="form-group has-success has-feedback">
								<label class="control-label col-sm-5" for="inputSuccess3">exemplaires</label>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status" name="exemplaires" value="<?php echo $_POST["exemplaires"]?>">
								<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
								<span id="inputSuccess3Status" class="sr-only">(success)</span>
								</div>
								</div>	<?php	$x++;
					} 
					
				}
				else {	?>
						<div class="form-group">
						<label class="col-sm-5 control-label">exemplaires</label>
						<div class="col-sm-4 col-xs-6">
						<input type="text" class="form-control" name="exemplaires" value="1">
						</div>
						</div>	<?php
					
				}
				?>

			</br>
			<p class="text-center">
			<button type="submit" class="btn btn-primary btn-lg ">Valider</button>
			<button type="reset" class="btn btn-default btn-lg ">Reset</button>
			</p>
			<?php 
			if ($x==5) { 
				include("connexionSQL.php");
				$reqAj = "INSERT INTO `bibliotheque`.`livres` (`livre_titre`,`livre_auteur`,`livre_annee`,`livre_specialitee`,`livre_exemplaires`,`livre_exemplaires_total`) VALUES ('".$_POST["titre"]."','".$_POST["auteur"]."','".$_POST["année"]."','".$_POST["spécialitée"]."','".$_POST["exemplaires"]."','".$_POST["exemplaires"]."')";
				$resReq = mysqli_query($connexion, $reqAj);	
					if (!$resReq)     die('Could not query:' . mysql_error());
					else {
						?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp livre ajouter avec succés</div></center><?php 
					}
			}
			elseif ( isset($_POST["titre"]) or isset($_POST["auteur"]) or isset($_POST["année"]) or isset($_POST["spécialitée"]) or isset($_POST["exemplaires"]) ) 
			{ ?></br><center><div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp veiller remplir les champs invalides!</div></center><?php }
			
			?>
			
			

		
	</div>
</div>		

		</form>

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
