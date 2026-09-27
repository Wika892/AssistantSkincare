<?php
$q1 = $_POST['q1'] ?? '';
$q2 = $_POST['q2'] ?? '';
$q3 = $_POST['q3'] ?? '';
$q4 = $_POST['q4'] ?? '';
$q5 = $_POST['q5'] ?? '';
$q6 = $_POST['q6'] ?? '';

$points = [
    'seche' => 0,
    'grasse' => 0,
    'mixte' => 0,
    'normale' => 0
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($q1 === 'oui') {
        $points['seche']++;
    } else {
        $points['normale']++;
    }

    if ($q2 === 'oui') {
        $points['grasse']++;
    } else {
        $points['seche']++;
    }

    if ($q3 === 'partout') {
        $points['grasse']++;
    } elseif ($q3 === 'zone_t') {
        $points['mixte']++;
    } else {
        $points['normale']++;
    }

    if ($q4 === 'oui') {
        $points['mixte']++;
    } else {
        $points['normale']++;
    }

    if ($q5 === 'oui') {
        $points['grasse']++;
    } else {
        $points['mixte']++;
    }

    if ($q6 === 'oui') {
        $points['normale']++;
    } else {
        $points['seche']++;
    }
}

$type_resultat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $type_resultat = array_search(max($points), $points);
}
?>

<?php if ($type_resultat !== '') : ?>

    <h2>Ton résultat</h2>

    <?php if ($type_resultat === 'seche') : ?>
        <h3>Peau sèche</h3>
        <p>Ta peau a tendance à manquer d'hydratation et peut donner une sensation de tiraillement.</p>

    <?php elseif ($type_resultat === 'grasse') : ?>
        <h3>Peau grasse</h3>
        <p>Ta peau produit davantage de sébum et peut avoir tendance à briller.</p>

    <?php elseif ($type_resultat === 'mixte') : ?>
        <h3>Peau mixte</h3>
        <p>Ta zone T peut être plus grasse tandis que tes joues sont plus sèches.</p>

    <?php elseif ($type_resultat === 'normale') : ?>
        <h3>Peau normale</h3>
        <p>Ta peau semble équilibrée et confortable au quotidien.</p>
    <?php endif ?>

<?php endif ?>


<a href="index.php">Retour à l'accueil</a>

<?php if (isset($_GET['erreur'])) : ?>

    <p>Tu dois répondre à toutes les questions avant de découvrir ton type de peau.</p>

<?php endif ?>

<h1>Questionnaire skincare</h1>

<p>Réponds aux questions pour découvrir ton type de peau.</p>

<form method="post" action="index.php?page=resultat">

    <h2>1. Après avoir nettoyé ton visage, ta peau tiraille ?</h2>

    <label>
        <input type="radio" name="q1" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q1" value="non">
        Non
    </label>


    <h2>2. Ta peau brille souvent dans la journée ?</h2>

    <label>
        <input type="radio" name="q2" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q2" value="non">
        Non
    </label>


    <h2>3. Où ta peau brille-t-elle le plus ?</h2>

    <label>
        <input type="radio" name="q3" value="partout">
        Partout
    </label>

    <label>
        <input type="radio" name="q3" value="zone_t">
        Front, nez et menton
    </label>

    <label>
        <input type="radio" name="q3" value="presque_pas">
        Elle ne brille presque pas
    </label>


    <h2>4. Tes joues sont-elles plus sèches que ta zone T ?</h2>

    <label>
        <input type="radio" name="q4" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q4" value="non">
        Non
    </label>


    <h2>5. As-tu tendance à avoir la peau grasse sur l'ensemble du visage ?</h2>

    <label>
        <input type="radio" name="q5" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q5" value="non">
        Non
    </label>


    <h2>6. Ta peau est-elle généralement confortable sans sensation de tiraillement ?</h2>

    <label>
        <input type="radio" name="q6" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q6" value="non">
        Non
    </label>

    <br><br>

    <button>Découvrir mon type de peau</button>

</form>

<?php if ($type_resultat !== '') : ?>

    <h2>Ton résultat</h2>

    <?php if ($type_resultat === 'seche') : ?>

        <h3>Peau sèche</h3>
        <p>Ta peau a tendance à manquer d'hydratation et peut donner une sensation de tiraillement.</p>

    <?php elseif ($type_resultat === 'grasse') : ?>

        <h3>Peau grasse</h3>
        <p>Ta peau produit davantage de sébum et peut avoir tendance à briller.</p>

    <?php elseif ($type_resultat === 'mixte') : ?>

        <h3>Peau mixte</h3>
        <p>Ta zone T peut être plus grasse tandis que tes joues sont plus sèches.</p>

    <?php elseif ($type_resultat === 'normale') : ?>

        <h3>Peau normale</h3>
        <p>Ta peau semble équilibrée et confortable au quotidien.</p>

    <?php endif ?>

<?php endif ?>