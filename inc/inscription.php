<?php

    function inscrire($infos, $avatar) {
        // On parcours tous les champs du tableau pour voir si tout est rempli sinon on return un msg d'erreur
        foreach ($infos as $valeur => $k) {
            $valeur = htmlspecialchars($infos[$valeur]);
            if (empty($valeur)) {
                return "<span class='warning'>Veuillez renseigner tous les champs</span><br>";
            }
        }
        $erreurs = "<span class='warning'>";
        $nbErr = 0;
        $img = "0.jpg";


        //Tout est rempli

        // vérifications
        // correspondance mdp
        if ($infos['password'] != $infos['passconf']) {
             $erreurs .= "Les mots de passe ne correspondent pas.<br>";
            $nbErr++;
        }
        // correspondance email
        if (strtolower($infos['email']) != strtolower($infos['emailconf'])) {
            $erreurs .= "Les adresses email ne correspondent pas.<br>";
            $nbErr++;
        }
        // format d'un email
        if (!filter_var($infos['email'], FILTER_VALIDATE_EMAIL)) {
            $erreurs .= "L'email n'est pas valide.<br>";
            $nbErr++;
        }
        // taille pseudo : 3 < pseudo <= 25
        if (strlen($infos['pseudo']) <= 3 || strlen($infos['pseudo']) > 25) {
            $erreurs .= "Le pseudo doit faire entre 4 et 25 caractères.<br>";
            $nbErr++;
        }
        // taille email : < 120
        if (strlen($infos['email']) > 3 && strlen($infos['email']) > 120) {
            $erreurs .= "L'email doit faire moins de 120 caractères.<br>";
            $nbErr++;
        }

        // On vérifie que l'email ou le pseudo ne soit pas déjà pris
        require_once "bdd.php";
        $bdd = bdd();
        $req = $bdd->prepare("SELECT COUNT(*) AS nb FROM users WHERE upseudo = :pseudo OR uemail = :email");
        $req->bindParam(":pseudo", $infos['pseudo']);
        $req->bindParam(":email", $infos['email']);

        $req->execute();
        $nbRes = $req->fetch()['nb'];
        if($nbRes > 0) {
            $erreurs .= "Ce nom d'utilisateur et/ou cet email est/sont déjà utilisé(s)<br>";
            $nbErr++;
        }
        if ($nbErr > 0) {
            $erreurs .= "</span><br>";
            return $erreurs;
        }
        // Vérifications : OK

        $password = password_hash($infos['password'], PASSWORD_DEFAULT); // encodage du mdp

        // génération d'une clé pour le lien d'activation
        $cle = md5(microtime(TRUE)*100000);

        if (!empty($avatar["name"])) {

            $extensions_valides = array( 'jpg' , 'jpeg' , 'png' );

            $extension_upload = strtolower(  substr(  strrchr($avatar['name'], '.')  ,1)  );
            $img = $infos['pseudo'].'.'.$extension_upload;
            if ($avatar['size'] > 25600) {
                return "<span class='warning'>L\'image fait plus de 25Ko.</span><br>";
            }
            if ( in_array($extension_upload,$extensions_valides) ) {
                rename($avatar['tmp_name'], "avatars/".$infos['pseudo'].'.'.$extension_upload);// upload de l'image
            } else {
                return "<span class='warning'>Le format d\'image n'est pas bon</span><br>";
            }

        }

        $req = $bdd->prepare("INSERT INTO users (upseudo, upassword, uemail, uavatar, ucle) VALUES
                              (:pseudo, :password, :email, :image, :cle)");
        $req->bindParam(":pseudo", $infos['pseudo']);
        $req->bindParam(":password", $password);
        $req->bindParam(":email", $infos['email']);
        $req->bindParam(":image", $img);
        $req->bindParam(":cle", $cle);
        $req->execute();

        // On envoye le mail avec le lien d'activation et le récap pseudo/mdp
        $destinataire = $infos['email'];
        $sujet = "[Seek.fr] : Activer votre compte" ;
        $entete = "From: noreply@seek.fr" ;

        $contenu = 'Bienvenue sur Seek.fr,

        Pour activer votre compte, veuillez cliquer sur le lien ci dessous
        ou copier/coller dans votre navigateur internet.

        http://seek.dev/validation.php?email='.urldecode($infos['email']).'&cle='.urlencode($cle).'


        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre.';

        mail($destinataire, $sujet, $contenu, $entete) ; // Envoi du mail
        return "<span class='success'>Inscription validée, pour continuer valider votre compte en cliquant sur le lien que vous avez reçu par email.</span><br>";

    }