<?php

$id = $_GET['id'] ?? null;

$sql = "SELECT 
            ingredients.nom,
            ingredients.categorie,
            ingredients.bienfaits,
            types_peau.nom AS type_de_peau
        FROM ingredients
        INNER JOIN types_peau
            ON ingredients.type_peau_id = types_peau.id
        WHERE ingredients.id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$ingredient = $statement->fetch();

?>

<h1><?= $ingredient["nom"] ?></h1>

<p>Catégorie : <?= $ingredient["categorie"] ?></p>

<p>Bienfaits : <?= $ingredient["bienfaits"] ?></p>

<p>Type de peau : <?= $ingredient["type_de_peau"] ?></p>