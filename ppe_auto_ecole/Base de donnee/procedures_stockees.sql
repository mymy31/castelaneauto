/* Création Table ArchiveVoiture et Création Procédure Stockée remplissant ArchiveV avec les données supprimées de old.voiture
*/

CREATE Table IF NOT EXISTS ArchiveV 
AS Select *, curdate() date_archive
FROM voiture
WHERE 2=0;

drop procedure if exists histovoiture;
DELIMITER //
CREATE Procedure HistoVoiture()
BEGIN 
DECLARE fini int default 0;
DECLARE HIdV int(3);
DECLARE HImmatriculation varchar(15);
DECLARE HModele varchar(20);
DECLARE HDateAchat DATE;
DECLARE HNbrKm float (12,2) DEFAULT '0';
Declare HConso DECIMAL (10,2);
DECLARE CV cursor for select * 
	from voiture
	where datediff(curdate(), DateAchat)/365 > 2 OR NbrKm > 50000;
	
DECLARE Continue HANDLER for not found set fini=1;
OPEN CV;
Fetch CV INTO HIdV, HImmatriculation, HModele, HDateAchat, HNbrKm, HConso;
WHILE Fini <> 1 
DO 
INSERT INTO ArchiveV VALUES (
HIdV, HImmatriculation, HModele, HDateAchat, HNbrKm, HConso, curdate());
Fetch CV INTO HIdV, HImmatriculation, HModele, HDateAchat, HNbrKm, HConso;
END WHILE;
CLOSE CV;
END //

DELIMITER ;


/* Set Resultat=non sur tous les examens anterieurs aux oui et archiver toutes les informations concernant l'étudiant qui a eu son permis
  nom, prenom, date examen, nombre de passage pour l'avoir */
drop procedure if exists update_archive_etudiant;
DELIMITER //
CREATE Procedure update_archive_etudiant()
BEGIN



		DECLARE Fini int default 0;
		DECLARE NumC int;
		DECLARE NomC, prenomC varchar (25);
		DECLARE Date_Obtention_Code DATE;
		DECLARE Date_Obtention_Permis DATE;
		DECLARE Nb_Tentatives_Permis int;
		/*   + les variables nécessaires */

		DECLARE CP cursor FOR Select Client.IdC, NomE, PrenomE, Date_Inscri_Permis, Date_Inscri_Code, Nb_Passage_Permis
		FROM Client, Etudiant, ExamenP, ExamenC
		WHERE Client.IdC = Etudiant.IdC AND ExamenP.IdC=Client.IdC AND ExamenC.IdC=Client.IdC AND ResultatP='oui' AND ResultatC='oui';


		DECLARE Continue HANDLER for not found set fini=1; 
		/* Declare une variable continue qui va faire executer la procedure jusqu'à ce que fini soit = à 1 sans se préoccuper des erreurs */ 
		

		Open CP;
		Fetch CP INTO NumC, NomC, PrenomC, Date_Obtention_Permis, Date_Obtention_Code, Nb_Tentatives_Permis; 
		/* Positionne chaque variable déclarée dans la declaration du CV dans chaque champ NumC,etc... */
			WHILE Fini <> 1 
			DO 
				INSERT INTO ArchiveClient /* nom des tables archives */
				VALUES ( NumC, NomC, PrenomC, Date_Obtention_Permis, Date_Obtention_Code, Nb_Tentatives_Permis);
			Fetch CP INTO NumC, NomC, PrenomC, Date_Obtention_Permis, Date_Obtention_Code, Nb_Tentatives_Permis;
			END WHILE;
		Close CP;

call update_archive_salarie();
END //
DELIMITER ;

-- même chose pour salarie

drop procedure if exists update_archive_salarie;
DELIMITER //
CREATE Procedure update_archive_salarie()
BEGIN

DECLARE Fini int default 0;
DECLARE NumC int;
DECLARE NomC, prenomC varchar (25);
DECLARE Date_Obtention_Code DATE;
DECLARE Date_Obtention_Permis DATE;
DECLARE Nb_Tentatives_Permis int;
/*   + les variables nécessaires */

DECLARE CP cursor FOR Select Client.IdC, NomS, PrenomS, Date_Inscri_Permis, Date_Inscri_Code, Nb_Passage_Permis
FROM Client, Salarie, ExamenP, ExamenC
WHERE Client.IdC = Salarie.IdC AND ExamenP.IdC=Client.IdC AND ExamenC.IdC=Client.IdC AND ResultatP='oui' AND ResultatC='oui';


DECLARE Continue HANDLER for not found set fini=1; 
/* Declare une variable continue qui va faire executer la procedure jusqu'à ce que fini soit = à 1 sans se préoccuper des erreurs */ 

Open CP;
Fetch CP INTO NumC, NomC, PrenomC, Date_Obtention_Permis, Date_Obtention_Code, Nb_Tentatives_Permis; 
/* Positionne chaque variable déclarée dans la declaration du CV dans chaque champ NumC,etc... */
	WHILE Fini <> 1 
	DO 
		INSERT INTO ArchiveClient /* nom des tables archives */
		VALUES ( NumC, NomC, PrenomC, Date_Obtention_Permis, Date_Obtention_Code, Nb_Tentatives_Permis);
	Fetch CP INTO NumC, NomC, PrenomC, Date_Obtention_Permis, Date_Obtention_Code, Nb_Tentatives_Permis;
	END WHILE;
Close CP;
END //
DELIMITER ;

/* Créer les moniteurs dans la base mysql avec les même identifiants et login 

drop procedure if exists acces_moniteurs;
DELIMITER //
CREATE Procedure acces_moniteurs()
BEGIN
	
	DECLARE Creatuser varchar (255);
	SET Creatuser = "CREATE USER '?'@'localhost' IDENTIFIED BY '?'";
	prepare Creatuser
	DECLARE fini default 0;
	DECLARE Prenom varchar(255);
	DECLARE Nom varchar(255);
	DECLARE CP cursor FOR SELECT PrenomM, NomM 
		FROM Moniteur
	
	DECLARE Continue HANDLER for not found set fini= (SELECT MAX(IdM)); 
	
	Open CP;
	Fetch CP INTO Prenom, Nom; 
	
	WHILE fini < (SELECT MAX(IdM) From Moniteur)
	DO
		SET @Prenom = (SELECT PrenomM FROM Moniteur WHERE IdM=fini);
		SET @Nom = (SELECT NomM FROM Moniteur WHERE IdM=fini);
		EXECUTE Creatuser USING @Prenom, @Nom
		SET fini++;
	END WHILE;
	CLOSE CP;
END //
DELIMITER ;
		
	DECLARE nb int default 0;
	DECLARE login varchar (15);
	DECLARE pass varchar (15);
	DECLARE maxi int;
	SET maxi = (SELECT MAX(IdM) FROM Moniteur);
	
	WHILE nb < maxi
		DO 
			SET nb=nb+1;
			SET login = (SELECT PrenomM FROM Moniteur WHERE IdM = nb);
			SET pass = (SELECT NomM FROM Moniteur WHERE IdM = nb);
			PREPARE creuse CREATE USER '(SELECT login)'@'localhost' IDENTIFIED BY '(SELECT pass)';
			GRANT SELECT ON autoecole.* TO '(SELECT login)'@'localhost';
			FLUSH PRIVILEGES;
	END WHILE;
	
END // 
DELIMITER ;
*/



/* ------------------------- Lecon ---------------------------- */


drop procedure if exists temps_lecon;
DELIMITER //
CREATE Procedure temps_lecon()
BEGIN
	
	DECLARE nb int;
	DECLARE maxi int;
	DECLARE caca int;
	
	SET nb=0;
	SELECT MAX(Id_lecon) INTO maxi FROM Lecon;
	
	IF maxi <> 0
	THEN
		
		WHILE nb <= maxi
		DO
				/* 
				(SELECT Tps_lecon FROM lecon WHERE Id_lecon = nb) = 
				(SELECT (TIMEDIFF((SELECT H_fin FROM lecon WHERE Id_lecon = nb), 
				(SELECT H_debut FROM lecon WHERE Id_lecon = nb)))); 
				*/
			/*
			SET (SELECT Tps_lecon FROM lecon WHERE Id_lecon=nb) =
			SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF((SELECT H_fin FROM lecon WHERE Id_lecon = nb), (SELECT H_Debut FROM lecon WHERE Id_lecon = nb))))) 
			*/
            
            
              SELECT SUM(TIME_TO_SEC(TIMEDIFF(H_fin, H_Debut))) INTO @tps
              FROM lecon
              WHERE Id_lecon = nb;
             
			UPDATE lecon
            SET Tps_lecon = SEC_TO_TIME(@tps)
            WHERE Id_lecon = nb;
            
			SET nb = nb +1;
		END WHILE;
	
	END IF;

END //
DELIMITER ;

