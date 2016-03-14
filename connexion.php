<?php
    session_start();
    $titre = "Seek.fr - Connexion";
    include "head.php";
    $msg = "";
    if ($_POST) {
        require_once "inc/connexion.php";
        $msg = connexion($_POST['pseudo'], $_POST['password']);

    }
    // Si la connexion est bonne alors on redirige vers la page d'accueil
    // ou si déjà connecté
    if (isset($_SESSION['id'])) {
        header("location:index");
    }
?>

    <div id="description">
        <p>
            Afin d'utiliser les services de Seek.fr, vous devez vous connecter. Vous n'avez pas de compte ? <a
                href="inscription">Inscrivez-vous</a>.
        </p>
        <form class="connect" action="" method="post">
            <p>
                <?php echo $msg; ?>
                <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" size="25"><br>

                <label for="password">Mot de passe : </label>
                <input type="password" name="password" size="25"><br>

                <label for="submit"> </label>
                <input type="submit" value="Se connecter">
            </p>
        </form>
    </div>
<?php
    include "foot.php";
?>