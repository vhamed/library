<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LIBRARY</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style_login.css"> 
  <link href='css/googlefonts.css' rel='stylesheet' type='text/css'>  
  <script src="js/prefixfree.min.js"></script>
    <!-- Custom styles for this template -->
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
<body class="background_dashboard" onload="func1(); func2();func3();func4(); ">

		  

 <div class="container-fluid">
      <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2  sidebar">
          <ul class="nav nav-sidebar sidebar-a">
            <li class="active"><a href="dashboard.php">Aperçu <span class="sr-only">(current)</span></a></li>
            <li><a href="livres_liste.php">Livres</a></li>
            <li><a href="lecteur.php">Lecteurs</a></li>
			<li><a href="prets_liste.php">Prêts</a></li>
            <li><a href="parametres.php">Paramètres</a></li>
          </ul>
         
        </div>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          </br><h1 class="page-header"><b>Dashboard</b></h1>
		  <?php 
			include("connexionSQL.php");
			$req = "SELECT count(*) as a FROM `lecteurs`";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_lecteurs = $row["a"];
			$req = "SELECT count(*) as a FROM `livres`";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_livres = $row["a"];
			$req = "SELECT count(*) as a FROM `livres` where `livre_exemplaires`>0";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_livres_disponible = $row["a"];
			$req = "SELECT SUM(`livre_exemplaires`) as a FROM `livres` ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_exemplaires_disponible = $row["a"];
			$req = "SELECT SUM(`livre_exemplaires_total`) as a FROM `livres` ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_exemplaires = $row["a"];
			$req = "SELECT count(*) as a FROM `prets`";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_prets = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM `prets` WHERE `Date_retour`!='0000-00-00'";		//retourné
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_prets_retouner = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM `prets` WHERE `Date_retour`!='0000-00-00' AND `temps_ecoule`=1 ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_prets_retouner_temp_non_ecouler = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM `prets` WHERE `Date_retour`!='0000-00-00' AND `temps_ecoule`=0 ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_prets_retouner_temp_ecouler = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM `prets` WHERE `Date_retour`='0000-00-00'";		//non retourné
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_prets_non_retouner = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM `prets` WHERE `Date_retour`='0000-00-00' and `temps_ecoule`=1 ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_prets_non_retouner_temp_ecouler = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM `prets` WHERE `Date_retour`='0000-00-00' and `temps_ecoule`=0 ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$nombre_prets_non_retouner_temp_non_ecouler = $row["a"];
				
			for($i=4;$i>=0;$i--)
			{
			$req = "SELECT COUNT(*) AS a FROM prets WHERE YEAR(`Date_pret`) = YEAR(CURRENT_DATE - INTERVAL {$i} MONTH) AND MONTH(`Date_pret`) = MONTH(CURRENT_DATE - INTERVAL {$i} MONTH) AND Date_retour !='0000-00-00' ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$table_nombre_prets_retouner[$i] = $row["a"];
				$table_nombre_prets[$i] = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM prets WHERE YEAR(`Date_pret`) = YEAR(CURRENT_DATE - INTERVAL {$i} MONTH) AND MONTH(`Date_pret`) = MONTH(CURRENT_DATE - INTERVAL {$i} MONTH) AND Date_retour ='0000-00-00' ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$table_nombre_prets_non_retouner[$i] = $row["a"];
				$table_nombre_prets[$i] += $row["a"];
				
			$req = "SELECT COUNT(*) AS a FROM prets WHERE YEAR(`Date_pret`) = YEAR(CURRENT_DATE - INTERVAL {$i} MONTH) AND MONTH(`Date_pret`) = MONTH(CURRENT_DATE - INTERVAL {$i} MONTH) AND Date_retour ='0000-00-00' AND `temps_ecoule`=1";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC); 
				$table_nombre_prets_non_retouner_temp_ecouler[$i] = $row["a"]; 
			$req = "SELECT COUNT(*) AS a FROM prets WHERE YEAR(`Date_pret`) = YEAR(CURRENT_DATE - INTERVAL {$i} MONTH) AND MONTH(`Date_pret`) = MONTH(CURRENT_DATE - INTERVAL {$i} MONTH) AND Date_retour ='0000-00-00' AND `temps_ecoule`=0";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$table_nombre_prets_non_retouner_temp_non_ecouler[$i] = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM prets WHERE YEAR(`Date_pret`) = YEAR(CURRENT_DATE - INTERVAL {$i} MONTH) AND MONTH(`Date_pret`) = MONTH(CURRENT_DATE - INTERVAL {$i} MONTH) AND Date_retour !='0000-00-00' AND `temps_ecoule`=1";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$table_nombre_prets_retouner_temp_ecouler[$i] = $row["a"];
			$req = "SELECT COUNT(*) AS a FROM prets WHERE YEAR(`Date_pret`) = YEAR(CURRENT_DATE - INTERVAL {$i} MONTH) AND MONTH(`Date_pret`) = MONTH(CURRENT_DATE - INTERVAL {$i} MONTH) AND Date_retour !='0000-00-00' AND `temps_ecoule`=0";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$table_nombre_prets_retouner_temp_non_ecouler[$i] = $row["a"];
			}
			for($i=11,$temp=0;$i>=0;$i--)
			{
			$req = "SELECT COUNT(*) AS a FROM livres WHERE YEAR(`livre_date_ajout`) = YEAR(CURRENT_DATE - INTERVAL {$i} MONTH) AND MONTH(`livre_date_ajout`) = MONTH(CURRENT_DATE - INTERVAL {$i} MONTH) ";
			$res = mysqli_query($connexion, $req); if (!$res)     die('Could not query:' . mysql_error());
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC); 
				$table_nombre_nouveaux_livres[$i] = $row["a"];
				$temp+=$row["a"];
			if (isset($table_nombre_livres[($i+1)])) {$table_nombre_livres_ancien[$i]=$table_nombre_livres[($i+1)]; } else $table_nombre_livres_ancien[$i]=0;
				$table_nombre_livres[$i] = $temp;
				
			}
		  ?>
		   </br>

		   <div class="datagrid"><table>
			<thead><tr><th>Total Lecteurs:</th><th>Total Livres:</th><th>Livres disponibles:</th><th>Livres non disponibles:</th></tr></thead>
			<tbody><tr><td><?php echo $nombre_lecteurs;?></td><td><?php echo $nombre_livres;?></td><td><?php echo $nombre_livres_disponible;?></td><td><?php echo $nombre_livres- $nombre_livres_disponible;?></td></tr>
			<tr><td colspan="3"><a style="color: black" href="" data-toggle="modal" data-target="#myModal4"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Graphiques en aires du Total des livres des 12 dernier mois </a></td></tr>	
			</tbody>
		</table>
		</div> 
		</br>
		 <div class="datagrid"><table>
			<thead><tr><th>Total Prêts:</th><th>Prêts retourner:</th><th>Prêts non retourner:</th></tr></thead>
			<tbody><tr><td><?php echo $nombre_prets;?></td><td><?php echo $nombre_prets_retouner;?></td><td><?php echo $nombre_prets_non_retouner;?></td></tr>
			<tr><td colspan="3"><a style="color: black" href="" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Diagramme en secteurs des prêts </a></td></tr>	
			<tr><td colspan="3"><a style="color: black" href="" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Histogramme des prêts des 5 dernier mois</a></td></tr>	
			<tr><td colspan="3"><a style="color: black" href="" data-toggle="modal" data-target="#myModal3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Histogramme empilé des prêts des 5 dernier mois </a></td></tr>
			</tbody>
		</table>
		</div> 
		</br>
		 <div class="datagrid"><table>
			<thead><tr><th>Total exemplaires:</th><th>exemplaires disponibles:</th><th>exemplaires non disponibles:</th></tr></thead>
			<tbody><tr><td><?php echo $nombre_exemplaires;?></td><td><?php echo $nombre_exemplaires_disponible;?></td><td><?php echo $nombre_exemplaires-$nombre_exemplaires_disponible;?></td></tr></tbody>
		</table>
		</div> 
		</br>


		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-md">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<div id="chartContainer" style="height: 600px; width: 570px;"></div>
				
			  </div>
			  <div class="modal-footer">
				<h4 class="modal-title" id="myModalLabel"><center><b><?php echo "Prêts retourner: ".$nombre_prets_retouner;?> , <?php echo "Prêts non retourner: ".$nombre_prets_non_retouner;?></b></center></h4>
			  </div>
			</div>
		  </div>
		</div>

		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<div id="chartContainer2" style="height: 650px; width: 850px;">  </div>
			  </div>
			</div>
		  </div>
		</div>

		<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<div id="chartContainer3" style="height: 650px; width: 430px;display: inline-block;">  </div><div id="chartContainer4" style="height: 650px; width: 430px;display: inline-block;">  </div>
			  </div>
			</div>
		  </div>
		</div>

		<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<div id="chartContainer5" style="height: 650px; width: 850px;"></div>
			  </div>
			</div>
		  </div>
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
<script type="text/javascript" src="js/canvasjs.min.js"></script>
<script type="text/javascript">

//---------------------------2--------------------------
function func2() {
        CanvasJS.addColorSet("couleurs1",
                [
                "rgba(44, 137, 210, 1)",
                "rgba(239, 26, 48, 1)",
                "green",
                "rgba(255, 158, 58, 1)",
                ]);
	var chart = new CanvasJS.Chart("chartContainer",
	{
		theme: "theme2",animationEnabled: true,animationDuration: 1000,exportEnabled: true,exportFileName: "Chart",colorSet: "couleurs1",
		legend:{  fontFamily: "Times New Roman",fontSize: 15, itemWidth: 300,  horizontalAlign: "right"},
		title:{       fontFamily: 'sans-serif', text: "Détailles sur tous les prêts",fontSize: 32,   },
		data: [
		{       
			type: "pie", indexLabelFontColor: "black", indexLabelLineColor: "black",indexLabelLineThickness:1,
			showInLegend: true,
			toolTipContent: "{y} prêts",
			legendText: "{indexLabel}  prêts",
			dataPoints: [
				{  y: <?php echo $nombre_prets_non_retouner_temp_non_ecouler;?>, indexLabel: "{y}" , exploded: true , legendText:"non retourner + temps non excédé"},
				{  y: <?php echo $nombre_prets_non_retouner_temp_ecouler;?>, indexLabel: "{y}", exploded: true, legendText:"non retourner + temps excédé" },
				{  y: <?php echo $nombre_prets_retouner_temp_non_ecouler;?>, indexLabel: "{y}" , legendText:"retourner dans le temps"},
				{  y: <?php echo $nombre_prets_retouner_temp_ecouler;?>, indexLabel: "{y}", legendText:"retourner aprés le temps"},
			]
		}		
		]
	});
	
	
				$('#myModal').on('shown.bs.modal',function func2(){
				$('#myModal').focus();
				chart.render();
			});
};
//----------------------3------------

function func1() {
        CanvasJS.addColorSet("couleurs1",
                [
                "rgba(22, 134, 138, 1)",
                "rgba(0, 124, 0, 1)",
                "rgba(255, 147, 0, 1)",
                ]);
		
	var chart2 = new CanvasJS.Chart("chartContainer2",
    {
	  axisX:{      gridThickness: 1 ,       gridColor: "black", gridDashType: "dot" ,   },
	  axisY:{      gridThickness: 1 ,       gridColor: "black", gridDashType: "dot" ,   },
	  legend:{  fontFamily: "Times New Roman",fontSize: 14, itemWidth: 300,  horizontalAlign: "right"},
	  theme: "theme1",animationEnabled: true,animationDuration: 1000,exportEnabled: true,exportFileName: "Chart",colorSet: "couleurs1",zoomEnabled:true,backgroundColor: "rgba(255,255,255,0.3)",
	  toolTip: {content:"{y}: prêts" ,},
	  title:{        text: "Prêts des 5 dernier mois",fontSize: 32,   },

      data: [
      {
		bevelEnabled: true,
        type: "column",
		showInLegend: "true",
		legendText: "Total Prêts",
        dataPoints: [
        {  y: <?php echo $table_nombre_prets[4]; ?>  , label: "<?php echo date('M', strtotime('-4 month'));?>"},
        {  y: <?php echo $table_nombre_prets[3]; ?>  , label: "<?php echo date('M', strtotime('-3 month'));?>"},
        {  y: <?php echo $table_nombre_prets[2]; ?>  , label: "<?php echo date('M', strtotime('-2 month'));?>"},
        {  y: <?php echo $table_nombre_prets[1]; ?>  , label: "<?php echo date('M', strtotime('-1 month'));?>"},
		{  y: <?php echo $table_nombre_prets[0]; ?>  , label: "<?php echo date('M', strtotime('-0 month'));?>"},
        ]
      }, {
        type: "column",bevelEnabled: true,
		showInLegend: "true",
		legendText: "Prêts retourné",
        dataPoints: [
        {  y: <?php echo $table_nombre_prets_retouner[4]; ?>  , label: "<?php echo date('M', strtotime('-4 month'));?>"},
        {  y: <?php echo $table_nombre_prets_retouner[3]; ?>  , label: "<?php echo date('M', strtotime('-3 month'));?>"},
        {  y: <?php echo $table_nombre_prets_retouner[2]; ?>  , label: "<?php echo date('M', strtotime('-2 month'));?>"},
        {  y: <?php echo $table_nombre_prets_retouner[1]; ?>  , label: "<?php echo date('M', strtotime('-1 month'));?>"},
		{  y: <?php echo $table_nombre_prets_retouner[0]; ?>  , label: "<?php echo date('M', strtotime('-0 month'));?>"},
        ]
      } , {
        type: "column",bevelEnabled: true,
		showInLegend: "true",
		legendText: "Prêts non retourné",
        dataPoints: [
        {  y: <?php echo $table_nombre_prets_non_retouner[4]; ?>  ,label: "<?php echo date('M', strtotime('-4 month'));?>"},
        {  y: <?php echo $table_nombre_prets_non_retouner[3]; ?>  ,label: "<?php echo date('M', strtotime('-3 month'));?>"},
        {  y: <?php echo $table_nombre_prets_non_retouner[2]; ?>  ,label: "<?php echo date('M', strtotime('-2 month'));?>"},
        {  y: <?php echo $table_nombre_prets_non_retouner[1]; ?>  ,label: "<?php echo date('M', strtotime('-1 month'));?>"},
		{  y: <?php echo $table_nombre_prets_non_retouner[0]; ?>  ,label: "<?php echo date('M', strtotime('-0 month'));?>"},
        ]
      }

      ]
    });
	
				$('#myModal2').on('shown.bs.modal',function func1(){
				$('#myModal2').focus();
				chart2.render();
				
			});

};

//---------------4--------------------

function func3() {
        CanvasJS.addColorSet("couleurs1",
                [
                "green",
                "rgba(255, 158, 58, 1)" 	]);
		CanvasJS.addColorSet("couleurs2",
                [
                "rgba(44, 137, 210, 1)",
                "rgba(239, 26, 48, 1)" ]);
	
	var chart3 = new CanvasJS.Chart("chartContainer3",
	{
		theme: "theme3",animationEnabled: true,animationDuration: 1000,exportEnabled: true,exportFileName: "Chart",colorSet: "couleurs1",zoomEnabled:true,
		title:{			text: "prêts retourner"	},
		legend:{ fontFamily: "Times New Roman",fontSize: 14,  horizontalAlign: "center"},
	    axisY:{      gridThickness: 1 ,     gridDashType: "dot" },	 
	    toolTip: {content:"{y}: prêts (sur {z})" ,},
		data: [
		{
			type: "stackedColumn",
			legendText: "prêts retourner et temp non ecouler",
			showInLegend: "true", indexLabelFontColor:"black",
			indexLabelFormatter: function(e){		if(e.dataPoint.y==0)			return "";		else return e.dataPoint.y;	},
			dataPoints: [
				{  y: <?php echo $table_nombre_prets_retouner_temp_non_ecouler[4]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[4]+$table_nombre_prets_retouner_temp_non_ecouler[4];?> },
				{  y: <?php echo $table_nombre_prets_retouner_temp_non_ecouler[3]; ?>  , label: "<?php echo date('M', strtotime('-3 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[3]+$table_nombre_prets_retouner_temp_non_ecouler[3];?> },
				{  y: <?php echo $table_nombre_prets_retouner_temp_non_ecouler[2]; ?>  , label: "<?php echo date('M', strtotime('-2 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[2]+$table_nombre_prets_retouner_temp_non_ecouler[2];?> },
				{  y: <?php echo $table_nombre_prets_retouner_temp_non_ecouler[1]; ?>  , label: "<?php echo date('M', strtotime('-1 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[1]+$table_nombre_prets_retouner_temp_non_ecouler[1];?> },
				{  y: <?php echo $table_nombre_prets_retouner_temp_non_ecouler[0]; ?>  , label: "<?php echo date('M', strtotime('-0 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[0]+$table_nombre_prets_retouner_temp_non_ecouler[0];?> },
			]
		},  {
			type: "stackedColumn",
			legendText: "prêts retourner et temp ecouler",
			showInLegend: "true",
			indexLabelFontColor:"black",
			indexLabelFormatter: function(e){		if(e.dataPoint.y==0)			return "";		else return e.dataPoint.y;	},
			dataPoints: [
				{  y: <?php echo $table_nombre_prets_retouner_temp_ecouler[4]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[4]+$table_nombre_prets_retouner_temp_non_ecouler[4];?> },
				{  y: <?php echo $table_nombre_prets_retouner_temp_ecouler[3]; ?>  , label: "<?php echo date('M', strtotime('-3 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[3]+$table_nombre_prets_retouner_temp_non_ecouler[3];?> },
				{  y: <?php echo $table_nombre_prets_retouner_temp_ecouler[2]; ?>  , label: "<?php echo date('M', strtotime('-2 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[2]+$table_nombre_prets_retouner_temp_non_ecouler[2];?> },
				{  y: <?php echo $table_nombre_prets_retouner_temp_ecouler[1]; ?>  , label: "<?php echo date('M', strtotime('-1 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[1]+$table_nombre_prets_retouner_temp_non_ecouler[1];?> },
				{  y: <?php echo $table_nombre_prets_retouner_temp_ecouler[0]; ?>  , label: "<?php echo date('M', strtotime('-0 month')); ?>" , z:<?php echo $table_nombre_prets_retouner_temp_ecouler[0]+$table_nombre_prets_retouner_temp_non_ecouler[0];?> },
			]
		}
		],
	});
	
	$('#myModal3').on('shown.bs.modal',function func3(){
				$('#myModal3').focus();
				chart3.render();
			});

	var chart4 = new CanvasJS.Chart("chartContainer4",
	{
		theme: "theme3",animationEnabled: true,animationDuration: 1000,exportEnabled: true,exportFileName: "Chart",colorSet: "couleurs2",zoomEnabled:true,
		title:{			text: "prêts non retourner"	},
		legend:{ fontFamily: "Times New Roman",fontSize: 14,  horizontalAlign: "center", },
		toolTip: {content:"{y}: prêts (sur {z})" ,},
	    axisY:{      gridThickness: 1 ,     gridDashType: "dot" },	 	  
		data: [
		{
			type: "stackedColumn",
			legendText: "prêts non retourner et temp non ecouler",
			showInLegend: "true", indexLabelFontColor:"black",
			indexLabelFormatter: function(e){		if(e.dataPoint.y==0)			return "";		else return e.dataPoint.y;	},
			dataPoints: [
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[4]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[4]+$table_nombre_prets_non_retouner_temp_ecouler[4];?> },
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[3]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[3]+$table_nombre_prets_non_retouner_temp_ecouler[3];?> },
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[2]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[2]+$table_nombre_prets_non_retouner_temp_ecouler[2];?> },
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[1]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[1]+$table_nombre_prets_non_retouner_temp_ecouler[1];?> },
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[0]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[0]+$table_nombre_prets_non_retouner_temp_ecouler[0];?> },
			]
		},  {
			type: "stackedColumn",
			legendText: "prêts non retourner et temp ecouler",
			showInLegend: "true", 
			indexLabelFontColor:"black",
			indexLabelFormatter: function(e){		if(e.dataPoint.y==0)			return "";		else return e.dataPoint.y;	},
			dataPoints: [
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_ecouler[4]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[4]+$table_nombre_prets_non_retouner_temp_ecouler[4];?> },
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_ecouler[3]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[3]+$table_nombre_prets_non_retouner_temp_ecouler[3];?> },
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_ecouler[2]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[2]+$table_nombre_prets_non_retouner_temp_ecouler[2];?> },
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_ecouler[1]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[1]+$table_nombre_prets_non_retouner_temp_ecouler[1];?> },
				{  y: <?php echo $table_nombre_prets_non_retouner_temp_ecouler[0]; ?>  , label: "<?php echo date('M', strtotime('-4 month')); ?>" , z:<?php echo $table_nombre_prets_non_retouner_temp_non_ecouler[0]+$table_nombre_prets_non_retouner_temp_ecouler[0];?> },
			]
		}
		],
	});
	
	$('#myModal3').on('shown.bs.modal',function func3(){
				$('#myModal3').focus();
				chart4.render();
			});		
};
//-------------------------------------1-------------------------------------------------
function func4() {
	CanvasJS.addColorSet("couleurs4", ["rgba(0, 145, 203, 1)","rgba(0, 157, 48, 1)",  "rgba(255, 147, 0, 1)",    ]);
    var chart5 = new CanvasJS.Chart("chartContainer5",
    {
	  
	  animationEnabled: true,animationDuration: 500,exportEnabled: true,exportFileName: "Chart",zoomEnabled:true,colorSet: "couleurs4",
      title: {        text: "Total des livres des 12 dernier mois",        fontSize: 25      },
      axisX:{        interval:1,   },
      axisY: {        title: "Livres"     }, 
	  toolTip: {shared: true,},
	  legend:{ fontFamily: "Times New Roman",fontSize: 18,  horizontalAlign: "center"},
	  data: [
      {
        type: "area", 
        name: "Total livres",
        showInLegend: "true",
        dataPoints: [
        { label: "<?php echo date('M', strtotime('-11 month'));?>", y: <?php echo  $table_nombre_livres[11]; ?> ,},
        { label: "<?php echo date('M', strtotime('-10 month'));?>", y: <?php echo  $table_nombre_livres[10]; ?> , },
        { label: "<?php echo date('M', strtotime('-9 month'));?>", y: <?php echo  $table_nombre_livres[9]; ?> , },
        { label: "<?php echo date('M', strtotime('-8 month'));?>", y: <?php echo  $table_nombre_livres[8]; ?> ,},
        { label: "<?php echo date('M', strtotime('-7 month'));?>", y: <?php echo $table_nombre_livres[7]; ?> , },
        { label: "<?php echo date('M', strtotime('-6 month'));?>", y: <?php echo $table_nombre_livres[6]; ?> ,},
        { label: "<?php echo date('M', strtotime('-5 month'));?>", y: <?php echo $table_nombre_livres[5]; ?> , },
        { label: "<?php echo date('M', strtotime('-4 month'));?>", y: <?php echo $table_nombre_livres[4]; ?> , },
        { label: "<?php echo date('M', strtotime('-3 month'));?>", y: <?php echo $table_nombre_livres[3]; ?> , },
        { label: "<?php echo date('M', strtotime('-2 month'));?>", y: <?php echo $table_nombre_livres[2]; ?> , },
		{ label: "<?php echo date('M', strtotime('-1 month'));?>", y: <?php echo $table_nombre_livres[1]; ?> , },
		{ label: "<?php echo date('M', strtotime('-0 month'));?>", y: <?php echo $table_nombre_livres[0]; ?> , },

        ]
      },
		{
        type: "area",       
        name: "Nouveaux livres",
        showInLegend: "true",
        dataPoints: [
        { label: "<?php echo date('M', strtotime('-11 month'));?>", y: <?php echo  $table_nombre_nouveaux_livres[11]; ?> ,},
        { label: "<?php echo date('M', strtotime('-10 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[10]; ?> , },
        { label: "<?php echo date('M', strtotime('-9 month'));?>", y: <?php echo  $table_nombre_nouveaux_livres[9]; ?> , },
        { label: "<?php echo date('M', strtotime('-8 month'));?>", y: <?php echo  $table_nombre_nouveaux_livres[8]; ?> , },
        { label: "<?php echo date('M', strtotime('-7 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[7]; ?> , },
        { label: "<?php echo date('M', strtotime('-6 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[6]; ?> , },
        { label: "<?php echo date('M', strtotime('-5 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[5]; ?> , },
        { label: "<?php echo date('M', strtotime('-4 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[4]; ?> , },
        { label: "<?php echo date('M', strtotime('-3 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[3]; ?> , },
        { label: "<?php echo date('M', strtotime('-2 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[2]; ?> , },
		{ label: "<?php echo date('M', strtotime('-1 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[1]; ?> , },
		{ label: "<?php echo date('M', strtotime('-0 month'));?>", y: <?php echo $table_nombre_nouveaux_livres[0]; ?> , },

        ]
      },
      {
        type: "area",
        name: "Ancien livres",
        showInLegend: "true",
        dataPoints: [
        { label: "<?php echo date('M', strtotime('-11 month'));?>", y: <?php echo $table_nombre_livres_ancien[11]; ?> ,},
        { label: "<?php echo date('M', strtotime('-10 month'));?>", y: <?php echo $table_nombre_livres_ancien[10]; ?> , },
        { label: "<?php echo date('M', strtotime('-9 month'));?>", y: <?php echo $table_nombre_livres_ancien[9]; ?> , },
        { label: "<?php echo date('M', strtotime('-8 month'));?>", y: <?php echo $table_nombre_livres_ancien[8]; ?> , },
        { label: "<?php echo date('M', strtotime('-7 month'));?>", y: <?php echo $table_nombre_livres_ancien[7]; ?> , },
        { label: "<?php echo date('M', strtotime('-6 month'));?>", y: <?php echo $table_nombre_livres_ancien[6]; ?> , },
        { label: "<?php echo date('M', strtotime('-5 month'));?>", y: <?php echo $table_nombre_livres_ancien[5]; ?> , },
        { label: "<?php echo date('M', strtotime('-4 month'));?>", y: <?php echo $table_nombre_livres_ancien[4]; ?> , },
        { label: "<?php echo date('M', strtotime('-3 month'));?>", y: <?php echo $table_nombre_livres_ancien[3]; ?> , },
        { label: "<?php echo date('M', strtotime('-2 month'));?>", y: <?php echo $table_nombre_livres_ancien[2]; ?> , },
		{ label: "<?php echo date('M', strtotime('-1 month'));?>", y: <?php echo $table_nombre_livres_ancien[1]; ?> , },
		{ label: "<?php echo date('M', strtotime('-0 month'));?>", y: <?php echo $table_nombre_livres_ancien[0]; ?> , },

        ]
      },
      
      

      ]
    });
	
	$('#myModal4').on('shown.bs.modal',function func4(){
				$('#myModal4').focus();
				chart5.render();
			});		
//*----------------------------------------
};




</script>

</body>
</html>
