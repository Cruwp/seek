<?php
    /**
     * Permet à un user de se logger au site
     * @param $pseudo string pseudo de l'utilisateur
     * @param $password string mot de passe de l'user
     * @return string Msg n'a pas pu se connecter
     */
    function connexion($pseudo, $password) {
        require_once "bdd.php";
        // On établie la connexion à la BD
        $bdd = bdd();

        // On prépare la rqt SQL (moins de failles)
        // On se connecte si l'user est pas banni et si son compte est actif (email de validation)
        $req = $bdd->prepare("SELECT uid, upseudo, upassword, urang FROM users WHERE uactif = 1 AND ubanni = 0 AND upseudo LIKE :pseudo");
        // On fait correspondre les paramètre du SQL avec les variables PHP
        $req->bindParam(":pseudo", $pseudo);
        // On valide la rqt -> execute
        $req->execute();

        // Si on a un résultat alors bonne combinaison pseudo/mdp
        if ($req->rowCount() == 1) {
            // on récupère les données du SELECT
            $data = $req->fetch();

            // On teste la correpondance du mdp
            if (password_verify($password, $data['upassword'])) {
                // On créé la session
                $_SESSION = array(
                    "pseudo" => $pseudo,
                    "id"     => $data['uid'],
                    "rang"   => $data['urang'] // Rang de l'user : admin, modo, ...
                );
                // on met à jour la derniere connexion
                $req = $bdd->prepare("UPDATE users SET ulastconnec = SYSDATE() WHERE uid = :uid");
                $req->bindParam(":uid", $data['uid']);
                $req->execute();
            } else {
                return "<span class='warning'>La combinaison pseudo/mot de passe n'est pas bonne</span><br>";
            }
        } else {
            return "<span class='warning'>Connexion impossible, votre compte est peut-être bloqué ou n'est pas encore activé, veuillez vérifier votre messagerie électronique.</span><br>";
        }
    }