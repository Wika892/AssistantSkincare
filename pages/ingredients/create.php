<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom'] ?? '');
    $categorie = trim($_POST['categorie'] ?? '');
    $bienfaits = trim($_POST['bienfaits'] ?? '');
    $type_peau_id = $_POST['type_peau_id'] ?? '';

    // Validation
    if ($nom === '') {
        $errors['nom'] = "Le nom est obligatoire.";
    }

    if ($categorie === '') {
        $errors['categorie'] = "La catégorie est obligatoire.";
    }

    if ($bienfaits === '') {
        $errors['bienfaits'] = "Les bienfaits sont obligatoires.";
    }

    if ($type_peau_id === '') {
        $errors['type_peau_id'] = "Le type de peau est obligatoire.";
    }

    if (!$errors) {

        $sql = "INSERT INTO ingredients (nom, categorie, bienfaits, type_peau_id)
                VALUES (?, ?, ?, ?)";

        $statement = $pdo->prepare($sql);

        $statement->execute([
            $nom,
            $categorie,
            $bienfaits,
            $type_peau_id
        ]);
    }
}

?>

<h1>Ajouter un ingrédient</h1>

<form method="post">

    <div>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom">

        <?php if (isset($errors['nom'])) : ?>
            <span class="error"><?= $errors['nom'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="categorie">Catégorie :</label>
        <input type="text" name="categorie" id="categorie">

        <?php if (isset($errors['categorie'])) : ?>
            <span class="error"><?= $errors['categorie'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="bienfaits">Bienfaits :</label>
        <textarea name="bienfaits" id="bienfaits"></textarea>

        <?php if (isset($errors['bienfaits'])) : ?>
            <span class="error"><?= $errors['bienfaits'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="type_peau_id">Type de peau :</label>

        <select name="type_peau_id" id="type_peau_id">

            <option value="">-- Choisir un type de peau --</option>
            <option value="1">Sèche</option>
            <option value="2">Grasse</option>
            <option value="3">Mixte</option>
            <option value="4">Normale</option>

        </select>

        <?php if (isset($errors['type_peau_id'])) : ?>
            <span class="error"><?= $errors['type_peau_id'] ?></span>
        <?php endif ?>
    </div>

    <button>Ajouter</button>

</form>