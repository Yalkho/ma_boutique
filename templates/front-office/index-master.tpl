<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="utf-8" />

    <meta name="author" content="" />

    <meta name="copyright" content="" />

    <meta name="description" content="" />

    <meta name="keywords" content="" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="./assets/framework/css/bootstrap.min.css?version=5.1.3" />

    <link rel="icon" type="image/png" href="" />

    <title></title>

</head>

<body>

    <header class="container fluid">
        <nav class="row text-center">
            <a href="./" title="">Accueil</a>
            <a href="./?tous_les_jeux" title="">Tous les Jeux</a>
            <a href="" title=""></a>
            <a href="" title=""></a>
        </nav>
    </header>

    <main class="container-fluid">

        {if $page === ""}

        <section class="row text-center">

            <h1>Nouveautés</h1>

            {foreach $top as $jeu}

            <div class="card col-12 col-md-3">
                <div class="row border border-dark">
                    <div class="col-12 p-1 my-2 badge bg-success"><h3>{$jeu.titre}</h3></div>
                    <div class="card col-8 offset-2 p-1 my-2"><img class="img-fluid w-35" src="{$jeu.avatar}" /></div>
                    <div class="col-6 offset-3 p-1 my-2">{$jeu.plateforme}</div>
                    <div class="col-6 offset-3 p-1 my-2">{$jeu.prix_plateforme}€</div>
                    <div class="col-6 offset-3 p-1 my-2">
                        <a href="./?details={$jeu.id}" type="button" class="badge rounded-pill bg-primary">En savoir plus</a>
                    </div>
                </div>
            </div>

            {/foreach}

        </section>

        {elseif $page === "tous_les_jeux" || 
        $page|strstr:"categorie=" || 
        $page|strstr:"genre=" || 
        $page|strstr:"editeur=" || 
        $page|strstr:"plateforme=" || 
        $page|strstr:"edition="}

        <section class="row text-center">

            <h1>Tous les Jeux</h1>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Trier par categories
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                {foreach $categories as $categorie}
                    <li><a class="dropdown-item" href="./?categorie={$categorie.id}">{$categorie.categorie}</a></li>
                {/foreach}
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Trier par genres
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                {foreach $genres as $genre}
                    <li><a class="dropdown-item" href="./?genre={$genre.id}">{$genre.genre}</a></li>
                {/foreach}
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Trier par editeurs
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                {foreach $editeurs as $editeur}
                    <li><a class="dropdown-item" href="./?editeur={$editeur.id}">{$editeur.editeur}</a></li>
                {/foreach}
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Trier par plateformes
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                {foreach $plateformes as $plateforme}
                    <li><a class="dropdown-item" href="./?plateforme={$plateforme.id}">{$plateforme.plateforme}</a></li>
                {/foreach}
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Trier par editions
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                {foreach $editions as $edition}
                    <li><a class="dropdown-item" href="./?edition={$edition.id}">{$edition.edition}</a></li>
                {/foreach}
                </ul>
            </div>

            {include file="./tous_les_jeux.tpl"}

        </section>

        {elseif $page|strstr:"details="}

        <section class="container-fluid">

            {include file="./details.tpl"}

        </section>

        {elseif $page === "" || $page|strstr:"id_produit="}

        <section>

            <h1>Titre de la section 1</h1>

            <article>
                <h3>Titre de mon article 1</h3>
            </article>

        </section>

        {else}

            <h2>Page indisponible.</h2>
            <a href="./" title="">Revenir a l'accueil</a>

        {/if}

    </main>

    <footer>
    </footer>

    <script type="text/javascript" src="./assets/framework/js/bootstrap.bundle.min.js"></script>

</body>

</html>