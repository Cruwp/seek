<?php
/**
* Affiche la liste des jeux
*/
function afficherListeJeux() {
    $data = recupListeJeux();
    for ($i = 0; $i < sizeof($data); $i++) {
        echo "<div class=\"item\">
        <a href=\"game-{$data[$i][0]}\">
        <img src=\"mins/{$data[$i][2]}.jpg\" alt=\"{$data[$i][1]}\" /></a>
        <span class=\"game\">{$data[$i][1]}</span>
        </div>";
    }
}
/**
* Récupère la liste des jeux dans la base de données
*/
function recupListeJeux() {
    require_once "bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT jid, jnom, jminiature FROM jeux");
    $req->execute();

    $i = 0;
    while ($data = $req->fetch()) {
        $jeux[$i] = array($data['jid'], $data['jnom'], $data['jminiature']);
        $i++;
    }
    return $jeux;
}
?>
