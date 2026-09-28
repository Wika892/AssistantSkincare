<?php
$q1 = $_POST['q1'] ?? '';
$q2 = $_POST['q2'] ?? '';
$q3 = $_POST['q3'] ?? '';
$q4 = $_POST['q4'] ?? '';
$q5 = $_POST['q5'] ?? '';
$q6 = $_POST['q6'] ?? '';
$q7 = $_POST['q7'] ?? '';
$q8 = $_POST['q8'] ?? '';
$q9 = $_POST['q9'] ?? '';
$q10 = $_POST['q10'] ?? '';
$q11 = $_POST['q11'] ?? '';
$q12 = $_POST['q12'] ?? '';
$q13 = $_POST['q13'] ?? '';
$q14 = $_POST['q14'] ?? '';

$type_resultat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $points = [
        'seche' => 0,
        'grasse' => 0,
        'mixte' => 0,
        'normale' => 0,
        'mature' => 0,
        'sensible' => 0,
        'acneique' => 0
    ];

    if ($q1 === 'oui') {
        $points['seche']++;
        $points['sensible']++;
    }

    if ($q2 === 'oui') {
        $points['seche']++;
    }

    if ($q3 === 'oui') {
        $points['grasse']++;
    }

    if ($q4 === 'oui') {
        $points['grasse']++;
        $points['acneique']++;
    }

    if ($q5 === 'oui') {
        $points['grasse']++;
        $points['mixte']++;
    }

    if ($q6 === 'oui') {
        $points['seche']++;
        $points['mixte']++;
    }

    if ($q7 === 'oui') {
        $points['normale']++;
    }

    if ($q8 === 'oui') {
        $points['normale']++;
        $points['mixte']++;
    }

    if ($q9 === 'oui') {
        $points['mature']++;
    }

    if ($q10 === 'oui') {
        $points['mature']++;
    }

    if ($q11 === 'oui') {
        $points['sensible']++;
    }

    if ($q12 === 'oui') {
        $points['sensible']++;
    }

    if ($q13 === 'oui') {
        $points['acneique']++;
        $points['grasse']++;
    }

    if ($q14 === 'oui') {
        $points['acneique']++;
    }

    $max_points = max($points);
    $type_resultat = array_search($max_points, $points);
}
?>


<a href="index.php">Retour à l'accueil</a>

<?php if (isset($_GET['erreur'])) : ?>

    <p>Tu dois répondre à toutes les questions avant de découvrir ton type de peau.</p>

<?php endif ?>

<h1>Questionnaire skincare</h1>

<p>Réponds aux questions pour découvrir ton type de peau.</p>

<form method="post" action="index.php?page=resultat">

    <h2>1. Après avoir lavé ton visage, est-ce que ta peau tire ?</h2>

    <label>
        <input type="radio" name="q1" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q1" value="non">
        Non
    </label>


    <h2>2. Est-ce que ta peau est souvent sèche ou manque de confort ?</h2>

    <label>
        <input type="radio" name="q2" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q2" value="non">
        Non
    </label>


    <h2>3. Est-ce que ton visage devient souvent brillant pendant la journée ?</h2>

    <label>
        <input type="radio" name="q3" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q3" value="non">
        Non
    </label>


    <h2>4. Est-ce que tu as souvent les pores visibles ou de petites imperfections ?</h2>

    <label>
        <input type="radio" name="q4" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q4" value="non">
        Non
    </label>


    <h2>5. Est-ce que ton front et ton nez deviennent plus brillants que le reste de ton visage ?</h2>

    <label>
        <input type="radio" name="q5" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q5" value="non">
        Non
    </label>


    <h2>6. Est-ce que tes joues sont souvent plus sèches que ton front et ton nez ?</h2>

    <label>
        <input type="radio" name="q6" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q6" value="non">
        Non
    </label>


    <h2>7. Est-ce que ta peau est généralement confortable et ne te pose pas beaucoup de problèmes ?</h2>

    <label>
        <input type="radio" name="q7" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q7" value="non">
        Non
    </label>


    <h2>8. Est-ce que ta peau est rarement très sèche ou très brillante ?</h2>

    <label>
        <input type="radio" name="q8" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q8" value="non">
        Non
    </label>


    <h2>9. Est-ce que tu remarques de petites lignes sur ton visage ?</h2>

    <label>
        <input type="radio" name="q9" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q9" value="non">
        Non
    </label>


    <h2>10. Est-ce que tu trouves que ta peau est moins souple qu'avant ?</h2>

    <label>
        <input type="radio" name="q10" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q10" value="non">
        Non
    </label>


    <h2>11. Est-ce que ton visage devient facilement rouge ?</h2>

    <label>
        <input type="radio" name="q11" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q11" value="non">
        Non
    </label>


    <h2>12. Est-ce que ta peau réagit facilement à certains produits ?</h2>

    <label>
        <input type="radio" name="q12" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q12" value="non">
        Non
    </label>


    <h2>13. Est-ce que tu as souvent des boutons ou des points noirs ?</h2>

    <label>
        <input type="radio" name="q13" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q13" value="non">
        Non
    </label>


    <h2>14. Est-ce que tu as souvent de petites imperfections qui apparaissent sur ton visage ?</h2>

    <label>
        <input type="radio" name="q14" value="oui">
        Oui
    </label>

    <label>
        <input type="radio" name="q14" value="non">
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

    <?php elseif ($type_resultat === 'mature') : ?>

        <h3>Peau mature</h3>
        <p>Ta peau peut présenter de petites lignes et être moins souple qu'avant.</p>

    <?php elseif ($type_resultat === 'sensible') : ?>

        <h3>Peau sensible</h3>
        <p>Ta peau peut devenir facilement rouge ou inconfortable et réagir à certains produits.</p>

    <?php elseif ($type_resultat === 'acneique') : ?>

        <h3>Peau acnéique</h3>
        <p>Ta peau peut présenter régulièrement des boutons, des points noirs ou de petites imperfections.</p>

    <?php endif ?>

<?php endif ?>