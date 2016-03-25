<?php
session_start();
include "head.php";
?>

<div id="description">
    <p>
        SEEK est une plateforme d’échange permettant à des joueurs de recruter d’autres joueurs ou de postuler dans une équipe. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean a venenatis purus. Nam at facilisis odio. Maecenas iaculis, odio nec egestas facilisis, velit neque placerat orci, a pharetra ipsum justo sed ante. Praesent non nibh nec erat iaculis molestie ac a turpis. Nunc posuere feugiat felis.
        <?php
        if (!isset($_SESSION['pseudo'])) {
            echo "<br><br><span><a href=\"connexion\">Connexion</a></span> <span><a href=\"inscription\">Inscription</a></span>";
        }
        ?>
    </p>
    <?php
    if (isset($_SESSION['pseudo'])) {
        ?>
        <p>
            Bienvenue <?php echo $_SESSION['pseudo']; ?>, que souhaitez vous faire ? <br>
                > <a href="#">Modifier les informations de mon profil</a><br>
                > <a href="#">Créer une nouvelle équipe</a>

        </p>
        <?php } ?>
    </div>

    <div id="content">
        <table cellspacing="0">
            <tr>
                <td width="314px" style="background: #e3ddcb;">
                    <h3>Équipes</h3>
                    <p>Parcourez les annonces des équipes recrutant des joueurs et candidatez !</p>
                </td>
                <td width="8px"></td>
                <td width="314px" style="background: #c6beab;">
                    <h3>Joueurs</h3>
                    <p>Ces joueurs recherchent des coéquipiers ! Si votre équipe recrute, sélectionnez votre nouveau membre ici !</p>
                </td>
                <td width="8px"></td>
                <td width="314px" style="background: #e8d4bf;">
                    <h3>Jeux</h3>
                    <p>Parcourez tous les jeux, ici vous trouverez des équipes et des joueurs. Sélectionnez votre jeu favori pour compléter votre équipe.</p>
                </td>
            </tr>
            <tr>
                <td style="background: #e3ddcb;"><span><a href="team">Trouver une équipe !</a></span></td>
                <td></td>
                <td style="background: #c6beab;"><span><a href="players">Trouver un joueur !</a></span></td>
                <td></td>
                <td style="background: #e8d4bf;"><span><a href="games">Parcourir les jeux !</a></span></td>
            </tr>
        </table>
    </div>
    <?php
    include "foot.php";
    ?>
