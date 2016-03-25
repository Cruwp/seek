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
* Affiche l'annonce d'un joueur
* @param $id Id de l'annonce à afficher
*/
function afficherAnnonceJoueur($id) {

    $resultat = recupAnnonceJoueur($id);
    echo "
    <tr class=\"thead\">
    <th>{$resultat['ptitre']}</th>
    <th></th>
    </tr>
    <tr>
    <td style=\"text-align:center;\">
    <a href=\"profile-{$resultat['uid']}\" class=\"bold\">{$resultat['upseudo']}</a><br>
    <img src=\"avatars/{$resultat['uavatar']}\" class=\"avatar\"/><br>
    Le {$resultat['pdate']}

    <p>
    {$resultat['ppost']}
    </p>
    </td>
    <td>
    <div class=\"item\">
    <a href=\"game-{$resultat['jid']}\">
    <img src=\"mins/{$resultat['jminiature']}.jpg\" alt=\"{$resultat['jnom']}\" /></a>
    <span class=\"game\">{$resultat['jnom']}</span>
    </div>
    </td>
    </tr>";
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
        ORDER BY pdate DESC"
    );
    $req->execute();


    $i = 0;
    $resultats = array();

    while ($data = $req->fetch()) {
        // on met la date au format fr
        $date = date("d/m/Y h:m", strtotime($data['pdate']));

        $resultats[$i] = array($data['pid'], $data['uid'], $data['upseudo'], $data['jid'], $data['jnom'], $date, $data['ptitre']);
        $i++;
    }
    return $resultats;
}

/**
* Récupère l'annonce d'un joueur
* @return array résultat de la requete
*/
function recupAnnonceJoueur($id) {
    require_once "bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT pid, uid, upseudo, jid, jnom, jminiature, pdate, ppost, ptitre, uavatar
        FROM proposition
        JOIN users ON uid = puser
        JOIN jeux ON pjeu = jid
        WHERE pid = :id"
    );
    $req->bindParam(":id", $id);
    $req->execute();

    if ($req->rowCount() == 0) {
        header("location:404");
    }

    $data = $req->fetch();
    // on met la date au format fr
    $data['pdate'] = date("d/m/Y", strtotime($data['pdate']));
    return $data;
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
* Affiche l'annonce d'un team
* @param $id Id de l'annonce à afficher
*/
function afficherAnnonceTeam($id) {

    $resultat = recupAnnonceTeam($id);
    echo "
    <tr class=\"thead\">
    <th>{$resultat['rtitre']}</th>
    <th></th>
    </tr>
    <tr>
    <td style=\"text-align:center;\">
    <a href=\"team-{$resultat['eid']}\" class=\"bold\">{$resultat['enom']}</a><br>
    <img src=\"avatars/{$resultat['eavatar']}\" class=\"avatar\"/><br>
    Le {$resultat['rdate']}

    <p>
    {$resultat['rpost']}
    </p>
    </td>
    <td>
    <div class=\"item\">
    <a href=\"game-{$resultat['jid']}\">
    <img src=\"mins/{$resultat['jminiature']}.jpg\" alt=\"{$resultat['jnom']}\" /></a>
    <span class=\"game\">{$resultat['jnom']}</span>
    </div>
    </td>
    </tr>";
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
        ORDER BY rdate DESC"
    );
    $req->execute();

    $i = 0;
    $resultats = array();

    while ($data = $req->fetch()) {
        // on met la date au format fr
        $date = date("d/m/Y h:m", strtotime($data['rdate']));

        $resultats[$i] = array($data['rid'], $data['eid'], $data['enom'], $data['jid'], $data['jnom'], $date, $data['rtitre']);
        $i++;
    }
    return $resultats;
}
/**
* Récupère l'annonce d'une team
* @return array résultat de la requete
*/
function recupAnnonceTeam($id) {
    require_once "bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT rid, eid, enom, jid, jnom, jminiature, rdate, rpost, rtitre, eavatar
        FROM recrutement
        JOIN equipes ON eid = rteam
        JOIN jeux ON rjeu = jid
        WHERE rid = :id"
    );
    $req->bindParam(":id", $id);
    $req->execute();

    if ($req->rowCount() == 0) {
        header("location:404");
    }

    $data = $req->fetch();
    // on met la date au format fr
    $data['rdate'] = date("d/m/Y", strtotime($data['rdate']));
    return $data;
}

/**
* Créé un nouvelle annonce de recrutement ou de recherche de team
* @param $titre titre de l'annonce
* @param $post contenu de l'annonce
* @param $type type de post : team ou player
*/
function creerAnnonce($titre, $post, $type, $jeu) {
    $auteur = $_SESSION['id'];
    $titre = htmlspecialchars($titre);
    $post = htmlspecialchars($post);
    // Ajout des sauts de lignes
    $post = nl2br($post);
    // 5 chars min et 50 max pour le titre
    if (strlen($titre) < 5 || strlen($titre) > 50) {
        return "<span class='warning'>Le titre est trop court ou trop long</span>";
    }
    // Taille min du contenu
    if (strlen($post) < 10) {
        return "<span class='warning'>Le contenu de l'annonce est trop courte</span>";
    }

    // Test de l'existence du jeu
    require_once "bdd.php";
    $bdd = bdd();

    $req = $bdd->prepare("SELECT jid FROM jeux WHERE jnom = :jeu");
    $req->bindParam(":jeu", $jeu);
    $req->execute();
    $jid = $req->fetch()[0];
    if ($req->rowCount() == 0) {
        return "<span class='warning'>Ce jeu n'existe pas</span>";
    }

    // sinon le jeu existe
    // on enregistre l'annonce.

    if ($type === "player") {
        // Annonce de type player
        $rqt = $bdd->prepare("INSERT INTO proposition(puser, ppost, pjeu, ptitre) VALUES (:auteur, :post, :jeu, :titre)");
        $rqt->bindParam(":auteur", $auteur);
        $rqt->bindParam(":post", $post);
        $rqt->bindParam(":jeu", $jid);
        $rqt->bindParam(":titre", $titre);
        $rqt->execute();

        return "<span class='success'>L'annonce est postée avec succès.<br></span>";

    } elseif ($type === "team") {
        // Annonce de type team

        // Il faut récupérer le numéro de team du membre (leader seulement)
        // Un user ne peut être leader que d'une seule équipe
        $req = $bdd->prepare("SELECT eid FROM equipes WHERE eleader = :uid");
        $req->bindParam(":uid", $auteur);
        $req->execute();

        if ($req->rowCount() == 0) {
            // N'est pas leader d'une team
            header("location:404");
            return null;
        }
        $tid = $req->fetch()[0];

        // Ajoute dans la BD
        $rqt = $bdd->prepare("INSERT INTO recrutement(rteam, rpost, rjeu, rtitre) VALUES (:auteur, :post, :jeu, :titre)");
        $rqt->bindParam(":auteur", $tid);
        $rqt->bindParam(":post", $post);
        $rqt->bindParam(":jeu", $jid);
        $rqt->bindParam(":titre", $titre);
        $rqt->execute();

        return "<span class='success'>L'annonce est postée avec succès.<br></span>";
    } else {
        // erreur
        header("location:404.php");
        return null;
    }
}
