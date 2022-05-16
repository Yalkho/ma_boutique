<?php

// Contexte : Controleur

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once('./vendor/smarty/libs/Smarty.class.php');
require_once('./classes/Query.php');

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
$smarty->setTemplateDir('./templates/front-office/');

// Defini l'emplacement du repertoire possedant les .tpl compiles
// Il faut appliquer la commande "sudo chown -R www-data:www-data ./templates_c/"
// car PHP doit avoir l'autorisation d'ecrire dans ce repertoire.
$smarty->setCompileDir('./templates_c/');

// Defini l'emplacement du repertoire des fichiers de cache
$smarty->setCacheDir('./caches/');

$smarty->assign(
    'title', (new Query('SELECT title FROM general', array()))->toArray()
);

$smarty->assign(
    'footer', (new Query('SELECT footer FROM general', array()))->toArray()
);

$smarty->assign(
    'list', (new Query('
    SELECT jeux.id, titre, avatar, plateforme, prix_plateforme
    FROM jeux, categories, editeurs, genres, plateformes, editions WHERE `id_categorie` = `categories`.`id` AND `id_editeur` = `editeurs`.`id` AND `id_genre` = `genres`.`id` AND `id_plateforme` = `plateformes`.`id` AND `id_edition` = `editions`.`id`; ', array()))->toArray()
);

$smarty->assign(
    'top', (new Query('
    SELECT jeux.id, titre, avatar, plateforme, prix_plateforme
    FROM jeux, categories, editeurs, genres, plateformes, editions WHERE `id_categorie` = `categories`.`id` AND `id_editeur` = `editeurs`.`id` AND `id_genre` = `genres`.`id` AND `id_plateforme` = `plateformes`.`id` AND `id_edition` = `editions`.`id` ORDER BY jeux.id DESC LIMIT 4; ', array()))->toArray()
);

if (isset($_GET['details']) && !empty($_GET['details'])) {
$smarty->assign(
    'jeu', (new Query('SELECT 
    jeux.id, titre, avatar, date, categorie, genre, editeur, plateforme, prix_plateforme, edition, prix_edition, description, media
    FROM jeux, categories, editeurs, genres, plateformes, editions 
    WHERE `id_categorie` = `categories`.`id` 
    AND `id_editeur` = `editeurs`.`id` 
    AND `id_genre` = `genres`.`id` 
    AND `id_plateforme` = `plateformes`.`id` 
    AND `id_edition` = `editions`.`id` 
    AND `jeux`.`id` = (:details);', $_GET))->toArray()[0]
);
}

if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    $smarty->assign(
        'list', (new Query('SELECT 
        jeux.id, titre, avatar, date, categorie, genre, editeur, plateforme, prix_plateforme, edition, prix_edition, description, media
        FROM jeux, categories, editeurs, genres, plateformes, editions 
        WHERE `id_categorie` = `categories`.`id` 
        AND `id_editeur` = `editeurs`.`id` 
        AND `id_genre` = `genres`.`id` 
        AND `id_plateforme` = `plateformes`.`id` 
        AND `id_edition` = `editions`.`id` 
        AND `jeux`.`id_categorie` = (:categorie);', $_GET))->toArray()
    );
}

if (isset($_GET['genre']) && !empty($_GET['genre'])) {
    $smarty->assign(
        'list', (new Query('SELECT 
        jeux.id, titre, avatar, date, categorie, genre, editeur, plateforme, prix_plateforme, edition, prix_edition, description, media
        FROM jeux, categories, editeurs, genres, plateformes, editions 
        WHERE `id_categorie` = `categories`.`id` 
        AND `id_editeur` = `editeurs`.`id` 
        AND `id_genre` = `genres`.`id` 
        AND `id_plateforme` = `plateformes`.`id` 
        AND `id_edition` = `editions`.`id` 
        AND `jeux`.`id_genre` = (:genre);', $_GET))->toArray()
    );
}

if (isset($_GET['editeur']) && !empty($_GET['editeur'])) {
    $smarty->assign(
        'list', (new Query('SELECT 
        jeux.id, titre, avatar, date, categorie, genre, editeur, plateforme, prix_plateforme, edition, prix_edition, description, media
        FROM jeux, categories, editeurs, genres, plateformes, editions 
        WHERE `id_categorie` = `categories`.`id` 
        AND `id_editeur` = `editeurs`.`id` 
        AND `id_genre` = `genres`.`id` 
        AND `id_plateforme` = `plateformes`.`id` 
        AND `id_edition` = `editions`.`id` 
        AND `jeux`.`id_editeur` = (:editeur);', $_GET))->toArray()
    );
}

if (isset($_GET['plateforme']) && !empty($_GET['plateforme'])) {
    $smarty->assign(
        'list', (new Query('SELECT 
        jeux.id, titre, avatar, date, categorie, genre, editeur, plateforme, prix_plateforme, edition, prix_edition, description, media
        FROM jeux, categories, editeurs, genres, plateformes, editions 
        WHERE `id_categorie` = `categories`.`id` 
        AND `id_editeur` = `editeurs`.`id` 
        AND `id_genre` = `genres`.`id` 
        AND `id_plateforme` = `plateformes`.`id` 
        AND `id_edition` = `editions`.`id` 
        AND `jeux`.`id_plateforme` = (:plateforme);', $_GET))->toArray()
    );
}

if (isset($_GET['edition']) && !empty($_GET['edition'])) {
    $smarty->assign(
        'list', (new Query('SELECT 
        jeux.id, titre, avatar, date, categorie, genre, editeur, plateforme, prix_plateforme, edition, prix_edition, description, media
        FROM jeux, categories, editeurs, genres, plateformes, editions 
        WHERE `id_categorie` = `categories`.`id` 
        AND `id_editeur` = `editeurs`.`id` 
        AND `id_genre` = `genres`.`id` 
        AND `id_plateforme` = `plateformes`.`id` 
        AND `id_edition` = `editions`.`id` 
        AND `jeux`.`id_edition` = (:edition);', $_GET))->toArray()
    );
}

$smarty->assign(
    'categories', (new Query('SELECT * FROM categories', array()))->toArray()
);

$smarty->assign(
    'genres', (new Query('SELECT * FROM genres', array()))->toArray()
);

$smarty->assign(
    'editeurs', (new Query('SELECT * FROM editeurs', array()))->toArray()
);

$smarty->assign(
    'plateformes', (new Query('SELECT * FROM plateformes', array()))->toArray()
);

$smarty->assign(
    'editions', (new Query('SELECT * FROM editions', array()))->toArray()
);

$smarty->assign(
    'page', $_SERVER['QUERY_STRING'] 
);

$smarty->display('index-master.tpl');

?>