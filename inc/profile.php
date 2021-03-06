<?php
/**
* Affiche les infos d'un membre
* @param $pid Id du membre
*/
function afficherProfil($pid) {
    $infos = recupProfil($pid);
    $teams = recupTeams($pid);

    echo "
        <div class=\"left\">
            <h3>{$infos['upseudo']}</h3>
            <p>
                <img src='avatars/{$infos['uavatar']}' alt='{$infos['upseudo']}' class='avatar' />
            </p>
        </div>
        <div class=\"right\">
            <h3>Informations</h3>
            <p>
                Inscrit depuis le ".date('d/m/Y à h:m', strtotime($infos['uinscription'])).".
                <br>Vu la derniere fois le ".date('d/m/Y à h:m', strtotime($infos['ulastconnec'])).".
            </p>
            <h3>Ses équipes</h3>
            <p>
                ";
                    for ($i = 0; $i < sizeof($teams); $i++) {
                        echo "<a href='equipe-{$teams[$i][0]}'>".$teams[$i][1]."</a>, ";
                    }
                echo "
            </p>
        </div>
        <div class='cb'></div>
    ";
}
/**
* Récupère les infos d'un membre
* @param $pid id du membre
*/
function recupProfil($pid) {
    require_once "bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT upseudo, uavatar, uinscription, ulastconnec, ubanni FROM users WHERE uid = :id");
    $req->bindParam(":id", $pid);
    $req->execute();
    $data = $req->fetch();

    // aucun résultat
    if ($req->rowCount() == 0) {
        header('location:404');
    }

    return $data;
}
/**
 * Récupère les équipes d'un membre
 * @param $pid id du membre
 */
function recupTeams($pid) {
    require_once "bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT eid, enom FROM membreteam
                          RIGHT JOIN equipes ON eid = mtequipe
                          WHERE mtmembre = :id OR eleader = :id");
    $req->bindParam(":id", $pid);
    $req->execute();


    $i = 0;
    $resultats = array();
    while ($data = $req->fetch()) {
        $resultats[$i] = array($data[0], $data[1]);
        $i++;
    }
    return $resultats;
}

function estLeader($uid) {
    require_once "inc/bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT COUNT(*) FROM equipes WHERE eleader = :uid");
    $req->bindParam(":uid", $uid);
    $req->execute();

    $resultat = $req->fetch()[0];

    if ($resultat == 0) {
        return false;
    } else {
        return true;
    }
}
?>
