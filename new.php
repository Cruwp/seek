<?php
session_start();
$titre = "Seek.fr - Créer une nouvelle annonce";
include "head.php";
if (!isset($_SESSION['id'])) {

    ?>
    <div id="description">
        <p>
            Vous devez être connecté pour accéder à ce service. <a href="connexion">Connexion</a> ou <a
            href="inscription">inscription</a>.
            <?php
            // Test du parametre
            if (!isset($_GET['a']) || ($_GET['a'] != "player" && $_GET['a'] != "team")) {
                header('location:404');
            }
            ?>
        </p>
    </div>
    <?php
} else {
    ?>

    <div id="description">
        <div id="annonces">
            <h3>Créer une nouvelle annonce </h3>
            <form class="" action="#annonces" method="post">
                <label for="titre">Titre de l'annonce : <br>
                    <input type="text" name="titre" placeholder="Titre de l'annonce">
                </label>
                <br><br>
                <label for="titre">
                    Contenu de l'annonce : <br>
                    <textarea name="post" rows="10" placeholder="Contenu de l'annonce"></textarea>
                </label>
                <br><br>
                <label for="jeu">Choix du jeu : <br>
                    <input type="text" id="jeu" name="jeu" placeholder="Jeu">
                </label>
                <br><br>
                <input type="submit" value="Poster l'annonce">
            </form>
            <?php
            // création du post
            if ($_POST) {
                require_once "inc/annonces.php";
                echo "<p>".creerAnnonce($_POST['titre'], $_POST['post'], $_GET['a'], $_POST['jeu'])."</p>";
            }
            ?>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
    $(function() {
      $( "#jeu" ).autocomplete({
        source: 'inc/listeJeux.php'
      });
    });
    </script>
    <?php
}
include "foot.php";
?>
