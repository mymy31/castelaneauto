<?php
session_start();

if(isset($_POST['inscription'])) {

	$telephone = htmlspecialchars($_POST["tel"]);
    $mail = htmlspecialchars($_POST["email"]);
	$nom =  htmlspecialchars($_POST["nom"]);
	$prenom = htmlspecialchars($_POST["prenom"]);
	$adresse = htmlspecialchars($_POST["adr"]);
	$cp = htmlspecialchars(intval($_POST["cp"]));
	$ville = htmlspecialchars(ucwords($_POST["ville"]));
	$date = htmlspecialchars($_POST["naissance"]);
	$type = htmlspecialchars($_POST["type"]);

	try {
		$bd = new PDO("mysql:host=localhost;dbname=autoecole", "root", "");

		$request = $bd->prepare("INSERT INTO `Utilisateur`(`TypeUtilisateur`, `Nom`, `Prenom`, `Adresse`, `CodePostal`, `Ville`, `DateNaissance`, `Telephone`, `Email`) VALUES (?,?,?,?,?,?,?,?,?)");

		$request->execute(array($type, $nom, $prenom, $adresse, $cp, $ville, $date, $telephone, $mail));
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
    
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<html style="height:100%">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" href="styleinscription.css" />
	<link rel="shortcut icon" href="images/favicon.png" >
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
	<title>CastellaneAuto - Inscription </title>
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
					<h3>Les photocopies obligatoires </h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-4col">
						<h2># Pièce d'identité (recto-verso) en cours de validité. <br />
						<br /># Certificat de participation à la JAPD si vous avez entre 18 et 25 ans.<br />
						<br /># ASSR2 ou ASR (né(e) après le 01/01/1988). <br />
						<br /># Une copie de votre permis de conduire en cours de validité, correspondant à la catégorie dans laquelle vous souhaitez enseigner.<br />
						</h2>
					</div>
					
				</div>
				<div class="clear"></div>			
			</div>
			
			<div id="bloc_noir">			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Les autres documents à fournir </h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-4col">
						<h2>
						# Une attestation de suivi de formation pédagogique spécifique à l'enseignement de la conduite automobile, délivrée par un organisme reconnu par les autorités compétentes.<br />
						<br /># Un certificat médical délivré par un médecin agréé attestant de votre aptitude physique et mentale à enseigner la conduite. <br />
						<br /># Un extrait de casier judiciaire datant de moins de trois mois<br />
						<br /># Un certificat de formation professionnelle délivré par un organisme agréé<br />
						</h2>
					</div>
					
				</div>
				<div class="clear"></div>			
			</div>
			
			<div>
				<form method="post">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">nom</label>
						<input type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">prenom</label>
						<input type="text" name="prenom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Adresse</label>
						<input type="text" name="addresse" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Code postal</label>
						<input type="text" name="cp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Ville</label>
						<input type="text" name="ville" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Date naissance</label>
						<input type="date" name="naissance" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Téléphone</label>
						<input type="text" name="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">email</label>
						<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>

					<div class="mb-3 form-check">
						<input type="radio" name="type" class="form-check-input" value="moniteur" id="exampleCheck1">
						<label class="form-check-label"  for="exampleCheck1">Moniteur</label>
					</div>

					<div class="mb-3 form-check">
						<input type="radio" name="type" class="form-check-input" value="etudiant" id="exampleCheck2">
						<label class="form-check-label"  for="exampleCheck2">Etudiant</label>
					</div>
					
					<button name="inscription" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</section>
		
		
		
		<div class="clear"></div>
	</div>
	<?php include("includes/footer.php"); ?>
</body>
</html>
