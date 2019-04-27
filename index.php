<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
    <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
  <script src="js/prefixfree.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<header>

	 <nav class="navbar navbar-default navbar-fixed-top menu "  role="navigation">
	 
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
          <li class="active"><a href="#home">Home</a></li>
		  <li><a href="#mission">Mission</a></li>
          <li><a href="#services">recherche livres</a></li>
		  <li><a href="#contact">contact</a></li>
		  <?php session_start();  if(isset($_SESSION["nom"])){if ($_SESSION["nom"]=="utilisateur") {
				include("connexionSQL.php");
				$req = "SELECT count(*) FROM `prets` WHERE `Lecteur_id`='".$_SESSION["id"]."' AND `notification`=1";
				$res = mysqli_query($connexion, $req);	 if (!$res)     die('Could not query:' . mysql_error());
				$rowNot = mysqli_fetch_array($res, MYSQLI_ASSOC);
				if ( $rowNot["count(*)"]>0 ) $notif=$rowNot["count(*)"]; else $notif=""; ?>
				<li class="dropdown ">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Espace utilisateur <span class="badge"><?php echo $notif; ?></span><span class="caret"></span></a>
				  <ol class="dropdown-menu" role="menu">
					<li><a href="utlisateur_profile.php" class="active">Profile <span class="badge"><?php echo $notif; ?></span></a></li>
					<li class="divider"></li>
					<li><a href="utlisateur_historique.php">Historique</a></li>
				  </ol>
		  </li> <?php } } ?>
		  <?php if(isset($_SESSION["nom"])){if ($_SESSION["nom"]=="admin") { ?> <li><a href="dashboard.php">dashboard</a></li> <?php }  }  ?>
          <?php  if(isset($_SESSION["nom"])) { ?> <li><a href="logout.php">Logout</a></li> <?php } else { ?> <li><a href="login.php">Login</a></li> <?php } ?> 
        </ul>        
      </div>
    </div>
  </nav>
 
  <div class="carousel slide" data-ride="carousel" id="home">
   
   <ol class="carousel-indicators">

    <li data-target="#home" data-slide-to="0"></li>
	<li data-target="#home" data-slide-to="1"></li>
	<li data-target="#home" data-slide-to="2"></li>
	<li data-target="#home" data-slide-to="3"></li>
  </ol>
  
  
	 <div class="carousel-inner fullheight">
    

				 <div class="active item">
					  <div class="fill" style="background-image:url('images/389877.jpg');">
						<div class="container">
                    <div style=" color:white;padding-bottom:30px" class="carousel-caption">
                        <b><h1>Bienvenue a notre site!</h1></b>
                        <b><p>prend une toure et laissez-nous savoir si vous avez des questions.</p></b>
                    </div>
					  </div>
					  </div>
					</div>
					<div class="item">
					  <div class="fill" style="background-image:url('images/389881.jpg');">
						<div class="container">
                    <div  style="padding-bottom:30px"class="carousel-caption">
                        <b><h1>Mission</h1></b>
                        <b><p>voir des details sur notre site</p></b>
                        <p><a href="index.php#mission" class="btn btn-lg btn-primary scroll-link"  role="button">Mission</a></p>
                    </div>
                </div>
					</div>	 
					</div>
					<div class="item">
					  <div class="fill" style="background-image:url('images/2108610495.jpg');">
						<div class="container">
                    <div  style="padding-bottom:30px"class="carousel-caption">
                       <b> <h1>recherche</h1></b>
                       <b> <p>rechercher nos livres</p></b>
                        <p><a href="index.php#services" class="btn btn-lg btn-primary scroll-link"  role="button">Rcherche</a></p>
                    </div>
                </div>
					</div>
					  </div>
					
					<div class="item">
					  <div class="fill" style="background-image:url('images/banner.jpg');">
						 <div class="container">
                    <div  style="padding-bottom:30px"class="carousel-caption">
                       <b> <h1>contact</h1></b>
                       <b> <p>contact us! </p></b>
                        <p><a href="index.php#contact" class="btn btn-lg btn-primary scroll-link"  role="button">contact</a></p>
                    </div>
                </div>
					  </div>
					</div>	
    </div>

        <a class="left carousel-control" href="#home" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#home" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  </div>  
  
  
</header>

<div class="main">
  <div class="page" id="mission">
    <div class="content container">
      <h2 style="color:red">Our Mission</h2>      
      <p>Notre objet est de realiser un site de gestion d'une bibliotheque en ligne , qui permet aux lecteurs de consulter des livres et en plus savoir leur historique dans la bibliotheque et facilite le role son administrateur. .</p>
    </div>
  </div>
  <div class="page" id="services">
   <div class="container container ">
     <h2 style="color:red;">SERVICES</h2>
	 
    <div class="col-sm-offset-2 input-group ">
		<span class="glyphicon glyphicon-search pull-left"> </span> <span style="color:red;" class="pull-left">recherche livre: :</span>
					<form class="navbar-form navbar-left" action="index.php" method="GET">
				<select class="form-control" name="recherche" >
					<option value="livre_titre">livre_titre: </option>
					<option value="livre_specialitee">livre specialite: </option>
					<option value="livre_auteur">livre auteur: </option>
					<option value="livre_annee">livre annee : </option>
				</select>
			<div class="form-group">
			<input type="text" class="form-control" placeholder="rechercher" name="livre">
			</div>

			<button type="submit" class="btn btn-default">chercher</button>
			</form>
			</div>

<?php
include('connexionSQL.php');
if ( isset($_GET["recherche"]) ){
 $recherche=$_GET['livre'];

     if (isset($_GET["start"])) {
	 $start=$_GET["start"];
	 if(strlen($start) > 0 and !is_numeric($start) or $start<0 ){ echo "Erreur parametres url"; exit; } 
  }
  else  $start=0;
							$page_name="index.php";
	
							$limit =  8;
							$back = $start - $limit;
							$next = $start + $limit;
							$reqRech = "SELECT * FROM `livres` WHERE ".$_GET["recherche"]."='$recherche' LIMIT {$start},{$limit} ";
							$resReq = mysqli_query($connexion, $reqRech);
							if (!$resReq)     die('Could not query:' . mysql_error());
								$reqNbr = "SELECT count(*) FROM `livres` WHERE ".$_GET["recherche"]."='$recherche'";
								$resReqNbr = mysqli_query($connexion, $reqNbr); 
								$row = mysqli_fetch_array($resReqNbr, MYSQLI_ASSOC);
								$nbrLignes =  $row["count(*)"]; 
								if ( mysqli_num_rows($resReq) > 0 )	
									{		
									while ($row = mysqli_fetch_array($resReq, MYSQLI_ASSOC) ) {
					?>
					
				

					<div class="col-sm-3 service">
    <div class="thumbnail">
      <img class="icon" src="images/cover.jpg" alt="...">
      <div class="caption">
       
                                <p style="color:red;"><?php echo $row["livre_titre"]; ?> </p>
                                <p style="color:blue;">AUTEUR :<span style="color:black;"> <?php echo $row["livre_auteur"]; ?></span> </p>
								<p style="color:blue;">ANNEE:  <span style="color:black;"><?php echo $row["livre_annee"]; ?> </span></p>
								<p style="color:blue;">NEMBRE EXEMPLAIRE :<span style="color:black;"> <?php echo $row["livre_exemplaires_total"]; ?> </span></p>
								<?php 
                                  
								 if($row["livre_exemplaires"]==0){
								 echo"<button  class='btn btn-danger pull-right'>indesponible</button>";
								  
								  }
								  else echo"<button  class='btn btn-primary pull-right'>desponible</button>";;

								?>
								<br>

      </div>
    </div>
	</div>

  
					
					<?php }?>
					             
									<center>
									<div class="row">
									<nav>
									  <ul class=" pagination">
										<?php if($back >=0) { ?> <li class="previous"><a href="<?php echo $page_name."?recherche=".$_GET["recherche"]."&livre=".$_GET["livre"]."&start=".($start-$limit);?>"><span aria-hidden="true">&larr;</span> Precedent </a></li> <?php } ?> 
										<?php 
										$p=1;
										for($i=0;$i<$nbrLignes;$i+=$limit)
											{
											if ($i<>$start) { echo "<li><a href=\"{$page_name}?recherche={$_GET["recherche"]}&livre={$_GET["livre"]}&start={$i}\">{$p}</a></li>"; }
											else {	?> <li class="active"><a><?php echo $p;?></a></li>	<?php } 
											$p++;
											}
										?>
										<?php if($next < $nbrLignes) { ?> <li   class="next"><a href="<?php echo $page_name."?recherche=".$_GET["recherche"]."&livre=".$_GET["livre"]."&start=".($start+$limit);?>">Suivant <span aria-hidden="true">&rarr;</span></a></li> <?php  } ?>
									  </ul>
									  
									</nav>
									</center>
									</div>
<?php									
}
}
?>


<hr>

</div>
</div>
<div class="page" id="contact">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div >
                <form class="form-horizontal" method="post" action="index.php">
                   
                        <legend class="text-center style">Contact us</legend>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="fname" name="name" type="text" placeholder="First Name" class="form-control"required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="lname" name="name" type="text" placeholder="Last Name" class="form-control"required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="email" name="email" type="email" placeholder="Email Address" class="form-control"required>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here." rows="7"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div><legend class="text-center style">contacter nous!</legend>
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h4>Address</h4>
                        <div>
                            Algeria, Batna
                            <hr />
                            univ@batna.org
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/myscript.js"></script>
</body>
</html>
