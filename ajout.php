<DOCTYPE html>
<html lang="fr">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
<link rel="stylesheet" href="assets/css/main.css" />
<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
<meta charset="utf-8">
<head>
	<title>new</title>
</head>
<body>

<h1>ajout de contact</h1>

<form method="post" action="tr_ajout.php">
<table>
    <tr>
        <td>Nom :</td>
        <td><input type="text" name="contact_nom" required></td>
    </tr>
    <tr>
        <td>Prenom : </td>
        <td><input type="text" name="contact_prenom" required></td>
    </tr>
    <tr>
        <td>Telephone : </td>
        <td><input type="text" minlength="10" maxlength="10" name="contact_tel"></td>
    </tr>
    <tr>
        <td>Email :</td>
        <td><input type="email" name="contact_email"></td>
    </tr>
</table>

    <input type ="submit" value="VALIDER">

</form>

</body>
</html>