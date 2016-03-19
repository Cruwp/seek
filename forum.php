<?php
session_start();

require_once('inc/forum.php');

$titre ="Seek.fr - Forum";
include "head.php";
?>
<div id="description">

    <?php
    if (!isset($_SESSION['id'])) {
        ?>
        <p>
            Vous devez être connecté pour accéder à ce service. <a href="connexion">Connexion</a> ou <a
            href="inscription">inscription</a>.</p>
            <?php
        } else {
            ?>
            <!-- Fil d'arianne -->
            <div id="arianne">
                <?php
                echo "<div class=\"arrow\"></div><a href=\"forum\">Forum</a>";
                ?>
            </div>

            <!-- Affichage des catégories et des forums -->
            <?php affichIndexForum(); ?>
        </div>
        <?php
    }
    include "foot.php";
    ?>
