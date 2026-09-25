<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "DELETE FROM ingredients
            WHERE id = ?";

    $statement = $pdo->prepare($sql);
    $statement->execute([$id]);

    header("Location: index.php?page=ingredients");
    exit;
}

$sql = "SELECT id, nom
        FROM ingredients
        WHERE id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$ingredient = $statement->fetch();
?>


<h1>Supprimer un ingrédient</h1>

<p>Es-tu sûr de vouloir supprimer <?= $ingredient['nom'] ?> ?</p>

<form method="post">
    <button>Oui, supprimer</button>
</form>

<a href="index.php?page=ingredients">Annuler</a>