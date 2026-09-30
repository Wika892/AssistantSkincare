<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php?page=ingredients");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom'] ?? '');
    $categorie = trim($_POST['categorie'] ?? '');
    $bienfaits = trim($_POST['bienfaits'] ?? '');
    $type_peau_id = $_POST['type_peau_id'] ?? [];

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

    if (empty($type_peau_id)) {
        $errors['type_peau_id'] = "Le type de peau est obligatoire.";
    }

    if (!$errors) {

        $sql = "INSERT INTO ingredients (nom, categorie, bienfaits)
                VALUES (?, ?, ?)";

        $statement = $pdo->prepare($sql);

        $statement->execute([
            $nom,
            $categorie,
            $bienfaits
        ]);

        $newIngredientId = $pdo->lastInsertId();

        foreach ($type_peau_id as $type_id) {

            $sql = "INSERT INTO ingredients_types_peau
                    (ingredient_id, type_peau_id)
                    VALUES (?, ?)";

            $statement = $pdo->prepare($sql);

            $statement->execute([
                $newIngredientId,
                $type_id
            ]);
        }

        header("Location: index.php?page=ingredient-details&id=" . $newIngredientId);
        exit;
    }
}

?>

<h1>Ajouter un ingrédient</h1>

<form method="post" class="form-modifier">

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

    <div class="types-peau-checkboxes">

        <label>
            <input type="checkbox" name="type_peau_id[]" value="1">
            Sèche
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="2">
            Grasse
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="3">
            Mixte
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="4">
            Normale
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="5">
            Mature
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="6">
            Sensible
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="7">
            Acnéique
        </label>

    </div>

    <?php if (isset($errors['type_peau_id'])) : ?>
        <span class="error"><?= $errors['type_peau_id'] ?></span>
    <?php endif ?>
    

    <button>Ajouter</button>

</form>