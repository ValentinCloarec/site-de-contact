<?php
//Ouverture de la page

//Définition de l'encodage de la page
header('Content-Type: text/html; charset=utf-8');
header('Location: dashboard.php');

//On accède à la base de données
include('config/bdd.php');


//Récupération des valeurs
$contact_id = $_POST['contact_id'];

                // On vérifie si la variable $contact_id n'est pas vide
                $test = empty($contact_id);
                    if($test == false) {

// Connexion à la base de données
try
{
    $bdd->exec('SET NAMES utf8');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


// Préparation de l'envoi des données vers la base de données
$req = $bdd->prepare("DELETE FROM contact WHERE contact_id = $contact_id");

// Exécution de la requête
$req->execute();


                    }

                    // Si la variable $contact_id est vide, on renvoit un message
                    else{
                        echo "Erreur";
                    }
