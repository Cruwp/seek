<?php
session_start();

require_once('inc/forum.php');

$titre ="Seek.fr - Forum";
include "head.php";

if (!isset($_SESSION['id'])) {
    ?>
    <div id="description">
        <p>
            Vous devez être connecté pour accéder à ce service. <a href="connexion">Connexion</a> ou <a
            href="inscription">inscription</a>.
            <?php

            ?>
        </p>
    </div>
    <?php
} else {
    ?>
    <!-- Début code page -->
    <div id="arianne">
        <?php
        echo "<div class=\"arrow\"></div><a href=\"forum.php\">Forum</a>";
        ?>
    </div>

    <div>
        <?php recupCategorie(); ?>
    </div>
    <?php
}
include "foot.php";
?>