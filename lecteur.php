
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="css/style_login.css" rel="stylesheet">
    <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
  <link href="css/dashboard.css" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style1.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php  	session_start();
include('connexionSQL.php');
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

		  


      
        <div class="col-sm-1 col-md-2  sidebar">
          <ul class="nav nav-sidebar sidebar-a">
            <li ><a a href="dashboard.php">Aperçu </a></li>
            <li><a href="livres_liste.php">Livres</a></li>
            <li class="active"><a href="lecteur.php">Lecteurs</a></li>
			<li><a href="prets_liste.php">Prêts</a></li>
            <li><a href="parametres.php">Paramètres</a></li>
          </ul>
         
        </div>

<div class="row">


<?php

if (isset($_GET['mod'])){
$id=$_GET['mod'];
$reqRech = "SELECT * FROM `lecteurs` WHERE `user_id`='{$_GET["mod"]}'";
$res = mysqli_query($connexion, $reqRech);
$row=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<br/>
      
	<div class="container">
     <div class="row">
        <form action="lecteur.php?mod=<?php echo$id;?>" method="POST" >
            <div class="col-lg-offset-3 col-lg-6">
			
			<div class="form-group">
                    <label for="id">ID:</label>
                    <div class="input-group">
                        <input style="color:red;" type="text" class="form-control" name="id" id="id" placeholder="Enter Name" value="<?php echo $row["user_id"];?>" disabled >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <div class="input-group">
                        <input style="color:red;" type="text" class="form-control" name="nom" id="nom" placeholder="Enter nom" value="<?php echo $row["nom"];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="prenom">Prenom:</label>
                    <div class="input-group">
                        <input style="color:red;" type="text" class="form-control" name="prenom" id="prenom" placeholder="Enter prenom" value="<?php echo $row["prenom"];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				
                <div class="form-group">
                    <label for="mail"> Email:</label>
                    <div class="input-group">
                        <input style="color:red;" type="email" class="form-control" id="mail" name="mail" placeholder="email"  value="<?php echo $row["email"];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <div class="input-group">
                        <input style="color:red;" type="password" class="form-control" id="pass" name="password" placeholder="password"  value="<?php echo $row["pass"];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="col-sm-10 well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <input type="submit" name="valider" id="valider" value="valider" class="btn btn-info pull-right">
            </div>
        </form>
    </div>
</div>							
   </div>
   
   
   
<?php 
if (isset($_POST['valider'])){

$req = "UPDATE `lecteurs` SET `nom`='{$_POST["nom"]}',`prenom`='{$_POST["prenom"]}',`pass`='{$_POST["password"]}',`email`='{$_POST["mail"]}' WHERE `user_id`='{$_GET["mod"]}' ";
						$res= mysqli_query($connexion, $req);	
						if (!$res)     die('</br><center><div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp email existe!</div></center>' . mysql_error());
				?></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp modification successs!</div></center>
				<script type="text/javascript">setTimeout('window.location.replace("lecteur.php")', 4000);</script>
					<?php	}
										


						}					
					
					
 elseif(isset($_GET['supp'])){
 
 $req = "Delete FROM `lecteurs` WHERE `user_id`='".$_GET["supp"]."'";
				$resReq = mysqli_query($connexion, $req);	
					if (!$resReq)     die('Could not query:' . mysql_error());
				if (mysqli_affected_rows($connexion)==1){
				echo"	</br></br></br></br><div class='alert alert-success' role='alert'><center>lecteur supprimer avec succés</center></div>";
				header( "refresh:1;url=lecteur.php" );
                               }
}
else{
 ?>
<div class="col-sm-9 col-sm-offset-5 ">
         <span class="glyphicon glyphicon-search"> </span> <b> recherche d'utilisateur :</b>
		</div>
		<div class="col-md-8 col-md-offset-2 ">
							
			<div class="col-md-offset-3 ">
			<form class="navbar-form navbar-left" action="lecteur.php" method="GET">
				<select class="form-control" name="recherche" >
					
					<option value="user_id">Lecteur id: </option>
					<option value="num_carte">Carte d'utidiant: </option>
					<option value="nom">Lecteur nom: </option>
					<option value="prenom">Lecteur prenom: </option>
					<option value="email">Lecteur Email: </option>
					<option value="specialite">Lecteur specialite : </option>
				</select>
			<div class="form-group">
			<input type="text" class="form-control" placeholder="rechercher" name="user">
			</div>

			<button type="submit" class="btn btn-default">chercher</button>
			<input type="button"  class=" btn btn-success" value="afficher" data-toggle="modal" data-target="#myModal1"> 
			</form>
			</div>
			</div>
		
			



<div class="modal fade bs-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="ModlLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-body">
	 
<html>
<title>LISTE DE LECTEURS</title>

<head>

<style>

 #pagination1 table{
    width:800px;
	margin:0px auto;
	font-family:Tahoma,Arial,Verdana,sans-serif;
	font-size:13px;
	padding:4px;
	 border-collapse: collapse;
  }
  .head{
  background:lightseagreen;
  }
 #pagination1 table tr td{
    padding: 8px;
	text-transform:capitalize;
	border:1px solid #d1d1d1;
	}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style1.css" />

</head>
<body>

<?php
if (isset($_GET['user'])){ ?>



<div id="mhead"><h2>LISTE DE LECTEURS</h2></div>

<div id="pagination1" cellspacing="0">

<?php

	
include('connexionSQL.php');

 $recherche=$_GET['user'];
  $sql = "SELECT * FROM `lecteurs` WHERE ".$_GET["recherche"]."='$recherche'";

 

 $res=mysqli_query($connexion,$sql);
 if ( mysqli_num_rows($res) > 0 ){
 echo"<table><tr class='head'><td>ID</td><td>carte etudiant</td><td>Nom</td><td>Prenom</td><td>Email</td><td>Pass</td><td>Specialité</td><td>status</td><td>Action</td></tr>";
  while ($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) {
  
   if($row['status']==1){

echo "<tr ><td>$row[user_id]</td><td>$row[num_carte]</td><td>$row[nom]</td><td>$row[prenom]</td><td>$row[email]</td><td>$row[pass]</td><td>$row[specialite]</td><td style='text-align:center'><span class='label label-info label-mini'>Due</span></td><td><form id='1'action='lecteur.php'  methode='GET'></form>
       <form id='2' action='prets_ajout.php'  methode='GET'></form> 
	<button form='1' type='submit' name='mod' value='$row[user_id]'     class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button>
		<button form='1' type='submit' name='supp' value='$row[user_id]'     class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button>
		<button form='2' type='submit' name='id_lec' value='$row[user_id]'     class='btn btn-primary btn-xs'><i class='fa fa-plus-square'></i>
</button>
		</td></tr>";
}
else{

echo "<tr ><td>$row[user_id]</td><td>$row[num_carte]</td><td>$row[nom]</td><td>$row[prenom]</td><td>$row[email]</td><td>$row[pass]</td><td>$row[specialite]</td><td style='text-align:center'><span class='label label-danger label-mini'>banned</span></td><td><form id='1'action='lecteur.php'  methode='GET'></form>
       <form id='2' action='prets_ajout.php'  methode='GET'></form> 
	<button form='1' type='submit' name='mod' value='$row[user_id]'     class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button>
		<button form='1' type='submit' name='supp' value='$row[user_id]'     class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button>
		<button form='2' type='submit' name='id_lec' value='$row[user_id]'     class='btn btn-primary btn-xs'><i class='fa fa-plus-square'></i>
</button>
		</td></tr>";
}
     
 }
 }
 else echo"<h2 style='text-align:center;color:red;'>PAS DE RESULTAT</h2>";
 }  
 
  

?>
</table>
</div>

</body>
</html>

   </div>
	   
      
    </div>
  </div>
</div>

		</div>
		<br/>
		<div class="col-sm-9 col-sm-offset-5 ">
         <span class="glyphicon glyphicon-plus"></span><b> ajouter un nouveau utilisateur :</b>
		</div>
		<div class="col-md-7 col-md-offset-2 ">
		
<button type="button" class="col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#myModal2"> <span class="glyphicon glyphicon-plus"></span> Ajouter</button> 
        </div>
<div class="modal fade bs-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLa" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<link rel="stylesheet" type="text/css" href="css/style_lecteurs.css" />
					</head>
					<body>
					<div class="container-fluid">
					<div class="row">
					<h1>Ajouter Lecteur</h1>
					<form action="submit.php" method="post" id="signupForm">
					<div class="fieldContainer">
					<div class="formRow">
						<div class="label">
						<label for="Ncarte">N° carte:</label>
						</div>
						<div class="field">
						<input type="text" name="Ncarte" id="Ncarte" placeholder="012345"/>
						</div>
					</div></br>
					<div class="formRow">
						<div class="label">
						<label for="nom">nom:</label>
						</div>
						<div class="field">
						<input type="text" name="nom" id="nom" placeholder="nom"/>
						</div>
					</div></br>
					<div class="formRow">
						<div class="label">
						<label for="prenom">prenom:</label>
						</div>
						<div class="field">
						<input type="text" name="prenom" id="prenom" placeholder="prenom"/>
						</div>
					</div></br>					
					<div class="formRow">
						<div class="label">
						<label for="pass">Password:</label>
						</div>
						<div class="field">
						<input type="text" name="pass" id="pass" placeholder="mot de pass"/>
						</div>
					</div></br>
					<div class="formRow">
						<div class="label">
						<label for="spec">Spécialité:</label>
						</div>
						<div class="field">
						<input type="text" name="spec" id="spec" placeholder="Spécialité"/>
						</div>
					</div> </br>
					<div class="formRow">
						<div class="label">
						<label for="email">Email:</label>
						</div>
						<div class="field">
						<input type="text" name="email" id="email" placeholder="email@mail.com"/>
						</div>
					</div> </br>
					<div class="formRow">
						<div class="label">
						<label for="annee">Année d'étude:</label>
						</div>
						<div class="field">
						<input disabled type="text" name="annee" id="annee" value="<?php echo date("Y",strtotime("-1 year"))."/".date("Y"); ?>"/>
						</div>
					</div> </br>



					</div> <!-- Closing fieldContainer -->

					<div class="signupButton">
					<input type="submit" name="submit" id="submit" value="Signup" />
					</div>

					</form>

					</div></div>

					

					<script type="text/javascript" src="js/jquery.min.js"></script>
					<script type="text/javascript" src="js/script.js"></script>

					</body>
					</html>

   
						
   </div>
	   
      
    </div>
  </div>
</div>


<br/><br/><br/>


<div style="padding-left:120px; padding-bottom:20px;">
<div  id="pagination" cellspacing="0"></div>
</div>
<div  style="padding-left:280px;padding-top:10px;padding-bottom:10px;" class="color-swatches">
			<h5 style="display: inline-block"><b>Index couleurs: &nbsp </b></h5>
			  <div class="color-swatch brand-danger" data-tooltip="top" title="utilisateur ne peut pas preter"></div>
			  <div class="color-swatch brand-blue" data-tooltip="top" title="utilisateur peut preter"></div>
			</div>









     
	 <?php 
	 }
	}
	else
		{
		?></br></br></br><center><div class="alert alert-danger" role="alert">Accés non autorisé </div></center><?php
		header( "refresh:0;url=index.php" );
		}
	?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script_lecteurs.js"></script>
<script src="js/myscript.js"></script>
</body>
</html>