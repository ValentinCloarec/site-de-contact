<?php

// On ouvre la session
session_start();
session_unset();

// On ferme la session et on redirige vers l'index
session_destroy();
header('Location: login.php');
exit();
?>