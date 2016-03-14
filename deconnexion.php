<?php
    session_start(); // permet d'utiliser les sessions
    // on casse la session => user plus connecté
    session_destroy();
    // redirection
    header("location:index");