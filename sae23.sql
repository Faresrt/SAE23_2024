-- Création de la base de données
DROP DATABASE IF EXISTS sae23;
CREATE DATABASE sae23;

-- Utilisation de la base de données
USE sae23;

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
    nom_capteur VARCHAR(30) NOT NULL UNIQUE,
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
    nom_capteur VARCHAR(30) NOT NULL
);

-- Création de la table 'administration'
CREATE TABLE administration 
(
    id_administration INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(50) NOT NULL
);

-- Création de la table 'composer'
CREATE TABLE composer
(
  id_batiment int(11) NOT NULL,
  id_salle int(11) NOT NULL,
  PRIMARY KEY (id_batiment, id_salle)
);

-- Création de la table 'installer'
CREATE TABLE installer
(
  id_salle int(11) NOT NULL,
  id_capteur int(11) NOT NULL,
  PRIMARY KEY (id_salle, id_capteur)
);

-- Création de la table 'generer'
CREATE TABLE generer
(
  id_capteur int(11) NOT NULL,
  id_mesure int(11) NOT NULL,
  PRIMARY KEY (id_capteur, id_mesure)
);

-- Ajouter la contrainte de clé étrangère pour la table 'salle'
ALTER TABLE salle
ADD CONSTRAINT FK_salle_batiment
FOREIGN KEY (id_batiment) REFERENCES batiment(id_batiment);

-- Ajouter la contrainte de clé étrangère pour la table 'capteur'
ALTER TABLE capteur
ADD CONSTRAINT FK_capteur_salle
FOREIGN KEY (id_salle) REFERENCES salle(id_salle);

-- Ajouter la contrainte de clé étrangère pour la table 'mesure'
ALTER TABLE mesure
ADD CONSTRAINT FK_mesure_capteur
FOREIGN KEY (nom_capteur) REFERENCES capteur(nom_capteur);

-- Ajouter la contrainte de clé étrangère pour la table 'composer'
ALTER TABLE composer
ADD CONSTRAINT FK_composer_batiment
FOREIGN KEY (id_batiment) REFERENCES batiment(id_batiment);

-- Ajouter la contrainte de clé étrangère pour la table 'composer'
ALTER TABLE composer
ADD CONSTRAINT FK_composer_salle
FOREIGN KEY (id_salle) REFERENCES salle(id_salle);

-- Ajouter la contrainte de clé étrangère pour la table 'installer'
ALTER TABLE installer
ADD CONSTRAINT FK_installer_salle
FOREIGN KEY (id_salle) REFERENCES salle(id_salle);

-- Ajouter la contrainte de clé étrangère pour la table 'installer'
ALTER TABLE installer
ADD CONSTRAINT FK_installer_capteur
FOREIGN KEY (id_capteur) REFERENCES capteur(id_capteur);

-- Ajouter la contrainte de clé étrangère pour la table 'generer'
ALTER TABLE generer
ADD CONSTRAINT FK_generer_capteur
FOREIGN KEY (id_capteur) REFERENCES capteur(id_capteur);

-- Ajouter la contrainte de clé étrangère pour la table 'generer'
ALTER TABLE generer
ADD CONSTRAINT FK_generer_mesure
FOREIGN KEY (id_mesure) REFERENCES mesure(id_mesure);



