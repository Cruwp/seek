<?php
/**
* Récupère les catégoriés du forum.
*/
function recupCategorie() {
    require_once('inc/bdd.php');
    $bdd = bdd();

    $totalMsg = 0;      // Total du nombre de messages dans une catégorie
    $categorie = NULL;
    //forum_id, forum_name, forum_desc, forum_last_post_id, forum_nbr_topic, forum_nbr_post
    $sqlCat = "SELECT cat_id, cat_nom FROM forum_categorie";
    $reqCat = $bdd->prepare($sqlCat);
    $reqCat->execute();

    while ($dataCat = $reqCat->fetch()) {
        ?>
        <!-- Affichage d'une nouvelle catégorie -->
        <table class="tableforum">
            <tr>
                <th></th>
                <th><?php $dataCat['cat_nom'] ?></th>
                <th>Nombre de sujets</th>
                <th>Nombre de messages</th>
                <th>Dernier message</th>
            </tr>
        </table>
        <?php
    }
}
?>
