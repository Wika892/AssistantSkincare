/* -----------------------------------------------------------------------------
   1. Base de données
   -------------------------------------------------------------------------- */

USE master;
GO

-- Le script est réexécutable : on repart d'une base propre.
IF DB_ID('AssistantSkincare') IS NOT NULL
BEGIN
    ALTER DATABASE AssistantSkincare
        SET SINGLE_USER
        WITH ROLLBACK IMMEDIATE;

    DROP DATABASE AssistantSkincare;
END
GO

CREATE DATABASE AssistantSkincare;
GO


/* -----------------------------------------------------------------------------
   2. Connexion (login) et utilisateur (user)
   -------------------------------------------------------------------------- */

USE master;
GO

-- Si le login existe déjà, on le supprime.
IF SUSER_ID('skincare_user') IS NOT NULL
    DROP LOGIN skincare_user;
GO

-- Création du login SQL Server.
CREATE LOGIN skincare_user
    WITH PASSWORD = 'Test1234=',
         DEFAULT_DATABASE = AssistantSkincare,
         CHECK_POLICY = OFF;
GO


USE AssistantSkincare;
GO

-- Création de l'utilisateur dans la base.
CREATE USER skincare_user FOR LOGIN skincare_user;
GO

-- Droits de lecture et d'écriture sur les données.
ALTER ROLE db_datareader ADD MEMBER skincare_user;
ALTER ROLE db_datawriter ADD MEMBER skincare_user;
GO


/* -----------------------------------------------------------------------------
   3. Tables
   -------------------------------------------------------------------------- */

USE AssistantSkincare;
GO

-- Table des utilisateurs du site.
CREATE TABLE users (
    id INT IDENTITY(1,1) PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
GO


-- Table des types de peau.
CREATE TABLE types_peau (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);
GO


-- Types de peau de test.
INSERT INTO types_peau (nom)
VALUES
('Sèche'),
('Grasse'),
('Mixte'),
('Normale');
GO


-- Table des ingrédients.
CREATE TABLE ingredients (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    categorie VARCHAR(100) NOT NULL,
    bienfaits VARCHAR(500) NOT NULL,
    type_peau_id INT NOT NULL,

    CONSTRAINT FK_ingredients_types_peau
        FOREIGN KEY (type_peau_id)
        REFERENCES types_peau(id)
);
GO


/* -----------------------------------------------------------------------------
   4. Jeu de données de test
   -------------------------------------------------------------------------- */

INSERT INTO ingredients (
    nom,
    categorie,
    bienfaits,
    type_peau_id
)
VALUES
(
    'Acide hyaluronique',
    'Acide',
    'Hydrate et aide à maintenir l hydratation de la peau.',
    1
),
(
    'Aloe vera',
    'Plante',
    'Apaise et hydrate la peau.',
    1
),
(
    'Niacinamide',
    'Vitamine',
    'Aide à réguler le sébum.',
    2
),
(
    'Acide salicylique',
    'Acide',
    'Aide à désobstruer les pores.',
    2
);
GO


/* -----------------------------------------------------------------------------
   5. Vérification
   -------------------------------------------------------------------------- */

SELECT * FROM users;
SELECT * FROM types_peau;
SELECT * FROM ingredients;
GO