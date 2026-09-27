<?php

$id = $_GET['id'] ?? null;

$sql = "SELECT id, nom
        FROM types_peau
        WHERE id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$type_peau = $statement->fetch();

$sql = "SELECT id, nom
        FROM ingredients
        WHERE type_peau_id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$ingredients = $statement->fetchAll();

?>

<h1><?= $type_peau['nom'] ?></h1>



<h2>Ingrédients adaptés</h2>

<?php foreach ($ingredients as $ingredient) : ?>

    <p>
        <a href="index.php?page=ingredient-details&id=<?= $ingredient['id'] ?>">
            <?= $ingredient['nom'] ?>
        </a>
    </p>

<?php endforeach ?>