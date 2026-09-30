<?php

$sql = "SELECT id, nom
        FROM types_peau
        ORDER BY nom";

$statement = $pdo->prepare($sql);
$statement->execute();

$types_peau = $statement->fetchAll();

$images = [
    'Acnéique' => 'peau-acneique.jpg',
    'Grasse' => 'peau-grasse.jpg',
    'Mature' => 'peau-mature.jpg',
    'Mixte' => 'peau-mixte.jpg',
    'Normale' => 'peau-normale.jpg',
    'Sèche' => 'peau-seche.jpg',
    'Sensible' => 'peau-sensible.jpg'
];

?>

<h1>Types de peau</h1>

<p><?= count($types_peau) ?> type(s) de peau</p>

<div class="cartes-types-peau">

    <?php foreach ($types_peau as $type) : ?>

        <article class="carte-type-peau">

            <img 
                src="images/types_peau/<?= $images[$type['nom']] ?>" 
                alt="Peau <?= $type['nom'] ?>"
            >

            <h2><?= $type['nom'] ?></h2>

            <a href="index.php?page=type-peau-details&id=<?= $type['id'] ?>">
                Voir les détails
            </a>

        </article>

    <?php endforeach ?>

</div>