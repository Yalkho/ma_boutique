{foreach $list as $jeu}

<div class="card col-12 col-md-3">
    <div class="row border border-dark">
        <div class="col-12 p-1 my-2 badge bg-success">
            <h3>{$jeu.titre}</h3>
        </div>
        <div class="card col-8 offset-2 p-1 my-2"><img class="img-fluid w-35" src="{$jeu.avatar}" /></div>
        <div class="col-6 offset-3 p-1 my-2">{$jeu.plateforme}</div>
        <div class="col-6 offset-3 p-1 my-2">{$jeu.prix_plateforme}€</div>
        <div class="col-6 offset-3 p-1 my-2">
            <a href="./?details={$jeu.id}" type="button" class="badge rounded-pill bg-primary">En savoir plus</a>
        </div>
    </div>
</div>

{/foreach}