<?php
/**
* Récupère les catégoriés du forum.
*/
function affichIndexForum() {
    require_once('inc/bdd.php');
    $bdd = bdd();

    $totalMsg = 0;      // Total du nombre de messages dans une catégorie
    $categorie = NULL;

    $sqlCat = "SELECT cat_id, cat_nom FROM forum_categorie";
    $reqCat = $bdd->prepare($sqlCat);
    $reqCat->execute();

    while ($dataCat = $reqCat->fetch()) {
        // Récupération des forums de la catégorie
        $sqlFor = "SELECT forum_id, forum_name, forum_desc,
        forum_last_post_id, forum_nbr_topic, forum_nbr_post
        FROM forum_forum
        WHERE forum_cat_id = :idCat";
        $reqFor = $bdd->prepare($sqlFor);
        $reqFor->bindParam(":idCat", $dataCat['cat_id']);
        $reqFor->execute();
        ?>
        <!-- Affichage d'une nouvelle catégorie -->
        <table class="tableforum">
            <tr class="entete">
                <th class="colnom"><?php echo $dataCat['cat_nom']; ?></th>
                <th class="colnbrsujets">Sujets</th>
                <th class="colnbrmsg">Messages</th>
                <th class="collast">Dernier sujet</th>
            </tr>
            <?php
            while ($dataFor = $reqFor->fetch()) {
                ?>
                <tr>
                    <td class="colnom">
                        <?php
                        echo "<a href=\"unforum-{$dataFor['forum_id']}\">
                        {$dataFor['forum_name']}</a> - {$dataFor['forum_desc']}";
                        ?>
                    </td>
                    <td class="colnbrsujets">
                        <?php echo $dataFor['forum_nbr_topic'] ?>
                    </td>
                    <td class="colnbrmsg">
                        <?php echo $dataFor['forum_nbr_post'] ?>
                    </td>
                    <td class="collast">
                        <?php recupDernierMsg($dataFor['forum_last_post_id']); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
}

/**
* Récupère le dernier message d'un forum.
* @param $idLastPost l'identifiant du dernier post
*/
function recupDernierMsg($idLastPost) {
    require_once('inc/bdd.php');
    $bdd = bdd();

    // Récupération du dernier topic
    $sqlTopic = "SELECT topic_id, topic_titre, topic_creation
    FROM forum_topic
    WHERE topic_id = :idLast";

    $reqTopic = $bdd->prepare($sqlTopic);
    $reqTopic->bindParam(":idLast", $idLastPost);
    $reqTopic->execute();

    // Récupération du dernier post
    $sqlPost = "SELECT post_id, post_time
    FROM forum_post
    WHERE post_topic_id = :idLast";

    $reqPost = $bdd->prepare($sqlPost);
    $reqPost->bindParam(":idLast", $idLastPost);
    $reqPost->execute();
    $dataPost = $reqPost->fetch();
    $laDate = date("d/m H:i", strtotime($dataPost['post_time']));

    if ($dataTopic = $reqTopic->fetch()) {
        echo "<a href=\"topic-{$dataTopic['topic_id']}\">
        {$dataTopic['topic_titre']}</a>
        - {$laDate}";
    } else {
        echo "Aucun sujet";
    }
}
?>
