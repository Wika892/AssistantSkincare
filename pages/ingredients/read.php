
<?php

$sql ="SELECT 
            ingredients.id,
            ingredients.nom,
            ingredients.categorie,
            ingredients.bienfaits,
            types_peau.nom AS type_de_peau
        FROM ingredients
        INNER JOIN types_peau
            ON ingredients.type_peau_id = types_peau.id
        ORDER BY ingredients.nom";

$statement = $pdo->prepare($sql);
$statement->execute();

$ingredients = $statement->fetchAll();

?>


<h1>Liste des ingredients</h1>

<p><?= count($ingredients) ?> ingrédient(s)</p>

<?php foreach ($ingredients as $ingredient) : ?>

<article>
    <h2><?= $ingredient["nom"] ?></h2>

    <p>Catégorie : <?= $ingredient["categorie"] ?></p>

    <p>Bienfaits : <?= $ingredient["bienfaits"] ?></p>

    <p>Type de peau : <?= $ingredient["type_de_peau"] ?></p>

    <a href="index.php?page=ingredient-details&id=<?= $ingredient['id'] ?>">
        Détails
    </a>

    <a href="index.php?page=ingredient-update&id=<?= $ingredient['id'] ?>">
        Modifier
    </a>

    <a href="index.php?page=ingredient-delete&id=<?= $ingredient['id'] ?>">
        Supprimer
    </a>

</article>

<?php endforeach ?>