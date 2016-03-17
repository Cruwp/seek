<?php
session_start();
$titre ="Seek.fr - Jeux actuellement disponibles";
include "head.php";
?>

<div id="description">
    <div id="annonces">
        <h3>Parcourir les jeux</h3>
    </div>
    <div id="games">
        <?php require_once "inc/games.php"; afficherListeJeux(); ?>
        <p>
            <a href="" class="bold">Proposez d'autres jeux !</a>
        </p>
    </div>

</div>
<?php
include "foot.php";
?>
