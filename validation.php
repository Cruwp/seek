<?php
    session_start();
    $titre = "Seek.fr - Validation du compte";
    include "head.php";
    // Gestion de la validation du compte et afichage d'un messsage d'informations

    require "inc/bdd.php";
    if (!isset($_GET['cle']) || !isset($_GET['email'])) {
        header('location:index');
    }   // else
    echo "<div id=\"description\">";
    $cle = $_GET['cle'];
    $email = $_GET['email'];
    $bdd = bdd();

    $req = $bdd->prepare("SELECT uactif, ucle FROM users WHERE uemail = :email");
    $req->bindParam(":email", $email);
    $req->execute();
    $data = $req->fetch();

    if ($data['uactif'] == 1) {
        echo "<p>Le compte est déjà activé. <a href=\"connexion\">Connectez vous</a> pour profiter de votre compte</p>";
    } else {
        if ($cle == $data['ucle']) {
            echo "<p>Votre compte est bien activé. <a href=\"connexion\">Connectez vous</a> pour profiter de votre compte</p>";
            $req2 = $bdd->prepare("UPDATE users SET uactif = 1 WHERE uemail LIKE :email");
            $req2->bindParam(":email", $email);
            $req2->execute();
        } else {
            echo "<p>Erreur, ce compte ne peut pas être activé. <a href=\"connexion\">Connectez vous</a> pour profiter de votre compte</p>";
        }
    }
    echo "</div>";
    include "foot.php";
?>