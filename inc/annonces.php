<?php

/**
* Affiche les annonces (triées par date par défaut)
*/
function afficherAnnoncesJoueur() {

    $resultats = recupAnnoncesJoueur();

    // affichage des annonces
    for ($i = 0; $i < sizeof($resultats); $i++) {
        echo "<tr class=\"tbody\" onclick=\"document.location='prop-{$resultats[$i][0]}'\">
        <td><b>{$resultats[$i][6]}</b></td>
        <td><a href='profile-{$resultats[$i][1]}'>{$resultats[$i][2]}</a></td>
        <td><a href='game-{$resultats[$i][3]}'>{$resultats[$i][4]}</a></td>
        <td>{$resultats[$i][5]}</td>
        </tr>";
    }
}

/**
* Récupère les annonces dans la BD (triées par date par défaut)
* @return array résultat de la requete triée par $tri
*/
function recupAnnoncesJoueur() {
    require_once "bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT pid, uid, upseudo, jid, jnom, pdate, ptitre
        FROM proposition
        JOIN users ON uid = puser
        JOIN jeux ON pjeu = jid
        ORDER BY pdate DESC");
        $req->execute();
        $i = 0;
        $resultats = array();

        while ($data = $req->fetch()) {
            // on évite les pb d'accents
            $data['ptitre'] = utf8_encode($data['ptitre']);

            // on met la date au format fr
            $date = date("d/m/Y h:m", strtotime($data['pdate']));

            $resultats[$i] = array($data['pid'], $data['uid'], $data['upseudo'], $data['jid'], $data['jnom'], $date, $data['ptitre']);
            $i++;
        }
        return $resultats;
    }

    /**
    * Affiche les annonces (triées par date par défaut)
    */
    function afficherAnnoncesTeam() {

        $resultats = recupAnnoncesTeam();

        // affichage des annonces
        for ($i = 0; $i < sizeof($resultats); $i++) {
            echo "<tr class=\"tbody\" onclick=\"document.location='recrut-{$resultats[$i][0]}'\">
            <td><b>{$resultats[$i][6]}</b></td>
            <td><a href='team-{$resultats[$i][1]}'>{$resultats[$i][2]}</a></td>
            <td><a href='game-{$resultats[$i][3]}'>{$resultats[$i][4]}</a></td>
            <td>{$resultats[$i][5]}</td>
            </tr>";
        }
    }

    /**
    * Récupère les annonces dans la BD (triées par date par défaut)
    * @return array résultat de la requete triée par $tri
    */
    function recupAnnoncesTeam() {
        require_once "bdd.php";
        $bdd = bdd();

        $req = $bdd->prepare("SELECT rid, eid, enom, jid, jnom, rdate, rtitre
            FROM recrutement
            JOIN equipes ON eid = rteam
            JOIN jeux ON rjeu = jid
            ORDER BY rdate DESC");
            $req->execute();
            $i = 0;
            $resultats = array();

            while ($data = $req->fetch()) {
                // on évite les pb d'accents
                $data['rtitre'] = utf8_encode($data['rtitre']);

                // on met la date au format fr
                $date = date("d/m/Y h:m", strtotime($data['rdate']));

                $resultats[$i] = array($data['rid'], $data['eid'], $data['enom'], $data['jid'], $data['jnom'], $date, $data['rtitre']);
                $i++;
            }
            return $resultats;
        }
