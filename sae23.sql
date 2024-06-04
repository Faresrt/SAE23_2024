-- Création de la base de données
CREATE DATABASE sae23;

-- Utilisation de la base de données
USE sae23;

-- Ordre de suppression des tables
DROP TABLE IF EXISTS generer;
DROP TABLE IF EXISTS installer;
DROP TABLE IF EXISTS composer;
DROP TABLE IF EXISTS mesure;
DROP TABLE IF EXISTS capteur;
DROP TABLE IF EXISTS salle;
DROP TABLE IF EXISTS batiment;
DROP TABLE IF EXISTS administration;

-- Création de la table 'batiment'
CREATE TABLE batiment 
(
    id_batiment INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
	id_gestionnaire INT,
    login VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(50) NOT NULL
);

-- Création de la table 'salle'
CREATE TABLE salle
 (
    id_salle INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL UNIQUE,
    type_salle VARCHAR(30) NOT NULL,
    capacite_accueil INT NOT NULL,
	id_batiment INT
);

-- Création de la table 'capteur'
CREATE TABLE capteur
 (
    id_capteur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL UNIQUE,
    type_capteur VARCHAR(30) NOT NULL,
    unite VARCHAR(20) NOT NULL,
    id_salle INT
);

-- Création de la table 'mesure'
CREATE TABLE mesure 
(
    id_mesure INT AUTO_INCREMENT PRIMARY KEY,
    date_mesure DATE NOT NULL,
    horaire TIME NOT NULL,
    valeur DECIMAL(6, 2) NOT NULL,
    id_capteur INT
);

-- Création de la table 'administration'
CREATE TABLE administration 
(
    id_administration INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(50) NOT NULL
);

-- Création de la table 'generer'
CREATE TABLE generer  
(
    id_capteur INT,
	id_mesure INT,
	PRIMARY KEY(id_capteur, id_mesure)
	
);

-- Création de la table 'installer'
CREATE TABLE installer
(
    id_salle INT,
	id_capteur INT,
	PRIMARY KEY(id_salle, id_capteur)
	
);

-- Création de la table 'composer'
CREATE TABLE composer
(
    id_batiment INT,
	id_salle INT,
	PRIMARY KEY(id_batiment, id_salle)
	
);


-- Ajout des contraintes de clé étrangère


-- Contrainte de clé étrangère pour la table 'generer' reliant 'id_capteur' à 'capteur(id_capteur)'
ALTER TABLE generer
ADD CONSTRAINT fk_generer_capteur
FOREIGN KEY (id_capteur)
REFERENCES capteur(id_capteur)
ON DELETE CASCADE;

-- Contrainte de clé étrangère pour la table 'generer' reliant 'id_mesure' à 'mesure(id_mesure)'
ALTER TABLE generer
ADD CONSTRAINT fk_generer_mesure
FOREIGN KEY (id_mesure)
REFERENCES mesure(id_mesure)
ON DELETE CASCADE;

-- Contrainte de clé étrangère pour la table 'installer' reliant 'id_salle' à 'salle(id_capteur)'
ALTER TABLE installer
ADD CONSTRAINT fk_installer_salle
FOREIGN KEY (id_salle)
REFERENCES salle(id_salle)
ON DELETE CASCADE;

-- Contrainte de clé étrangère pour la table 'installer' reliant 'id_capteur' à 'capteur(id_capteur)'
ALTER TABLE installer
ADD CONSTRAINT fk_installer_capteur
FOREIGN KEY (id_capteur)
REFERENCES capteur(id_capteur)
ON DELETE CASCADE;

-- Contrainte de clé étrangère pour la table 'composer' reliant 'id_batiment' à 'batiment(id_batiment)'
ALTER TABLE composer
ADD CONSTRAINT fk_composer_batiment
FOREIGN KEY (id_batiment)
REFERENCES batiment(id_batiment)
ON DELETE CASCADE;

-- Contrainte de clé étrangère pour la table 'composer' reliant 'id_salle' à 'salle(id_salle)'
ALTER TABLE composer
ADD CONSTRAINT fk_composer_salle
FOREIGN KEY (id_salle)
REFERENCES salle(id_salle)
ON DELETE CASCADE;

-- Contrainte de clé étrangère pour la table 'salle' reliant 'id_batiment' à 'composer(id_capteur)'
ALTER TABLE salle
ADD CONSTRAINT fk_batiment
FOREIGN KEY (id_batiment)
REFERENCES composer(id_batiment)
ON DELETE CASCADE;

-- Contrainte de clé étrangère pour la table 'capteur' reliant 'id_salle' à 'installer(id_salle)'
ALTER TABLE capteur
ADD CONSTRAINT fk_salle
FOREIGN KEY (id_salle)
REFERENCES installer(id_salle)
ON DELETE CASCADE;

-- Contrainte de clé étrangère pour la table 'mesure' reliant 'id_capteur' à 'generer(id_capteur)'
ALTER TABLE mesure
ADD CONSTRAINT fk_capteur
FOREIGN KEY (id_capteur)
REFERENCES generer(id_capteur)
ON DELETE CASCADE;