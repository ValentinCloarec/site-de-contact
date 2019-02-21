<?php

//On récupère les identifiants pour accéder à la base de données
try
{
    $username = "root";
    $password = "";
    $bdd = new PDO('mysql:host=localhost;dbname=annuaire', $username, $password);
}

//On récupère les éventuelles erreurs
catch (Exception $e)
{

//En cas d'erreur, on affiche un message
    die('Erreur : ' . $e->getMessage());
}
?>
