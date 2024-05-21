<?php
session_start();
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<html style="height:100%">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" href="style.css" />
	<link rel="shortcut icon" href="images/favicon.png" >
	<title>CastellaneAuto - Nous</title>
</head>

<body>
	<header>
		<div id="bloc_header">
			<a href="accueil.php">
				<img src="images/logo.png" alt="Logo CastellaneAuto" id="logo" border="0"/>
			</a>
			<?php 
			require("includes/noob.php");

			?> 
		</div>
	</header>
	<div id="contenu_body" class="reprezent">
		<?php 			
					require("includes/Navquidam.php");				
				?>
		<section id="menu_droite">
			<div id="bloc_noir">			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Horaires</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-4col">
						<h2>
						Lundi - Vendredi : 9h30->20h<br />
						<br />Samedi - Dimanche : 10h->18h<br />
						<br />Jours fériés : Ouvert <br />
						</h2>
					</div>
					
				</div>
				<div class="clear"></div>			
			</div>
			
			<div id="bloc_noir">			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Nous Contacter</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-4col">
						<h2>
						14 Boulevard Baille - 13006 Marseille<br />
						<br />CasteAutoInfos@gmail.com<br />
						<br />04 56 28 41 00<br />												
						</h2>
					</div>
					
				</div>
				<div class="clear"></div>			
			</div>
			
			<div id="bloc_noir">			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Mentions Légales</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-4col">
						<h2>
						Raison sociale : SARL<br />
						<br />Le siège social : 14 Boulevard Baille - 13006 Marseille<br />
						<br />04 56 28 41 00<br />
						<br />Monsieur Jeremy Foster<br />																		
						</h2>
					</div>
					
				</div>
				<div class="clear"></div>			
			</div>
			
		</section>
		<div class="clear"></div>
	</div>
	<?php include("includes/footer.php"); ?>
</body>
</html>