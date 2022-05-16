<?php

// Contexte : Controleur

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once('./../vendor/smarty/libs/Smarty.class.php');
require_once('./../classes/Query.php');

// Instanciation de la classe Smarty
$smarty = (object) new Smarty();

// Desactive le mode debogage
$smarty->debugging = (bool) false;

// Desactive la mise en cache
$smarty->caching = (bool) false;

// Defini la duree des fichiers presents en cache
$smarty->cache_lifetime = (int) 120;

// Force la compilation des fichiers vers les .tpl
$smarty->force_compile = (bool) true;

// Defini l'emplacement du repertoire possedant les .tpl
$smarty->setTemplateDir('./../templates/back-office/');

// Defini l'emplacement du repertoire possedant les .tpl compiles
// Il faut appliquer la commande "sudo chown -R www-data:www-data ./templates_c/"
// car PHP doit avoir l'autorisation d'ecrire dans ce repertoire.
$smarty->setCompileDir('./../templates_c/');

// Formulaire de suppression d'un jeu
if (isset($_POST['delete_jeux']) && !empty($_POST['delete_jeux'])) {
    (new Query("DELETE FROM jeux WHERE `id` = (:delete_jeux)", $_POST))->toNull();
}

// Formulaire d'ajout d'un jeu
if (

(isset($_POST['avatar']) && !empty($_POST['avatar'])) && 
(isset($_POST['titre']) && !empty($_POST['titre'])) && (strlen($_POST['titre']) <= 30) &&
(isset($_POST['date']) && !empty($_POST['date'])) && 
(isset($_POST['description']) && !empty($_POST['description'])) &&
(isset($_POST['media']) && !empty($_POST['media'])) &&
(isset($_POST['id_categorie']) && !empty($_POST['id_categorie'])) && 
(isset($_POST['id_editeur']) && !empty($_POST['id_editeur'])) &&  
(isset($_POST['id_genre']) && !empty($_POST['id_genre'])) && 
(isset($_POST['id_plateforme']) && !empty($_POST['id_plateforme'])) &&
(isset($_POST['prix_plateforme']) && !empty($_POST['prix_plateforme'])) &&
(isset($_POST['id_edition']) && !empty($_POST['id_edition'])) &&
(isset($_POST['prix_edition']) && !empty($_POST['prix_edition'])) &&
(!isset($_POST['id_produit']))
) {

    (new Query("
    INSERT INTO `jeux` 
    (`avatar`, `titre`, `date`, `description`, `media`, `id_categorie`, `id_editeur`, `id_edition`, `prix_edition`, `id_genre`, `id_plateforme`, `prix_plateforme`) 
    VALUES 
    ((:avatar), (:titre), (:date), (:description), (:media), (:id_categorie), (:id_editeur), (:id_edition), (:prix_edition), (:id_genre), (:id_plateforme), (:prix_plateforme));", 
    $_POST
    ))->toNull();

}

// Formulaire de Mise àJour
if (

    (isset($_POST['avatar']) && !empty($_POST['avatar'])) && 
    (isset($_POST['titre']) && !empty($_POST['titre']) && (strlen($_POST['titre']) <= 30)) &&
    (isset($_POST['date']) && !empty($_POST['date'])) && 
    (isset($_POST['description']) && !empty($_POST['description'])) &&
    (isset($_POST['media']) && !empty($_POST['media'])) &&
    (isset($_POST['id_categorie']) && !empty($_POST['id_categorie'])) && 
    (isset($_POST['id_editeur']) && !empty($_POST['id_editeur'])) && 
    (isset($_POST['id_genre']) && !empty($_POST['id_genre'])) && 
    (isset($_POST['id_plateforme']) && !empty($_POST['id_plateforme'])) &&
    (isset($_POST['prix_plateforme']) && !empty($_POST['prix_plateforme'])) &&
    (isset($_POST['id_edition']) && !empty($_POST['id_edition'])) && 
    (isset($_POST['prix_edition']) && !empty($_POST['prix_edition'])) && 
    (isset($_POST['id_produit']) && !empty($_POST['id_produit']))

) {

    (new Query("
    UPDATE 
    `jeux` 
    SET 
    `avatar` = (:avatar), 
    `titre` = (:titre), 
    `date` = (:date), 
    `description` = (:description), 
    `media` = (:media),
    `id_categorie` = (:id_categorie), 
    `id_editeur` = (:id_editeur), 
    `id_edition` = (:id_edition),
    `prix_edition` = (:prix_edition),
    `id_genre` = (:id_genre), 
    `id_plateforme` = (:id_plateforme),
    `prix_plateforme` = (:prix_plateforme)
    WHERE 
    `jeux`.`id` = (:id_produit);
    ", $_POST))->toNull();

}

if (isset($_GET['id_produit']) && !empty($_GET['id_produit'])) {
    $smarty->assign(

        'id_jeu', $_GET['id_produit']
    
    );
}



// Defini l'emplacement du repertoire des fichiers de cache
$smarty->setCacheDir('./../caches/');

$jeux = (object) new Query("SELECT * FROM `jeux`", array());
$smarty->assign(

    'jeux', $jeux->toArray()

);

$categorie = (object) new Query("SELECT * FROM `categories`", array());
$smarty->assign(

    'categories', $categorie->toArray()

);

$editeur = (object) new Query("SELECT * FROM `editeurs`", array());
$smarty->assign(

    'editeurs', $editeur->toArray()

);

$edition = (object) new Query("SELECT * FROM `editions`", array());
$smarty->assign(

    'editions', $edition->toArray()

);

$genre = (object) new Query("SELECT * FROM `genres`", array());
$smarty->assign(

    'genres', $genre->toArray()

);

$plateforme = (object) new Query("SELECT * FROM `plateformes`", array());
$smarty->assign(

    'plateformes', $plateforme->toArray()

);

$smarty->assign(
    'page', $_SERVER['QUERY_STRING'] 
);

$smarty->display('index-master.tpl');

?>