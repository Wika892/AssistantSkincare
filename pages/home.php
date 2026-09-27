<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

?>


<h1>Bonjour <?= $_SESSION['user']['prenom'] ?> !</h1>

<h2>Bienvenue sur Assistant Skincare</h2>

<p>
    Réponds à quelques questions pour découvrir
    les ingrédients adaptés à ton type de peau.
</p>

<a href="index.php?page=questionnaire">
    Faire le questionnaire
</a>

<br>

<a href="index.php?page=types-peau">
    Voir les types de peau
</a>