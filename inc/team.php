<?php
/**
* Ajoute un membre à une équipe
* @param $team id de la team dans laquelle on ajoute le membre
* @param $membre id du membre à ajouter dans la team
*/
function ajouterMembre($team, $membre) {
    // TODO
}
/**
* Retire un membre d'une équipe
* @param $team id de la team dans laquelle on retire le membre
* @param $membre id du membre à retirer dans la team
*/
function retirer($team, $membre) {
    // TODO
}
/**
* Affiche les informations concernant une équipe
* @param $team id de la team
*/
function afficherTeamInfos($team) {

}
/**
* Récupère les infos d'une équipe dans la bdd
* @param $team id de la team
* @return string[] Les infos récupérées dans la BD
*/
function recupTeamInfos($team) {
    return array();
}
/**
* Créé une nouvelle équipe
* @param $nom nom de l'équipe
* @param $desc description de l'équipe
* @param $img avatar de l'équipe
*/
function creerTeam($nom, $desc, $img) {
    $leader = $_SESSION['pseudo'];
    return false;
}
?>
