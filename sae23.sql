-- Création de la base de données
CREATE DATABASE sae23;

-- Utilisation de la base de données
USE sae23;

-- suppression des tables
DROP TABLE mesure;
DROP TABLE capteur;
DROP TABLE salle;
DROP TABLE batiment;
DROP TABLE gestionnaire;
DROP TABLE administration;

-- Table 'gestionnaire'
CREATE TABLE gestionnaire 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(50) NOT NULL
);

-- Table 'batiment'
CREATE TABLE batiment 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    gestionnaire_id INT
);

-- Table 'salle'
CREATE TABLE salle
 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL UNIQUE,
    type_salle VARCHAR(30) NOT NULL,
    capacite_accueil INT NOT NULL,
    batiment_id INT
);

-- Table 'capteur'
CREATE TABLE capteur
 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL UNIQUE,
    type_capteur VARCHAR(30) NOT NULL,
    unite VARCHAR(20) NOT NULL,
    salle_id INT
);

-- Table 'mesure'
CREATE TABLE mesure 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_mesure DATE NOT NULL,
    horaire TIME NOT NULL,
    valeur DECIMAL(6, 2) NOT NULL,
    capteur_id INT
);

-- Table 'administration'
CREATE TABLE administration 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(50) NOT NULL
);



-- Lien entre 'batiment' et 'gestionnaire'
ALTER TABLE batiment
ADD CONSTRAINT fk_batiment_gestionnaire
FOREIGN KEY (gestionnaire_id) 
REFERENCES gestionnaire(id);

-- Lien entre 'salle' et 'batiment'
ALTER TABLE salle
ADD CONSTRAINT fk_salle_batiment
FOREIGN KEY (batiment_id) 
REFERENCES batiment(id);

-- Lien entre 'capteur' et 'salle'
ALTER TABLE capteur
ADD CONSTRAINT fk_capteur_salle
FOREIGN KEY (salle_id) 
REFERENCES salle(id);

-- Lien entre 'mesure' et 'capteur'
ALTER TABLE mesure
ADD CONSTRAINT fk_mesure_capteur
FOREIGN KEY (capteur_id) 
REFERENCES capteur(id);