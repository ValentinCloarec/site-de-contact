<?php
try
{
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=annuaire;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

session_start();
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

    <h4 class="card-title mt-3 text-center">Se connecter</h4>

  <form action="" method="POST">
      <?php
      if(isset($_POST['connexion'])) {

      $mailconnect = htmlspecialchars($_POST['email']);
      $mdpconnect = sha1($_POST['password']);
      // Vérification de la valiter des information entré
      if(!empty($mailconnect) && !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = ? AND password = ?");
      $requser->execute(array(
      $mailconnect,
      $mdpconnect
      ));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
      $userinfo = $requser->fetch();
      $_SESSION['utilisateur_id'] = $userinfo['utilisateur_id'];
      header("Location: dashboard.php?id=".$_SESSION['utilisateur_id']);
      } else {
      $erreur_connexion = "Mauvais mail ou mot de passe !";
      }
      } else {
      $erreur_connexion = "Tous les champs doivent être complétés !";
      }
      }
      ?>
                <fieldset>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Adresse email" type="email">
                    </div>




                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>


                        <input class="form-control" name="password" placeholder="Mot de passe" type="password">
                    </div>


                    <div class="form-group">
                        <input type="submit" value="Connexion" name="connexion" class="btn btn-primary btn-block">
                    </div>

                    <?php  //Affiche de message d'erreur ou de réussite
                    if(isset($erreur_connexion)) {
                        echo '<font color="red">' . $erreur_connexion . "</font>";
                    }
                    ?>
                    <br>
                </fieldset>
      <div class="form-group">
          <a style="color: white;" href="register.php"><button type="button" class="btn btn-primary btn-block">Inscription</button></a>
      </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  </body>
</html>
