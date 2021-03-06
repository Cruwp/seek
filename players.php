<?php
    session_start();
    $titre = "Seek.fr - Les annonces des joueurs";
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

        <div id="description">
            <div id="annonces">
                <h3>Annonces des joueurs</h3>
                <table id="table" class="tablesorter">
                    <thead>
                        <tr class="thead">
                            <th>Annonce <span class="triangle">▼</span></th>
                            <th>Joueur <span class="triangle">▼</span></th>
                            <th>Jeu <span class="triangle">▼</span></th>
                            <th>Date <span class="triangle">▼</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once "inc/annonces.php";
                        afficherAnnoncesJoueur();
                    ?>
                    </tbody>
                </table>
            </div>
            <p><a href="new-player" class="btndark">Créer une annonce</a></p>
        </div>
        <script>
            $(document).ready(function()
                {
                    $("#table").tablesorter();
                }
            );
        </script>
        <?php
    }
    include "foot.php";
?>
