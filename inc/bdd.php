<?php
    /**
     * Nouvel objet PDO : Connexion à la base de données
     */
    function bdd() {
        $pdo = null;
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=bd_seek", "root", "");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $pdo;
    }