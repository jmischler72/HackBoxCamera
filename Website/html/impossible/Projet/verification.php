<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    // connexion à la base de données
    $db_username = 'root';
    $db_password = 'password';
    $db_name = 'hackboximpossible';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('could not connect to database');

    // on applique la fonction mysqli_real_escape_string pour éliminer les attaques de type injection SQL
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if ($username !== "" && $password !== "") {
        $requete = "SELECT count(*) FROM auth WHERE user = ? AND password = ?";
        $stmt = mysqli_prepare($db, $requete);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($db); // fermer la connexion

        if ($count != 0) {
            // nom d'utilisateur et mot de passe corrects
            $_SESSION['username'] = $username;
            $_SESSION['mdp'] = $password;
            header('Location: stream.php');
            exit;
        } else {
            header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
            exit;
        }
    } else {
        header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
?>
