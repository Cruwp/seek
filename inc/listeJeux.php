<?php
/**
* liste des jeux de la BDD aux format JSON
* Utilisé pour l'auto complétion à la sélection d'un jeu
*/
if (!isset($_GET['term'])) {
    header("location:404");
}
require_once "bdd.php";
$bdd = bdd();

$term = $_GET['term'];

$requete = $bdd->prepare('SELECT jnom FROM jeux WHERE jnom LIKE :term'); // j'effectue ma requête SQL grâce au mot-clé LIKE
$requete->execute(array('term' => '%'.$term.'%'));

$array = array(); // on créé le tableau

while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, $donnee['jnom']); // et on ajoute celles-ci à notre tableau
}

echo json_encode($array); // il n'y a plus qu'à convertir en JSON
?>
