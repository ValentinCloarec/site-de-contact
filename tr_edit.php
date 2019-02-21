<?php
//Ouverture de la page

//Définition de l'encodage de la page
header('Content-Type: text/html; charset=utf-8');
header('Location: dashboard.php');

//On accède à la base de données
include('config/bdd.php');


//Récupération des valeurs
$contact_id = $_POST['contact_id'];
$contact_nom = $_POST['contact_nom'];
$contact_prenom = $_POST['contact_prenom'];
$contact_tel = $_POST['contact_tel'];
$contact_email = $_POST['contact_email'];

//Connexion à la base de données
    try
    {
        $bdd->exec('SET NAMES utf8');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }


//Préparation de l'envoi des données vers la base de données
$req = $bdd->prepare("UPDATE contact SET contact_nom='$contact_nom', contact_prenom ='$contact_prenom', contact_tel='$contact_tel', contact_email='$contact_email' WHERE contact_id='$contact_id'");

//Exécution de la requête
    $req->execute(array(
        'contact_nom' => $contact_nom,
        'contact_prenom' => $contact_prenom,
        'contact_tel' => $contact_tel,
        'contact_email' => $contact_email
    ));