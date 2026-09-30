<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php?page=ingredients");
    exit;
}

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom'] ?? '');
    $categorie = trim($_POST['categorie'] ?? '');
    $bienfaits = trim($_POST['bienfaits'] ?? '');
    $type_peau_id = $_POST['type_peau_id'] ?? [];

    $errors = [];

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

        // Modifier l'ingrédient
        $sql = "UPDATE ingredients
                SET nom = ?, categorie = ?, bienfaits = ?
                WHERE id = ?";

        $statement = $pdo->prepare($sql);

        $statement->execute([
            $nom,
            $categorie,
            $bienfaits,
            $id
        ]);

        // Supprimer les anciennes associations
        $sql = "DELETE FROM ingredients_types_peau
                WHERE ingredient_id = ?";

        $statement = $pdo->prepare($sql);
        $statement->execute([$id]);

        // Ajouter les nouvelles associations
        foreach ($type_peau_id as $type_id) {

            $sql = "INSERT INTO ingredients_types_peau
                    (ingredient_id, type_peau_id)
                    VALUES (?, ?)";

            $statement = $pdo->prepare($sql);
            $statement->execute([$id, $type_id]);
        }

        header("Location: index.php?page=ingredient-details&id=" . $id);
        exit;
    }
}

// Récupérer l'ingrédient
$sql = "SELECT 
            nom,
            categorie,
            bienfaits
        FROM ingredients
        WHERE id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$ingredient = $statement->fetch();

// Récupérer les types de peau associés
$sql = "SELECT type_peau_id
        FROM ingredients_types_peau
        WHERE ingredient_id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$types_selectionnes = $statement->fetchAll(PDO::FETCH_COLUMN);

?>

<h1>Modifier un ingrédient</h1>

<form method="post" class="form-modifier">

    <div>
        <label for="nom">Nom :</label>

        <input 
            type="text" 
            name="nom" 
            id="nom"
            value="<?= $ingredient['nom'] ?>"
        >
    </div>

    <div>
        <label for="categorie">Catégorie :</label>

        <input 
            type="text" 
            name="categorie" 
            id="categorie"
            value="<?= $ingredient['categorie'] ?>"
        >
    </div>

    <div>
        <label for="bienfaits">Bienfaits :</label>

        <textarea 
            name="bienfaits" 
            id="bienfaits"
        ><?= $ingredient['bienfaits'] ?></textarea>
    </div>

    <div class="types-peau-checkboxes">

        <label>
            <input type="checkbox" name="type_peau_id[]" value="1"
                <?= in_array(1, $types_selectionnes) ? 'checked' : '' ?>>
            Sèche
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="2"
                <?= in_array(2, $types_selectionnes) ? 'checked' : '' ?>>
            Grasse
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="3"
                <?= in_array(3, $types_selectionnes) ? 'checked' : '' ?>>
            Mixte
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="4"
                <?= in_array(4, $types_selectionnes) ? 'checked' : '' ?>>
            Normale
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="5"
                <?= in_array(5, $types_selectionnes) ? 'checked' : '' ?>>
            Mature
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="6"
                <?= in_array(6, $types_selectionnes) ? 'checked' : '' ?>>
            Sensible
        </label>

        <label>
            <input type="checkbox" name="type_peau_id[]" value="7"
                <?= in_array(7, $types_selectionnes) ? 'checked' : '' ?>>
            Acnéique
        </label>

    </div>

    <button>Modifier</button>

</form>