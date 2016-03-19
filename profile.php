<?php
session_start();
$titre ="Seek.fr - Profil";
include "head.php";
?>

<div id="description">
    <div id="annonces">
        <h3>Profil d'un joueur</h3>
    </div>
    <div id="profil">
        <?php require_once "inc/profile.php"; afficherProfil($_GET['p']); ?>
    </div>

</div>
<?php
include "foot.php";
?>
