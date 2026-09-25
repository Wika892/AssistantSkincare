
<?php

session_start();

// Gestion des routes
$routes = [

  '' => [
    'file' => 'pages/home.php',
    'title' => 'Accueil'
  ],

  // gestion ingredients
  'ingredients' => [
    'file' => 'pages/ingredients/read.php',
    'title' => 'ingredients',
  ],

'ingredient-details' => [
  'file' => 'pages/ingredients/details.php',
  'title' => 'Détails de l\'ingrédient',
],
'ingredient-create' => [
    'file' => 'pages/ingredients/create.php',
    'title' => 'Ajouter un ingrédient',
],

'ingredient-update' => [
    'file' => 'pages/ingredients/update.php',
    'title' => 'Modifier un ingrédient',
],

'ingredient-delete' => [
    'file' => 'pages/ingredients/delete.php',
    'title' => 'Supprimer un ingrédient',
],


  /**
   * Gestion de l'authentification
   */

  'register' => [
    'file' => 'pages/inscriptions/register.php',
    'title' => 'S\'inscrire',
  ],

  'login' => [
    'file' => 'pages/inscriptions/login.php',
    'title' => 'Se connecter',
  ],

  'logout' => [
    'file' => 'pages/inscriptions/logout.php',
    'title' => 'Se déconnecter',
  ],


];

$page = $_GET['page'] ?? '';
$route = $routes[$page] ?? null;

if ($route === null) {
  $route = [
    'file' => 'pages/errors/not-found.php',
    'title' => "404 not found"
  ];
}


$file = $route["file"];
$title = $route["title"];

require_once 'config/database.php';

// Assembler les pages

ob_start();
require_once $file;
$content = ob_get_clean();


require_once 'partials/header.php';
echo $content;
require_once 'partials/footer.php';