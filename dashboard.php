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
<html lang="fr">
	<head>
		<link rel="stylesheet" type="text/css" href="dashboard_css.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<meta charset="utf-8">
		<title>Dashboard</title>
        <style>
            .invisible{
                background-color: transparent;
                border: 0px solid transparent;
                color: white;
                height: 0px;
                width: 0px;
                position: relative;
                float: left;
            }
        </style>
	</head>
	<body>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nom</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <a href="ajout.php"> <button type="button" class="btn btn-secondary btn-sm">Ajouter</button></a>&nbsp;
  <a href="logout.php"><button type="button" class="btn btn-secondary btn-sm">Déconnexion</button></a><br /><br />
  <?php
  $utilisateur_id = $_SESSION['utilisateur_id'];
  $reqcontact = $bdd->query("SELECT * FROM contact WHERE proprietaire_id=$utilisateur_id");

  while ($recup = $reqcontact->fetch()){
      ?>
    <tr>
      <th><?php echo $recup['contact_id']?></th>
      <td><?php echo $recup['contact_nom']?></td>
      <td><table><tr><form action="fiche-contact.php" method="POST"><input class="invisible" type="text" name="contact_id" value="<?php echo $recup['contact_id']?>" readonly><input type="submit" value="Profil" class="btn btn-secondary btn-sm"></form>&nbsp;
          <form action="edit.php" method="POST"><input class="invisible" type="text" name="contact_id" value="<?php echo $recup['contact_id']?>" readonly><input type="submit" value="Modifier" class="btn btn-secondary btn-sm"></form>&nbsp;
          <form action="suppr.php" method="POST"><input class="invisible" type="text" name="contact_id" value="<?php echo $recup['contact_id']?>" readonly><input type="submit" value="Supprimer" class="btn btn-secondary btn-sm"></form>
              </tr></table></td>
     </tr>
    <?php
        }
    ?>
  </tbody>
</table>
				
			</tr>
		</tbody>
	</table>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>
