
<?php

$sql ="SELECT 
            ingredients.id,
            ingredients.nom,
            ingredients.categorie,
            ingredients.bienfaits
        FROM ingredients
        ORDER BY ingredients.nom";

$statement = $pdo->prepare($sql);
$statement->execute();

$ingredients = $statement->fetchAll();

?>


<h1>Liste des ingredients</h1>

<p><?= count($ingredients) ?> ingrédient(s)</p>

<?php if ($_SESSION['user']['role'] === 'admin') : ?>
    <a href="index.php?page=ingredient-create" class="ajouter-ingredient">
        Ajouter un ingrédient
    </a>
<?php endif ?>
<div class="cartes-ingredients-liste">

    <?php foreach ($ingredients as $ingredient) : ?>

        <article class="carte-ingredient-liste">

            <h2><?= $ingredient["nom"] ?></h2>

            <a href="index.php?page=ingredient-details&id=<?= $ingredient['id'] ?>">
                Détails
            </a>

            <?php if ($_SESSION['user']['role'] === 'admin') : ?>
                <a href="index.php?page=ingredient-update&id=<?= $ingredient['id'] ?>">
                    Modifier
                </a>

                <a href="index.php?page=ingredient-delete&id=<?= $ingredient['id'] ?>">
                    Supprimer
                </a>
            <?php endif ?>

        </article>

    <?php endforeach ?>

</div>