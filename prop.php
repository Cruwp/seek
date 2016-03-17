<?php
session_start();
$titre = "Seek.fr - Annonces de joueur";
include "head.php";
if (!isset($_SESSION['id'])) {
    ?>
    <div id="description">
        <p>
            Vous devez être connecté pour accéder à ce service. <a href="connexion">Connexion</a> ou <a href="inscription">inscription</a>.

        </p>
    </div>
    <?php
} else {
    ?>

    <div id="description">
        <div id="annonces">
            <h3>Annonces de joueur</h3>
            <table id="table">
                <?php require_once "inc/annonces.php"; afficherAnnonceJoueur($_GET['p']);?>
            </table>
            <a href="ask-2" class="btndark">Demander à co-opérer</a>
        </div>
    </div>
    <?php
}
include "foot.php";
?>
