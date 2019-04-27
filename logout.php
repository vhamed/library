<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style_login.css">
  <script src="js/prefixfree.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LIBRARY</title>

</head>

<body class="background_login">


	<?php
		SESSION_start();

		session_unset();
		if (session_destroy())
		?> </br></br><center><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp deconnexion avec succés</div></center> <?php
		header( "refresh:1;url=index.php" );
	?>


</body>
</html>
