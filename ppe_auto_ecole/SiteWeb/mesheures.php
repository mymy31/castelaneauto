<?php
session_start();
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
				
				
				
				
				
					
					
						require("includes/connecte.php");
					
					
					
				
						
				
			?> 
		</div>
	</header>
	<div id="contenu_body" class="reprezent">
		<?php 			
					require("includes/Nav.php");			
				
		?>
		<section id="menu_droite">
			
			
			<div id="bloc_noir">
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Planning</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-4col">
						<h2>
							<<iframe src="https://www.google.com/calendar/embed?src=28nff4dh0asfcjjdublqlhka5o%40group.calendar.google.com&ctz=Europe/Paris"
							style="border: 0" width="600" height="400" frameborder="0" scrolling="no">
							</iframe>
							<<?php /*require("CalendrierPHP/index.php"); */?>
						</h2>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</section>
		
		<<iframe src="https://www.google.com/calendar/embed?src=fr.french%23holiday%40group.v.calendar.google.com&ctz=Europe/Paris"
		style="border: 0"
		width="600" height="600" frameborder="0" scrolling="no">
		</iframe> 
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