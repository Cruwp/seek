<?php
    /**
     * Nouvel objet PDO : Connexion à la base de données
     */
    function bdd() {
        $pdo = null;
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=bd_seek", "root", "");

            // Passe en utf-8
			$pdo->query("SET NAMES utf8");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $pdo;
    }
