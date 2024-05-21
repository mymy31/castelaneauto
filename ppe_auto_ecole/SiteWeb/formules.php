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
	<title>CastellaneAuto - Formules</title>
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
					<h3>Permis B</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-2col">
						<h2>
						<mark>Formule 20h - 1000€</mark><br />
						<br />Codes + Test illimités<br />
						<br />1 Présentation à chaque examen<br />
						<br />53 € / Heure Supplémentaire<br />
						</h2>
					</div>
					
					<div class="bloc-content-2col">
						<h2>
						<mark>Formule 30h - 1500€</mark><br />
						<br />Codes + Test illimités<br />
						<br />1 Présentation à chaque examen<br />
						<br />53 € / Heure Supplémentaire<br />
						</h2>
					</div>
				</div>
			
				<div class="clear"></div>			
			</div>
			
			<div id="bloc_noir">			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Permis B Automatique</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
				
					<div class="bloc-content-2col">
						<h2>
						<mark>Formule 20h - 1100€</mark><br />
						<br />Codes + Test illimités<br />
						<br />1 Présentation à chaque examen<br />
						<br />55 € / Heure Supplémentaire<br />
						</h2>
					</div>
					
					<div class="bloc-content-2col">
						<h2>
						<mark>Formule 30h - 1550€</mark><br />
						<br />Codes + Test illimités<br />
						<br />1 Présentation à chaque examen<br />
						<br />55 € / Heure Supplémentaire<br />
						</h2>
					</div>
					
				</div>
				<div class="clear"></div>			
			</div>
			
			<div id="bloc_noir">			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Permis B Etudiant</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					
					<div class="bloc-content-2col">
						<h2>
						<mark>Formule 20h - 900€</mark><br />
						<br />Codes + Test illimités<br />
						<br />1 Présentation à chaque examen<br />
						<br />50 € / Heure Supplémentaire<br />
						</h2>
					</div>
					
					<div class="bloc-content-2col">
						<h2>
						<mark>Formule 30h - 1350€</mark><br />
						<br />Codes + Test illimités<br />
						<br />1 Présentation à chaque examen<br />
						<br />50 € / Heure Supplémentaire<br />
						</h2>
					</div>
					
				</div>
				<div class="clear"></div>			
			</div>
			
			<div id="bloc_noir">			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>AAC</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-2col">
						<h2>
						20 Heures de Conduite<br />
						<br />1 Présentation à l'examen pratique</h2>
					</div>
					
					
					
					<div class="bloc-content-2col">
						<h2>Cours de Code et test illimités<br />
						<br />Total 900€<br />
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