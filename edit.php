<?php

session_start();
try
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=annuaire;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
<DOCTYPE html>
    <html lang="fr">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <meta charset="utf-8">
    <head>
        <title>modifier</title>
    </head>
    <body>

    <h1>modification de contact</h1>

    <?php
    $contact_id = $_POST['contact_id'];
    $reqcontact = $bdd->query("SELECT * FROM contact WHERE contact_id = $contact_id");

    while ($recup = $reqcontact->fetch()){
    ?>
    <form method="post" action="tr_edit.php">
        <table>
        <tr>
                <td>ID :</td>
                <td><input type="text" name="contact_id" value="<?php echo $recup['contact_id']?>" readonly></td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="contact_nom" value="<?php echo $recup['contact_nom']?>" required></td>
            </tr>
            <tr>
                <td>Prenom : </td>
                <td><input type="text" name="contact_prenom" value="<?php echo $recup['contact_prenom']?>" required></td>
            </tr>
            <tr>
                <td>Telephone : </td>
                <td><input type="text" name="contact_tel" minlength="10" maxlength="10" value="<?php echo $recup['contact_tel']?>"></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="email" name="contact_email" value="<?php echo $recup['contact_email']?>"></td>
            </tr>
        </table>

        <input type ="submit" value="VALIDER">

    </form>
</body>
</html>

    <?php } ?>