
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

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>TP-CONTACT</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

</head>

<body>



<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
  <h4 class="card-title mt-3 text-center">Inscription</h4>

  <form action="" method="POST">
      <?php
        if (isset($_POST['inscription'])) {

          $mail = htmlspecialchars($_POST['email']);
          $mail_conf = htmlspecialchars($_POST['conf_email']);
          $mdp = sha1($_POST['password']);
          $mdp_conf = sha1($_POST['conf_password']);
          $mdplentgh = strlen($_POST['password']);

          if (!empty($_POST['email']) && !empty($_POST['conf_email']) && !empty($_POST['password']) && !empty($_POST['conf_password'])) {
            if ($mail == $mail_conf) {
              if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $reqmail = $bdd->prepare("SELECT email FROM utilisateurs WHERE email = ?");
                                $reqmail->execute(array($mail));
                                $mailexist = $reqmail->rowCount();
                                if ($mailexist == 0) {
                                  if ($mdplentgh >= 8) {
                                    if ($mdp == $mdp_conf) {
                                      $insertmbr = $bdd->prepare("INSERT INTO utilisateurs(email, password) VALUES(:email, :password)");
                                      $insertmbr->execute(array(
                                        'email' => $_POST['email'],
                                        'password' => $mdp
                                      ));
                                        header('Refresh: 1; url=login.php');
                                      $reussi = "<font color=\"green\">Votre compte a été crée !</font>";
                                    }else {
                                    $erreur = "Vos mots de passes ne correspondent pas !";
                                    }
                                }else{
                                  $erreur = "Mot de passe trop court !";
                                }
                                }else {
                                  $erreur = "Adresse mail déjà utilisée !";
                                }
                          }
                    }else {
                          $erreur = "Vos adresses mail ne correspondent pas !";
                        }
                  }else {
                      $erreur = "Tous les champs doivent être complétés !";
                    }
                }
               ?>
      <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
     </div>
        <input name="email" class="form-control" placeholder="Adresse email" type="email">
    </div>

      <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
     </div>
        <input name="conf_email" class="form-control" placeholder="Confirmer email" type="email">
    </div>



    <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
    </div>


        <input class="form-control" name="password" placeholder="Mot de passe" type="password">
    </div>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
    </div>
        <input class="form-control" name="conf_password" placeholder="Répéter le mot de passe" type="password">
    </div>
    <div class="form-group">
        <input type="submit" value="Je m'inscris" name="inscription" class="btn btn-primary btn-block">
    </div>
 <br><br>
<?php  //Affiche de message d'erreur ou de réussite
                        if(isset($erreur)) {
                        echo '<font color="red">'.$erreur."</font>";
                         }elseif (isset($reussi)) {
                             echo($reussi);
                         }
                     ?>

</form>

    <div class="form-group">
        <a style="color: white;" href="login.php"><button type="button" class="btn btn-primary btn-block">Connexion</button></a>
    </div>

</body>

</html>
