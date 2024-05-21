DROP DATABASE IF EXISTS autoecole;
CREATE DATABASE autoecole CHARACTER SET 'utf8';

use autoecole

CREATE TABLE Client (
IdC int(3) NOT NULL AUTO_INCREMENT Primary key,
Login varchar(15),
MDP varchar(20)
)
ENGINE = InnoDB;

CREATE TABLE ExamenP (
IdExaP int NOT NULL AUTO_INCREMENT Primary key,
Date_Inscri_Permis DATE NOT NULL,
Nb_Passage_Permis int(1) DEFAULT 1,
ResultatP ENUM ('oui', 'non'),
IdC int NOT NULL, FOREIGN KEY (IdC) REFERENCES Client (IdC)
)
ENGINE = InnoDB;


CREATE TABLE ExamenC (
IdExaC int not null AUTO_INCREMENT Primary key,
Date_Inscri_Code DATE NOT NULL,
Nb_Passage_Code int DEFAULT 1,
ResultatC ENUM ('oui', 'non'),
IdC int not null, FOREIGN KEY (IdC) REFERENCES Client (IdC)
)
ENGINE = InnoDB;

CREATE TABLE Moniteur (
IdM int(2) NOT NULL Auto_Increment Primary key,
NomM varchar(25) not null,
PrenomM varchar(25) not null
)
ENGINE = InnoDB;

CREATE TABLE Voiture (
IdV int(3) not null Auto_Increment Primary Key,
Immatriculation char(7) not null,
Modele varchar(20) ,
DateAchat DATE not null,
NbrKm float(12,2) DEFAULT '0',
Conso DECIMAL (3,2)
)
Engine = InnoDB;

CREATE TABLE Lecon (
Id_lecon int(3) not null AUTO_INCREMENT Primary key,
Titre_lecon varchar(20) not null,
IdM int(11) not null, Foreign Key (IdM) References Moniteur (IdM),
IdC int not null, Foreign Key (IdC) References Client (IdC),
IdV int(3), FOREIGN KEY (IdV) REFERENCES Voiture (IdV),
Date_lecon DATE not null,
H_debut TIME not null,
H_fin TIME not null,
Tps_lecon TIME
)
ENGINE = InnoDB;

CREATE TABLE IntervalLecon (
Id_lecon int(3), Foreign Key (Id_lecon) References Lecon (Id_lecon),
D_Debut DATETIME not null,
D_Fin DATETIME not null
)
Engine = InnoDB; 

CREATE TABLE utiliservoiture (
IdV int(3) NOT NULL,
Mois DATE not null,
Primary Key (IdV, Mois), FOREIGN KEY (Idv) REFERENCES voiture (IdV)
)
ENGINE = InnoDB;


CREATE TABLE Etudiant (
IdC int(3) not null AUTO_INCREMENT Primary Key,
NomE varchar(25) NOT NULL,
PrenomE varchar (25) NOT NULL,
AdresseE varchar(128) NOT NULL,
CpE char(5) NOT NULL,
VilleE varchar (20) NOT NULL,
DateNaiss DATE NOT NULL,
Telephone char(10) NOT NULL,
nom_formation varchar (30),
taux_reduction int(3) DEFAULT 15,
NomEta varchar (30) not null,
FOREIGN KEY (IdC) REFERENCES Client(IdC)
ON DELETE CASCADE
)
Engine = InnoDB;

CREATE TABLE Salarie (
IdC int(3) not null AUTO_INCREMENT Primary Key,
NomS varchar(25) NOT NULL,
PrenomS varchar (25) NOT NULL,
AdresseS varchar(128) NOT NULL,
CpS char(5) NOT NULL,
VilleS varchar (20) NOT NULL,
DateNaiss DATE NOT NULL,
Telephone char(10) NOT NULL,
nom_entreprise varchar(30) default 'SansEmploi',
FOREIGN KEY (IdC) REFERENCES Client(IdC)
ON DELETE CASCADE
)
Engine = InnoDB;

CREATE TABLE ArchiveClient (
NumC int(3) NOT NULL,
NomC varchar(25) NOT NULL,
PrenomC varchar(25) NOT NULL,
Date_Obtention_Permis DATE NOT NULL,
Date_Obtention_Code DATE NOT NULL,
Nb_Tentatives_Permis int NOT NULL
)
Engine = InnoDB;


CREATE TABLE Identifiants (
Id_Identifiants int(3) not null Auto_Increment Primary Key,
MdP varchar(10) default 0,
Login varchar(10) default 0,
IdM int(3))
Engine = InnoDB;