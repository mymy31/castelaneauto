<?php
session_start();
if (!isset($_SESSION['nbvisite']))
{
	$_SESSION['nbvisite']=0;
}
if (!isset($_SESSION['nbrate']))
{
	$_SESSION['nbrate']=0;
}

try
{
	$bdd= new PDO('mysql:host=localhost;dbname=autoecole', 'root', '');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

/*ini_set('display_errors', '1');
error_reporting(E_ALL);*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<html style="height:100%">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" href="style.css" />
	<link rel="shortcut icon" href="images/favicon.png" >
	<title>CastellaneAuto - Accueil</title>
</head>

<body>
	<header>
		<div id="bloc_header">
			<a href="accueil.php">
				<img src="images/logo.png" alt="Logo CastellaneAuto" id="logo" border="0"/>
			</a>
			<?php 
				if (($_SESSION['nbvisite']<=0) or $_SESSION['nbrate'] >=4)	
				{	
					require("includes/noob.php");
				}
				else
				{
					if (isset($_SESSION['IDM']))
					{
						require("includes/connecte.php");
					}
					else
					{
						require("includes/connexion.php");
					}	
				}
			?> 
		</div>
	</header>
	<div id="contenu_body" class="reprezent">
		<?php 
				IF (isset($_SESSION['IDM']))
				{
					require("includes/Nav.php");
					require("includes/Bodymoniteur.php");
				}
				ELSE 
				{
					require("includes/Navquidam.php");
					require("includes/Bodyquidam.php");
				}
				?>
		
		<div class="clear"></div>
	</div>
		<?php 
		if (isset($_SESSION['IDM']))
		{
			require("includes/footermoni.php");
		}
		else
		{
			include("includes/footer.php");
		}
			?>
</body>
</html>