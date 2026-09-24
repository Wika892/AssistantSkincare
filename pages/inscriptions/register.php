<?php

$errors = [];

$values = [
    'prenom'=>'',
    'nom'=>'',
    'email' => '' 
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $values['prenom'] = trim($_POST['prenom']) ?? '';
  $values['nom'] = trim($_POST['nom']) ?? '';
  $values['email'] = trim($_POST['email']) ?? '';

  $password = trim($_POST["password"]);
  $confirmation = trim($_POST["confirmation"]);

  // Validation
  if ($values['prenom'] === '') {
    $errors['prenom'] = "Le prénom est obligatoire.";
  }
  else if (strlen($values['prenom']) > 100) {
    $errors['prenom'] = "Le prénom ne peut pas excéder 100 caractères.";
}


if ($values['nom'] === '') {
    $errors['nom'] = "Le nom est obligatoire.";
  }
  else if (strlen($values['nom']) > 100) {
    $errors['nom'] = "Le nom ne peut pas excéder 100 caractères.";
}


  if ($values['email'] === '') {
    $errors['email'] =  "L'email est obligatoire.";

  }
  else if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Le format de l'email est incorrect.";
  }
  else if (strlen($values['email']) > 180) {
    $errors['email'] = "L'email ne peut pas excéder 180 caractères.";
  }


  if ($password === '') {
    $errors['password'] = "Le mot de passe est obligatoire.";
  }
  else if (strlen($password) < 8) {
    $errors['password'] = "Le mot de passe doit faire minimum 8 caractères.";
  }

  if ($password !== $confirmation) {
    $errors['confirmation'] = "Les deux mots de passe ne correspondent pas.";
  }


  // Enregistrer les données en DB
  if (!$errors) {

    try {
      
      $password_hash = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (prenom, nom, email, password)
              VALUES (?, ?, ?, ?)";

      $statement = $pdo->prepare($sql);
      $statement->execute([
        $values['prenom'],
        $values['nom'],
        $values['email'],
        $password_hash
      ]);

      $_SESSION['user'] = [
        'id' => $pdo->lastInsertId(),
        'prenom' => $values['prenom'],
        'nom' => $values['nom'],
        'email' => $values['email']
      ] ;     

      header("Location: index.php");
      exit();

    } catch (PDOException $e) {
      $errors['email'] = "L'email est déjà pris.";
    }

  }

}

?>

<!-- Template -->

<h1>S'inscrire</h1>

<form method="post">


<div>
  <label for="prenom">Prénom:</label>
  <input type="text" name="prenom" id="prenom" value="<?= $values['prenom'] ?>">

  <?php if(isset($errors['prenom'])) : ?>
    <span class="error"><?= $errors['prenom'] ?></span>
  <?php endif ?>
</div>

<div>
  <label for="nom">Nom:</label>
  <input type="text" name="nom" id="nom" value="<?= $values['nom'] ?>">

  <?php if(isset($errors['nom'])) : ?>
    <span class="error"><?= $errors['nom'] ?></span>
  <?php endif ?>
</div>

  <div>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= $values['email'] ?>">
    <?php if(isset($errors['email'])) : ?>
      <span class="error"><?= $errors['email'] ?></span>
    <?php endif ?>
  </div>


  <div>
    <label for="password">Mot de passe:</label>
    <input type="password" name="password" id="password">
    <?php if(isset($errors['password'])) : ?>
      <span class="error"><?= $errors['password'] ?></span>
    <?php endif ?>
  </div>


  <div>
    <label for="confirmation">Confirmation:</label>
    <input type="password" name="confirmation" id="confirmation">
    <?php if(isset($errors['confirmation'])) : ?>
      <span class="error"><?= $errors['confirmation'] ?></span>
    <?php endif ?>
  </div>

  <button>S'inscrire</button>

</form>

<p>Déjà inscrit ? <a href="index.php?page=login">Connecte toi !</a></p>