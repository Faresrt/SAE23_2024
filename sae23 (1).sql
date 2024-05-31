-- Utilisation de la base de données
USE sae23;

-- suppression des tables
DROP TABLE IF EXISTS relever;
DROP TABLE IF EXISTS installer;

DROP TABLE IF EXISTS posseder;
DROP TABLE IF EXISTS generer;
DROP TABLE IF EXISTS administration;
DROP TABLE IF EXISTS mesure;
DROP TABLE IF EXISTS capteur;
DROP TABLE IF EXISTS salle;
DROP TABLE IF EXISTS composer;
DROP TABLE IF EXISTS batiment;
DROP TABLE IF EXISTS gestionnaire;
DROP TABLE IF EXISTS administration;


-- Table 'batiment'
CREATE TABLE batiment 
(
    id_batiment INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
	id_gestionnaire INT,
    login VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(50) NOT NULL
);

-- Table 'salle'
CREATE TABLE salle
 (
    id_salle INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL UNIQUE,
    type_salle VARCHAR(30) NOT NULL,
    capacite_accueil INT NOT NULL,
	id_batiment INT
);

-- Table 'capteur'
CREATE TABLE capteur
 (
    id_capteur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL UNIQUE,
    type_capteur VARCHAR(30) NOT NULL,
    unite VARCHAR(20) NOT NULL,
    id_salle INT
);

-- Table 'mesure'
CREATE TABLE mesure 
(
    id_mesure INT AUTO_INCREMENT PRIMARY KEY,
    date_mesure DATE NOT NULL,
    horaire TIME NOT NULL,
    valeur DECIMAL(6, 2) NOT NULL,
    id_capteur INT
);

-- Table 'administration'
CREATE TABLE administration 
(
    id_administration INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(50) NOT NULL
);

-- Table 'generer'
CREATE TABLE generer  
(
    id_capteur INT,
	id_mesure INT,
	PRIMARY KEY(id_capteur, id_mesure)
	
);

-- Table 'installer'
CREATE TABLE installer
(
    id_salle INT,
	id_capteur INT,
	PRIMARY KEY(id_salle, id_capteur)
	
);

-- Table 'composer'
CREATE TABLE composer
(
    id_batiment INT,
	id_salle INT,
	PRIMARY KEY(id_batiment, id_salle)
	
);



-- Lien entre 'capteur' et 'installer'
ALTER TABLE capteur
ADD CONSTRAINT fk_capteur_installer
FOREIGN KEY (id_salle)
REFERENCES installer(id_salle);

-- Lien entre 'salle' et 'composer'
ALTER TABLE salle
ADD CONSTRAINT fk_salle_composer
FOREIGN KEY (id_batiment)
REFERENCES composer(id_batiment);

-- Lien entre 'mesure' et 'capteur'
ALTER TABLE mesure
ADD CONSTRAINT fk_mesure_capteur
FOREIGN KEY (id_capteur) 
REFERENCES capteur(id_capteur);

-- Lien entre 'generer' et 'mesure'
ALTER TABLE generer
ADD CONSTRAINT fk_generer_mesure
FOREIGN KEY (id_mesure) 
REFERENCES mesure(id_mesure);

-- Lien entre 'generer' et 'capteur'
ALTER TABLE generer
ADD CONSTRAINT fk_generer_capteur
FOREIGN KEY (id_capteur) 
REFERENCES capteur(id_capteur);

-- Lien entre 'relever' et 'salle'
ALTER TABLE relever
ADD CONSTRAINT fk_relever_salle
FOREIGN KEY (id_salle) 
REFERENCES salle(id_salle);

-- Lien entre 'relever' et 'capteur'
ALTER TABLE relever
ADD CONSTRAINT fk_relever_capteur
FOREIGN KEY (id_capteur) 
REFERENCES capteur(id_capteur);

-- Lien entre 'composer' et 'salle'
ALTER TABLE composer
ADD CONSTRAINT fk_composer_salle
FOREIGN KEY (id_salle) 
REFERENCES salle(id_salle);

-- Lien entre 'composer' et 'batiment'
ALTER TABLE composer
ADD CONSTRAINT fk_composer_batiment
FOREIGN KEY (id_batiment) 
REFERENCES batiment(id_batiment);
