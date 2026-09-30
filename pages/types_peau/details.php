<?php

$id = $_GET['id'] ?? null;

$sql = "SELECT id, nom, description, caracteristiques, besoins
        FROM types_peau
        WHERE id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$type_peau = $statement->fetch();
// donne les ingredients associes au type de peau
$sql = "SELECT i.id, i.nom
        FROM ingredients i
        -- relie t igredient a t ingredient type peau
        INNER JOIN ingredients_types_peau itp
            ON itp.ingredient_id = i.id -- relie grace a id
        --selectionne les ingredient au type de type de peau
        WHERE itp.type_peau_id = ?
        ORDER BY i.nom";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$ingredients = $statement->fetchAll();

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

<div class="details-type-peau">

    <h1>Peau <?= $type_peau['nom'] ?></h1>

    <img 
        src="images/types_peau/<?= $images[$type_peau['nom']] ?>" 
        alt="Peau <?= $type_peau['nom'] ?>"
    >

    <h2>Qu'est-ce qu'une peau <?= $type_peau['nom'] ?> ?</h2>
    <p><?= $type_peau['description'] ?></p>

    <div class="bloc-detail">
        <h2>Ses Caractéristiques:</h2>
        <ul>
            <?php foreach (explode('|', $type_peau['caracteristiques']) as $caracteristique) : ?>
                <li><?= $caracteristique ?></li>
            <?php endforeach ?>
        </ul>
    </div>

    <div class="bloc-detail">
        <h2>Besoins de la peau</h2>
        <ul>
            <?php foreach (explode('|', $type_peau['besoins']) as $besoin) : ?>
                <li><?= $besoin ?></li>
            <?php endforeach ?>
        </ul>
    </div>

    <h2>Ingrédients adaptés:</h2>

    <div class="cartes-ingredients">

        <?php foreach ($ingredients as $ingredient) : ?>

            <article class="carte-ingredient">

                
                <a href="index.php?page=ingredient-details&id=<?= $ingredient['id'] ?>">
                    <?= $ingredient['nom'] ?>
                </a>
                

            </article>
        <?php endforeach ?>
    
    </div>
</div>