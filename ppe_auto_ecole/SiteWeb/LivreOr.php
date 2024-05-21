<?php
session_start();
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<html style="height:100%">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" href="styleinscription.css" />
	<link rel="shortcut icon" href="images/favicon.png" >
	<title>CastellaneAuto - Livre d'Or</title>
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
					<h3>Messages</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-4col">
						<h2>-Aucun pour le Moment- <br /> Soyez le premier!<?php
								
						
							?></h2>
					</div>
					
				</div>
				<div class="clear"></div>			
			</div>
			
			<div id="bloc_noir">			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Postez le votre !</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-1col">
						<h2>
							<?php
							try
							{
								$bdd=new PDO('mysql:host=localhost;dbname=test', 'root', '');
							}
							catch (Exception $e)
							{
								die('Erreur : ' . $e->getMessage());
							}
								
								
							?>
						</h2>
						<div class="avis">
						<form action="https://formspree.io/f/xrgnjpkj"method="POST">
							
						
							<tr>
								<td>
									<label for="pseudo">Pseudo</label>
									<br />
								
									<input type="varchar" name="pseudo" id="pseudo"/>
								</td>
								<br />
							</tr>
							<tr>
								<td>
									<label for="message">Message</label> 
								
									<textarea id="message" name="message" rows="2" cols="30">Votre avis sur nous ?</textarea>
								</td>
							</tr>
							
							<tr>
								<input type="submit" value="Envoyer"/>
							</tr>
						
						</form>
						</div>
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