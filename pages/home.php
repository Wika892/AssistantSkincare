
<?php if (isset($_SESSION['user'])) : ?>

    <h1>🌺 Bonjour <?= $_SESSION['user']['prenom'] ?> 🌺</h1>

<?php else : ?>

    <h1>🌺 Bienvenue sur Assistant Skincare 🌺</h1>

<?php endif ?>





<p>
    Réponds à quelques questions pour découvrir
    les ingrédients adaptés à ton type de peau.
</p>

<p>
    Tu ne connais pas encore ton type de peau ?
</p>

<a href="index.php?page=questionnaire">
    🪷Fait le questionnaire
</a>

<p>
    Tu connais déjà ton type de peau ?
    Découvre les différents types de peau et leurs caractéristiques.
</p>

<a href="index.php?page=types-peau">
    🌸Découvre les types de peau
</a>

<p>
    Tu veux découvrir les différents ingrédients ?
    Consulte la liste des ingrédients disponibles.
</p>

<a href="index.php?page=ingredients">
    🪷 Découvre les différents ingrédients
</a>
