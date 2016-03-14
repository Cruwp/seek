<?php
    session_start();
    $titre = "Seek.fr - Inscription";
    include "head.php";
    $msg = "";
    if ($_POST && $_FILES) {
        require_once "inc/inscription.php";

        $msg = inscrire($_POST, $_FILES['avatar']);

    }
    // Si la connexion est bonne alors on redirige vers la page d'accueil
    // ou si déjà connecté
    if (isset($_SESSION['id'])) {
        header("location:index");
    }
?>

    <div id="description">
        <form class="connect" action="" method="post" enctype="multipart/form-data">
            <p>
                Formulaire d'inscription, vous avez déjà un compte ? <a href="connexion">Connectez vous</a>.
                <br><br>
                <?php echo $msg; ?><br>
                <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" size="25"><br><br>

                <label for="password">Mot de passe : </label>
                <input type="password" name="password" size="25"><br>
                <label for="passconf">Confirmez : </label>
                <input type="password" name="passconf" size="25"><br><br>

                <label for="email">Adresse email : </label>
                <input type="email" name="email" size="25"><br>
                <label for="emailconf">Confirmez : </label>
                <input type="email" name="emailconf" size="25"><br><br>

                <label for="avatar">Photo de profil : </label>
                <input type="file" name="avatar"> (max 25Ko formats : jpg, png)<br><br>
                <label for="submit"> </label>
                <input type="submit" value="S'inscrire">
            </p>
        </form>
    </div>
<?php
    include "foot.php";
?>