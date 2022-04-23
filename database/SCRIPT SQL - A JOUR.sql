//NB : LES DONNEES DE TYPE TIME VONT PEUT ETRE CHANGEES ?
//LE 04/04/22
//author:milo

//Connexion à mySQL distant, création de la BDD et ATTRIBUTION DES DROITS AU USER

mysql -u root -h 217.182.69.119 -p

CREATE DATABASE POURTOUJOURS ;

//On vérifie si la db est bien créée
SHOW DATABASES;

//CONNEXION EN TANT QUE USER

mysql -u TOUJOURS -h 217.182.69.119 -p


//On séléctionne la db PourToujours
USE POURTOUJOURS;

//ON COMMENCE A TOUT CREER :

CREATE TABLE PERSONNE(
	id INTEGER PRIMARY KEY auto_increment,
	nomComplet VARCHAR(70),
	nomPrefere VARCHAR(50),
	date_naissance DATE,
	genre CHAR(1),
	email VARCHAR(60),
	mot_de_passe VARCHAR(255),
	numero_tel CHAR(10),
	departement CHAR(3),
	cle integer,
	confirme integer DEFAULT 0,
	date_inscription DATETIME DEFAULT NOW()
);

CREATE TABLE CONVERSATION( 
	id INTEGER PRIMARY KEY auto_increment,
	date_creation DATETIME,
	personne1 INTEGER NOT NULL REFERENCES PERSONNE(id),
	personne2 INTEGER NOT NULL REFERENCES PERSONNE(id),
	dernier_message DATETIME NOT NULL REFERENCES MESSAGE(heure_envoi)
);

CREATE TABLE MESSAGE(
	id INTEGER PRIMARY KEY auto_increment,
	contenu VARCHAR(255),
	heure_envoi DATETIME DEFAULT NOW(),
	conversation INTEGER NOT NULL REFERENCES CONVERSATION(id),
	id_auteur INTEGER NOT NULL REFERENCES PERSONNE(id)
);

CREATE TABLE UTILISATEUR(
	id INTEGER PRIMARY KEY auto_increment,
	preferences_qcm CHAR(9),
	avatar VARCHAR(40),
	personne INTEGER  NOT NULL UNIQUE REFERENCES PERSONNE(id)
);


CREATE TABLE PRESTATAIRE(
	id INTEGER PRIMARY KEY auto_increment,
	nomEntreprise VARCHAR(30),
	telPro CHAR(10),
	emailPro VARCHAR(60),
	metier VARCHAR(20),
	description VARCHAR(255),
	photoProfil VARCHAR(40),
	lienSiteWeb VARCHAR(100),
	personne INTEGER NOT NULL UNIQUE REFERENCES PERSONNE(id)
);

CREATE TABLE SERVICE(
	id INTEGER PRIMARY KEY auto_increment,
	nom VARCHAR(40),
	type CHAR(1),
	tarif FLOAT,
	description VARCHAR(100),
	prestataire INTEGER NOT NULL REFERENCES PRESTATAIRE(id)
);

CREATE TABLE PORTFOLIO_IMAGES (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(128),
	description VARCHAR(30),
    date_upload DATETIME DEFAULT NOW(),
    prestataire INTEGER NOT NULL REFERENCES PRESTATAIRE(id)
);


CREATE TABLE FAVORI(
	prestataire INTEGER  NOT NULL REFERENCES PRESTATAIRE(id),
	utilisateur INTEGER  NOT NULL REFERENCES UTILISATEUR(id),
	PRIMARY KEY(prestataire, utilisateur)
);


CREATE TABLE COMMENTAIRE(
	id INTEGER PRIMARY KEY auto_increment,
	contenu VARCHAR(255),
	note TINYINT,
	date_envoi DATETIME,
	prestataire INTEGER NOT NULL REFERENCES PRESTATAIRE(id) ,
	utilisateur INTEGER NOT NULL REFERENCES UTILISATEUR(id)
);



CREATE TABLE MARIAGE(
	id INTEGER PRIMARY KEY auto_increment,
	date DATE,
	utilisateur INTEGER NOT NULL UNIQUE REFERENCES UTILISATEUR(id)
);

CREATE TABLE DEMANDE(
	mariage INTEGER REFERENCES MARIAGE(id),
	service INTEGER NOT NULL REFERENCES SERVICE(id),
	statut VARCHAR(10),
	PRIMARY KEY(mariage, service)
);

CREATE TABLE ADRESSE(
	id INTEGER PRIMARY KEY auto_increment,
	numeroRue INTEGER,
	NomRue VARCHAR(150),
	Ville VARCHAR(60),
	code_postal CHAR(5)
);

CREATE TABLE INVITE(
	id INTEGER PRIMARY KEY auto_increment,
	nomComplet VARCHAR(70),
	email VARCHAR(60),
	adresse INTEGER REFERENCES ADRESSE(id)
);


CREATE TABLE EST_INVITE(
	mariage INTEGER NOT NULL REFERENCES MARIAGE(id) ,
	invite INTEGER NOT NULL REFERENCES INVITE(id),
	PRIMARY KEY(mariage, invite)
);

SHOW TABLES ;

