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
    prenom VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
GO


-- Table des types de peau.
CREATE TABLE types_peau (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description VARCHAR(1000) NOT NULL,
    caracteristiques VARCHAR(1000) NOT NULL,
    besoins VARCHAR(1000) NOT NULL
);
GO


-- Types de peau de test.
INSERT INTO types_peau (nom, description, caracteristiques, besoins)
VALUES
(
    'Sèche',
    'La peau sèche manque de lipides et peut provoquer des sensations de tiraillement, des rougeurs ou des zones rugueuses. Elle a besoin d''hydratation et de nutrition pour préserver sa barrière cutanée.',
    'Sensation de tiraillement|Peau parfois rugueuse|Desquamation possible|Manque de confort',
    'Hydratation|Nutrition|Protection de la barrière cutanée|Limiter la perte d''hydratation'
),
(
    'Grasse',
    'La peau grasse produit davantage de sébum. Elle peut présenter une brillance importante, des pores visibles et être sujette aux imperfections. Elle a besoin d''ingrédients qui aident à réguler le sébum et à garder les pores propres.',
    'Brillance plus importante|Production de sébum élevée|Pores visibles|Imperfections possibles',
    'Régulation du sébum|Nettoyage doux|Hydratation légère|Maintien de la barrière cutanée'
),
(
    'Mixte',
    'La peau mixte présente généralement une zone T plus grasse, au niveau du front, du nez et du menton, tandis que les joues peuvent être normales ou plus sèches. Elle a besoin d''un équilibre entre hydratation et régulation du sébum.',
    'Zone T plus brillante|Pores plus visibles sur le front, le nez et le menton|Joues normales ou plus sèches',
    'Équilibre entre hydratation et régulation du sébum|Attention différence selon les zones du visage'
),
(
    'Normale',
    'La peau normale présente généralement un bon équilibre entre hydratation et production de sébum. Elle peut néanmoins avoir besoin d''hydratation, de protection antioxydante et d''ingrédients qui contribuent à maintenir son équilibre.',
    'Production de sébum équilibrée|Peau généralement confortable|Texture régulière|Peu de zones de sécheresse ou de brillance excessive',
    'Maintenir l''hydratation|Protéger la peau des agressions extérieures|Préserver son équilibre'
),
(
    'Mature',
    'La peau mature peut progressivement perdre de l''élasticité, de la fermeté et de l''hydratation. Des ridules et des rides peuvent apparaître. Elle peut bénéficier d''ingrédients hydratants, antioxydants et qui soutiennent l''aspect et la fermeté de la peau.',
    'Perte progressive d''élasticité|Perte de fermeté|Peau parfois plus sèche|Apparition de ridules et de rides',
    'Hydratation|Soutien de la barrière cutanée|Protection antioxydante|Améliorer l''aspect de la fermeté et de l''éclat'
),
(
    'Sensible',
    'La peau sensible réagit facilement aux agressions extérieures et peut présenter des rougeurs, des sensations d''inconfort ou des tiraillements. Elle a besoin de soins doux et apaisants.',
    'Rougeurs possibles|Sensations d''inconfort|Tiraillements|Réactivité aux agressions extérieures',
    'Apaisement|Hydratation|Protection de la barrière cutanée|Réduction des sensations d''inconfort'
),
(
    'Acnéique',
    'La peau acnéique est sujette aux imperfections telles que les boutons, les points noirs et les pores obstrués. Elle peut avoir besoin d''une routine adaptée pour maintenir un équilibre entre purification et hydratation.',
    'Boutons et imperfections|Points noirs possibles|Pores obstrués|Production de sébum parfois importante',
    'Régulation du sébum|Désobstruction des pores|Hydratation|Maintien de la barrière cutanée'
);
GO


-- Table des ingrédients.
CREATE TABLE ingredients (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    categorie VARCHAR(100) NOT NULL,
    bienfaits VARCHAR(500) NOT NULL,
);
GO

CREATE TABLE ingredients_types_peau (
    ingredient_id INT NOT NULL,
    type_peau_id INT NOT NULL,

    PRIMARY KEY (ingredient_id, type_peau_id),

    CONSTRAINT FK_ingredients_types_peau_ingredient
        FOREIGN KEY (ingredient_id)
        REFERENCES ingredients(id),

    CONSTRAINT FK_ingredients_types_peau_type_peau
        FOREIGN KEY (type_peau_id)
        REFERENCES types_peau(id)
);
GO


/* -----------------------------------------------------------------------------
   4. Jeu de données de test
   -------------------------------------------------------------------------- */
INSERT INTO ingredients (nom, categorie, bienfaits)
VALUES
('Acide hyaluronique', 'Acide', 'Hydrate la peau et aide à maintenir son hydratation.'),
('Aloe vera', 'Plante', 'Apaise et hydrate la peau.'),
('Glycérine', 'Humectant', 'Attire et aide à retenir l''eau dans la peau.'),
('Céramides', 'Lipides', 'Aident à renforcer la barrière cutanée et à limiter la perte d''hydratation.'),
('Squalane', 'Lipide', 'Nourrit la peau et aide à maintenir sa souplesse.'),
('Niacinamide', 'Vitamine', 'Aide à réguler le sébum et à améliorer l''apparence des pores.'),
('Acide salicylique', 'Acide', 'Aide à désobstruer les pores et à éliminer les cellules mortes.'),
('Zinc PCA', 'Minéral', 'Aide à réguler le sébum et à maintenir une peau plus équilibrée.'),
('Thé vert', 'Plante', 'Possède des propriétés antioxydantes et aide à apaiser la peau.'),
('Acide azélaïque', 'Acide', 'Aide à améliorer l''aspect des imperfections et à maintenir une peau plus uniforme.'),
('Vitamine C', 'Vitamine', 'Possède une action antioxydante et contribue à améliorer l''éclat de la peau.'),
('Peptides', 'Protéines', 'Aident à soutenir l''aspect de la fermeté et de l''élasticité de la peau.'),
('Rétinol', 'Dérivé de vitamine A', 'Favorise le renouvellement cellulaire et aide à améliorer l''apparence des ridules.'),
('Panthénol', 'Vitamine', 'Aide à apaiser et à maintenir l''hydratation de la peau.'),
('Avoine', 'Plante', 'Aide à apaiser les sensations d''inconfort et à protéger la peau.'),
('Allantoïne', 'Composé apaisant', 'Aide à apaiser la peau et à améliorer son confort.');
GO

INSERT INTO ingredients_types_peau (ingredient_id, type_peau_id)
VALUES
-- Peau sèche
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),

-- Peau grasse
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),

-- Peau mixte
(6, 3),
(1, 3),
(2, 3),
(7, 3),
(8, 3),

-- Peau normale
(1, 4),
(11, 4),
(2, 4),
(6, 4),
(9, 4),

-- Peau mature
(1, 5),
(12, 5),
(11, 5),
(6, 5),
(13, 5),

-- Peau sensible
(2, 6),
(14, 6),
(4, 6),
(15, 6),
(16, 6),

-- Peau acnéique
(7, 7),
(6, 7),
(8, 7),
(10, 7),
(9, 7);
GO


/* -----------------------------------------------------------------------------
   5. Vérification
   -------------------------------------------------------------------------- */

SELECT * FROM users;
SELECT * FROM types_peau;
SELECT * FROM ingredients;
GO