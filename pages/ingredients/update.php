<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom'] ?? '');
    $categorie = trim($_POST['categorie'] ?? '');
    $bienfaits = trim($_POST['bienfaits'] ?? '');
    $type_peau_id = $_POST['type_peau_id'] ?? '';

    $errors = [];
    //validation
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

        $sql = "UPDATE ingredients
                SET nom = ?, categorie = ?, bienfaits = ?, type_peau_id = ?
                WHERE id = ?";
    
        $statement = $pdo->prepare($sql);
    
        $statement->execute([
            $nom,
            $categorie,
            $bienfaits,
            $type_peau_id,
            $id
        ]);

        header("Location: index.php?page=ingredient-details&id=" . $id);
        exit;
    }

}

$sql = "SELECT 
            nom,
            categorie,
            bienfaits,
            type_peau_id
        FROM ingredients
        WHERE id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$ingredient = $statement->fetch();

?>

<h1>Modifier un ingrédient</h1>

<form method="post">

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

    <div>
    <label for="type_peau_id">Type de peau :</label>

    <select name="type_peau_id" id="type_peau_id">
        <option value="1" <?= $ingredient['type_peau_id'] == 1 ? 'selected' : '' ?>>Sèche</option>
        <option value="2" <?= $ingredient['type_peau_id'] == 2 ? 'selected' : '' ?>>Grasse</option>
        <option value="3" <?= $ingredient['type_peau_id'] == 3 ? 'selected' : '' ?>>Mixte</option>
        <option value="4" <?= $ingredient['type_peau_id'] == 4 ? 'selected' : '' ?>>Normale</option>
    </select>
</div>

    <button>Modifier</button>

</form>