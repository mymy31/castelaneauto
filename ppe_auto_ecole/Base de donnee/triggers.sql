/*------------------------------------------Table ExamenP---------------------------------------------

-- Vérifier l'obtention du code dans les 24 dernier mois avant le passage du permis, et la majorité du client.
--Rajouter +1 au nombre de passage de permis si un client est déjà sur la table, sinon 1.
*/
drop trigger IF EXISTS Before_Insert_Permis;
DELIMITER //
CREATE TRIGGER Before_Insert_Permis
BEFORE INSERT ON ExamenP
FOR EACH ROW 
BEGIN
	DECLARE nb int;
	DECLARE nb2 int;
	DECLARE msg varchar(100);
	SELECT COUNT(*) INTO nb FROM ExamenC WHERE IdC=new.IdC AND ResultatC='oui';
	IF nb = 0 
			THEN 
				DELETE FROM `Le client n''est pas titulaire du code de la route`;
				 
	ELSEIF
			nb > 0 AND
			(SELECT (ADDDATE((SELECT DateNaiss
			FROM Etudiant
			WHERE Etudiant.IdC=new.IdC), INTERVAL 18 YEAR))) > new.Date_Inscri_Permis
			
			THEN
				DELETE FROM `L''etudiant n''est pas majeur`;

	ELSEIF
			nb > 0 AND
			(SELECT (ADDDATE((SELECT DateNaiss
			FROM Salarie
			WHERE Salarie.IdC=new.IdC), INTERVAL 18 YEAR))) > new.Date_Inscri_Permis
			
			THEN 
				DELETE FROM `Le salarie n''est pas majeur`;
				
	ELSEIF 
			nb > 0 AND
			(SELECT (ADDDATE((SELECT Date_Inscri_Code FROM ExamenC WHERE ExamenC.IdC=new.IdC AND ResultatC = 'oui'), INTERVAL 3 YEAR ))) < (SELECT new.Date_Inscri_Permis)
			
			THEN 
				DELETE FROM `Code expire`;
				
	
				
	END IF;		
		
		SELECT COUNT(*) INTO nb FROM ExamenP WHERE IdC=new.IdC;
		IF nb > 0 
			THEN
				SELECT COUNT(*) INTO nb2 FROM ExamenP WHERE new.Date_Inscri_Permis=Date_Inscri_Permis AND new.IdC=IdC;
				IF	
					nb2 > 0
					THEN
						DELETE FROM ExamenP WHERE 2=0;
						
				ELSE
					SET new.Nb_Passage_Permis = nb+1;
				END IF;
		
		
		ELSE		
			SET new.Nb_Passage_Permis = 1;
		END IF;
				
	
END //

DELIMITER ;





/*--------------------------------------------Table ExamenC---------------------------------------------

--Rajouter +1 au nombre de passage de code si un client est déjà sur la table, sinon 1.
*/
DROP TRIGGER if exists Before_Insert_ExamenC;
DELIMITER //
CREATE TRIGGER Before_Insert_ExamenC
BEFORE INSERT ON ExamenC
FOR EACH ROW
BEGIN

	DECLARE nbexc int;
	SELECT COUNT(*) INTO nbexc FROM ExamenC WHERE new.IdC=IdC;
	IF nbexc <> 0 
	THEN
		SET new.Nb_Passage_Code = nbexc + 1;
	ELSE
		SET new.Nb_Passage_Code = 1;
	
	END IF;
END //

DELIMITER ;
	
	
	 
/*--------------------------------------------Table Etudiant---------------------------------------------

-- Héritage Client / Etudiant, empêcher l'insert si client déjà salarié
-- Empêcher de recréer un même étudiant avec un id différent (qu'il soit créé en Salarié ou Etudiant)
-- Si l'étudiant a plus de 25 ans, pas de taux de réduction. */
drop trigger if exists Verif_Etu;
DELIMITER // 

CREATE TRIGGER Verif_Etu 
BEFORE INSERT ON Etudiant
FOR EACH ROW
BEGIN

DECLARE nbe int;

SELECT MAX(IdC) into nbe FROM Client;

IF nbe is NULL 
THEN
SET nbe=0;
end if;

IF new.IdC = 0 
then 
	SET new.IdC = nbe + 1;
END IF;



SELECT COUNT(IdC) into nbe
FROM Client
WHERE IdC=new.IdC;

IF nbe = 0
	then 
			INSERT INTO Client(IdC) VALUES (new.IdC);
END IF;



SELECT COUNT(IdC) INTO nbe FROM Salarie WHERE IdC=new.IdC;

if nbe > 0

THEN 
	DELETE FROM Etudiant WHERE 2=0;

end if;

	IF YEAR(CURDATE() - YEAR(new.Datenaiss) > 25)
	THEN 
		SET new.taux_reduction=0;
	
	END IF;
	
SELECT COUNT(*) INTO nbe FROM Etudiant WHERE new.NomE=NomE
		AND new.PrenomE=PrenomE AND new.AdresseE=AdresseE AND new.CpE=CpE
		AND new.VilleE=VilleE AND new.DateNaiss=DateNaiss
		AND new.Telephone=Telephone AND new.nom_formation=nom_formation
		AND new.NomEta=NomEta;
		
	IF nbe > 0 
		THEN	
		DELETE FROM Etudiant WHERE 2=0;
		
	END IF;



SELECT COUNT(*) INTO nbe FROM Salarie WHERE new.NomE=Salarie.NomS
		AND new.PrenomE=Salarie.PrenomS AND new.AdresseE=Salarie.AdresseS
		AND new.CpE=Salarie.CpS AND new.VilleE=Salarie.VilleS AND new.DateNaiss=Salarie.DateNaiss
		AND new.Telephone=Salarie.Telephone;
		
	IF nbe > 0 
		THEN	
		DELETE FROM Etudiant WHERE 2=0;
		
	END IF;
	

END //
	
DELIMITER ;
	




/*-- Suppression dans etudiant = suppression dans client */

DROP TRIGGER if exists After_Delete_Etudiant;
DELIMITER //
CREATE TRIGGER After_Delete_Etudiant
AFTER DELETE ON Etudiant
FOR EACH ROW
BEGIN 

	DELETE FROM Client Where Client.IdC = old.IdC;

	
END //
DELIMITER ;



/* -- Modification dans etudiant = modification dans client */

DROP TRIGGER if exists After_Update_Etudiant;
DELIMITER //
CREATE TRIGGER After_Update_Etudiant
AFTER UPDATE ON Etudiant
FOR EACH ROW
BEGIN

	UPDATE client SET Client.IdC = new.IdC where Client.IdC=old.IdC;
	
END //
DELIMITER ;









/* --------------------------------------------Table Salarié---------------------------------------------

-- Héritage Client / Salarié, empêcher l'insert si client déjà étudiant 
-- Vérifie l'existance du client dans la table salarié et étudiant afin de ne pas le dupliquer
*/ 
DROP TRIGGER if exists Verif_Salarie;
DELIMITER // 
CREATE TRIGGER Verif_Salarie 
BEFORE INSERT ON Salarie
FOR EACH ROW
BEGIN

DECLARE nbs int;

SELECT MAX(IdC) into nbs FROM Client;

	IF nbs is NULL 
		THEN
			SET nbs=0;
	END IF;

	IF new.IdC = 0 
		THEN
			SET new.IdC = nbs + 1;
	END IF;


SELECT COUNT(IdC) into nbs FROM Client WHERE IdC=new.IdC;

	IF nbs = 0
		THEN 
			INSERT INTO Client(IdC) VALUES (new.IdC);
	END IF;



SELECT COUNT(IdC) INTO nbs FROM Etudiant WHERE IdC=new.IdC;

	IF nbs > 0
		THEN 
			DELETE FROM Salarie WHERE 2=0;

	END IF;


	
SELECT COUNT(*) INTO nbs FROM Salarie WHERE new.NomS=NomS
		AND new.PrenomS=PrenomS AND new.AdresseS=AdresseS AND new.CpS=CpS
		AND new.VilleS=VilleS AND new.DateNaiss=DateNaiss
		AND new.Telephone=Telephone AND new.nom_entreprise=nom_entreprise;
		
	IF nbs > 0 
		THEN	
			DELETE FROM Salarie WHERE 2=0;
		
	END IF;



SELECT COUNT(*) INTO nbs FROM Etudiant WHERE new.NomS=Etudiant.NomE
		AND new.PrenomS=Etudiant.PrenomE AND new.AdresseS=Etudiant.AdresseE
		AND new.CpS=Etudiant.CpE AND new.VilleS=Etudiant.VilleE AND new.DateNaiss=Etudiant.DateNaiss
		AND new.Telephone=Etudiant.Telephone;
		
	IF nbs > 0 
		THEN	
			DELETE FROM Salarie WHERE 2=0;
		
	END IF;
	

END //
	
DELIMITER ;
	






/* -- Suppression dans salarié = suppression dans client */

DROP TRIGGER if exists After_Delete_Salarie;
DELIMITER //
CREATE TRIGGER After_Delete_Salarie
AFTER DELETE ON Salarie
FOR EACH ROW
BEGIN 

	DELETE FROM Client Where Client.IdC = old.IdC;
	
END //
DELIMITER ;



/* -- Modification dans salarié = modification dans client */
 
DROP TRIGGER if exists After_Update_Salarie;
DELIMITER //
CREATE TRIGGER After_Update_Salarie
AFTER UPDATE ON Salarie
FOR EACH ROW
BEGIN

	UPDATE client SET Client.IdC = new.IdC where Client.IdC=old.IdC;
	
END //
Delimiter ;






/*--------------------------------------------Table Moniteur--------------------------------------------

--Heritage Identifiants / moniteur à l'insert */
drop trigger if exists Before_Insert_Moniteur;
DELIMITER //
CREATE TRIGGER Before_Insert_Moniteur
BEFORE INSERT ON Moniteur
FOR EACH ROW 
BEGIN
	
	DECLARE nbs int;
	DECLARE maxi int;
	
		SELECT COUNT(*) INTO nbs FROM Moniteur WHERE NomM=new.NomM AND PrenomM=new.PrenomM;
		SELECT MAX(IdM) FROM Moniteur into maxi;
		IF nbs > 0 
			THEN
				DELETE FROM `moniteur deja existant`;
		ELSE
			IF maxi > 0
			THEN 
				INSERT INTO Identifiants(MdP, Login, IdM) VALUES(
				new.NomM,
				new.PrenomM,
				maxi + 1);
			ELSE
				INSERT INTO Identifiants(MdP, Login, IdM) VALUES(
				new.NomM,
				new.PrenomM,
				1);
			END IF;
		END IF;
END // 
DELIMITER ;

 /*Sur l'update */
drop trigger if exists Before_Update_Moniteur;
DELIMITER //
CREATE TRIGGER Before_Update_Moniteur
BEFORE UPDATE ON Moniteur
FOR EACH ROW 
BEGIN
	
	UPDATE Identifiants 
	SET Identifiants.IdM=New.IdM WHERE Identifiants.IdM=old.IdM;
	
	
END // 
DELIMITER ;

 /*Sur Le delete*/ 
drop trigger if exists Before_Delete_Moniteur;
DELIMITER //
CREATE TRIGGER Before_Delete_Moniteur
BEFORE DELETE ON Moniteur
FOR EACH ROW 
BEGIN
	
	DELETE FROM Identifiants
	WHERE Identifiants.IdM=old.IdM;

	
	
END // 
DELIMITER ;



/*---------------------------------------------Client---------------------------------------

-- INVERSE HERITAGE 
*/
drop trigger if exists Herit_Client;
DELIMITER //
CREATE TRIGGER Herit_Client
AFTER DELETE ON Client
FOR EACH ROW
BEGIN

DECLARE nbc int;
DECLARE nbc2 int;

SELECT COUNT(*) INTO nbc FROM Salarie WHERE old.IdC=IdC;
SELECT COUNT(*) INTO nbc2 FROM Etudiant WHERE old.IdC=IdC;

IF nbc > 0 or nbc2 > 0
	THEN
		IF nbc > 0
			THEN
				DELETE FROM Salarie WHERE old.IdC=IdC;
		ELSE
				DELETE FROM Etudiant WHERE old.IdC=IdC;
		END IF;
		
ELSE		
	INSERT INTO Archives_Client VALUES(old.IdC);
END IF;

END //

DELIMITER ;




/*-- 	Trigger archives client pour suppr les clients qui ont eu le permis de la table examen et code---------------
*/
DROP TRIGGER if exists Before_Insert_ArchiveClient;
DELIMITER //
CREATE TRIGGER Before_Insert_ArchiveClient
BEFORE INSERT ON ArchiveClient
FOR EACH ROW
BEGIN 
	

	
	DELETE FROM ExamenP WHERE IdC IN(SELECT NumC FROM ArchiveClient);
	DELETE FROM ExamenC WHERE IdC IN(SELECT NumC FROM ArchiveClient);	

END //
DELIMITER ;

/* --------------------------------------------Identifiants------------------------------------------------------------*/

DROP TRIGGER IF EXISTS Before_Insert_Identifiants;
DELIMITER //
CREATE TRIGGER Before_Insert_Identifiants
BEFORE INSERT ON Identifiants
FOR EACH ROW
BEGIN

DECLARE nb int;
SELECT COUNT(Id_Identifiants) INTO nb FROM Identifiants;
IF nb = 0
THEN
	SET new.Id_Identifiants=1;
ELSE
	SET new.Id_Identifiants=(SELECT MAX(Id_Identifiants) FROM Identifiants)+1;
END IF;

END //
DELIMITER ;


/* ------------------------- Lecon ---------------------------- */


DROP TRIGGER IF EXISTS Before_Insert_lecon;
DELIMITER //
CREATE TRIGGER Before_Insert_lecon
BEFORE INSERT ON Lecon
FOR EACH ROW
BEGIN

	DECLARE nb int;
	
	SELECT MAX(Id_lecon) INTO nb FROM Lecon;
	
	IF nb <> 0
	THEN
		SET new.Id_lecon= nb+1;
	
	ELSE
		SET new.Id_lecon=1;	
	
	END IF;
END //
DELIMITER ;
