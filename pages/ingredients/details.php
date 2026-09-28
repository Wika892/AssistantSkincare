<?php

$id = $_GET['id'] ?? null;

$sql = "SELECT 
            ingredients.nom,
            ingredients.categorie,
            ingredients.bienfaits,
            types_peau.nom AS type_de_peau
        FROM ingredients
        INNER JOIN ingredients_types_peau
            ON ingredients.id = ingredients_types_peau.ingredient_id
        INNER JOIN types_peau
            ON ingredients_types_peau.type_peau_id = types_peau.id
        WHERE ingredients.id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$ingredient = $statement->fetchAll();

?>
<h1><?= $ingredient[0]["nom"] ?></h1>

<p>Catégorie : <?= $ingredient[0]["categorie"] ?></p>

<p>Bienfaits : <?= $ingredient[0]["bienfaits"] ?></p>

<p>Types de peau :</p>

<ul>
    <?php foreach ($ingredient as $type) : ?>
        <li><?= $type["type_de_peau"] ?></li>
    <?php endforeach ?>
</ul>