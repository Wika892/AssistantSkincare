<?php

$sql = "SELECT id, nom
        FROM types_peau
        ORDER BY nom";

$statement = $pdo->prepare($sql);
$statement->execute();

$types_peau = $statement->fetchAll();

?>

<h1>Types de peau</h1>

<p><?= count($types_peau) ?> type(s) de peau</p>

<?php foreach ($types_peau as $type) : ?>

    <article>
        <h2><?= $type['nom'] ?></h2>

        <a href="index.php?page=type-peau-details&id=<?= $type['id'] ?>">
            Voir les détails
        </a>
    </article>

<?php endforeach ?>