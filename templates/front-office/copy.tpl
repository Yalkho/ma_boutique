<h2>{$title[0].title}</h2>

{$titi|var_dump}

<table>
<thead>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Telephone</th>
    </tr>
</thead>
<tbody>
{foreach $titi as $sous_tableau}
    <tr>
        <td>{$sous_tableau.nom}</td>
        <td>{$sous_tableau['prenom']}</td>
        <td>{$sous_tableau.telephone}</td>
    </tr>
{/foreach}
</tbody>
</table>

<p></p>