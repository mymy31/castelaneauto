		<section id="menu_droite">
			<div id="bloc_noir" class="blocnoir1">
			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Formation efficace</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-2col">
						
						<?php
							$moniteurs=$bdd->query('SELECT COUNT(*) AS nbmon FROM Moniteur');
							$ratiopassages=$bdd->query('SELECT (SELECT SUM(Nb_Tentatives_Permis) FROM ArchiveClient) / (SELECT COUNT(*) FROM ArchiveClient) AS ratio');	
						?>
						
						<h2><?php while ($donnees=$moniteurs->fetch())
													{
														echo $donnees['nbmon'];
													}
													
											?> Professeurs volontaires et expérimentés
						<br /> 
						</h2>
					</div>
					<div class="bloc-content-2col">
						<h2>
							Une moyenne de <?php
													while($donnees=$ratiopassages->fetch())
													{
														echo round($donnees['ratio'], 2.2);
													}	
													
												?> passages avant obtention du permis 
						</h2>
					</div>
				</div>
				<div class="clear"></div>
			
			</div>
			<div id="bloc_noir" class="blocnoir2">
			
			
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Différentes Formules</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-1col">
						<h2>Permis B Etudiant </h2>
					</div>
					<div class="bloc-content-2col">
						<h2>Permis B Automatique </h2>
					</div>
					<div class="bloc-content-1col">
						<h2>Permis Accompagné </h2>
					</div>
				</div>
				<div class="clear"></div>
		
			
			</div>
			<div id="bloc_noir" class="blocnoir3">
				<div class="bloc-title">
					<div class="titreBorderG"></div>
					<h3>Larges choix voitures</h3>
					<div class="titreBorderD"></div>
				</div>
				<div class="bloc-content">
					<div class="bloc-content-4col">
						<h2>
							<?php
								$modeles=$bdd->query('SELECT count(distinct(modele)) as nbmod from voiture');
								while ($donnees=$modeles->fetch())
								{
									echo $donnees['nbmod'];
								}
							?> Modèles différents
							<br />Parmis lesquels <?php 
														$exemple=$bdd->query('SELECT modele from voiture ORDER BY DateAchat DESC LIMIT 1,3');
														while($donnees=$exemple->fetch())
														{
															echo '</br>' . $donnees['modele'];
														}
													?>
						</h2>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</section>