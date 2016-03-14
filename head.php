<?php
    if (!isset($titre)) {
        $titre = "Seek.fr - Recherche de co-équipiers";
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titre;?></title>
    <link rel="stylesheet" href="index.css" media="screen" type="text/css">
    <script type="text/javascript" src="jquery-latest.js"></script>
    <script src="jquery.tablesorter.js" type="text/javascript"></script>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg" />
    <meta name="description" content="Plateforme d'échange pour recruter ou rejoindre un équipe de joueurs">
</head>
<body>
<header>
    <nav>
        <a href="index">Accueil</a>
        <a href="teams">équipes</a>
        <a href="players">Joueurs</a>
        <a href="games">Jeux</a>
        <a href="forum">Forum</a>
        <a href="contact">Contact</a>
        <?php
            if (isset($_SESSION['id']))  {
                echo "<a href='deconnexion'>Déconnexion</a>";
            }
        ?>
    </nav>
</header>
<div id="title">
    <h1>SEEK</h1>
    <h2>Recherche de co-équipiers</h2>
</div>