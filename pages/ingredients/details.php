<?php

$id = $_GET['id'] ?? null;

$sql = "SELECT 
            ingredients.nom,
            ingredients.categorie,
            ingredients.bienfaits,
            types_peau.id AS type_peau_id,
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

<div class="details-ingredient">

    <h1><?= $ingredient[0]["nom"] ?></h1>

    <div class="bloc-detail">
        <h2>Catégorie</h2>
        <p><?= $ingredient[0]["categorie"] ?></p>
    </div>

    <div class="bloc-detail">
        <h2>Bienfaits</h2>
        <p><?= $ingredient[0]["bienfaits"] ?></p>
    </div>

    <div class="bloc-detail">
        <h2>Types de peau</h2>

        <?php foreach ($ingredient as $type) : ?>

            <p>
                <a href="index.php?page=type-peau-details&id=<?= $type['type_peau_id'] ?>">
                    <?= $type["type_de_peau"] ?>
                </a>
            </p>

        <?php endforeach ?>

    </div>

</div>