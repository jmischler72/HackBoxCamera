<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = 'password';
    $db_name     = 'hackbox';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // Possible injections SQL / XSS
    $username = $_POST['username']; 
    $password = $_POST['password'];
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM auth where user ='".$username."' and password = '".$password."'";
        $requete = "SELECT count(*) FROM auth where user = '".$username."' and password = '".$password.   "' ";
	//$requete = "select count(*) from auth where user='admin' and password='' OR 1=1 "; 
	$exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
	//die($requete);
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
         $_SESSION['username'] = $username;
		   $_SESSION['mdp'] = $password;
		   
           header('Location: stream.php');
		
		
		
        }
        else
        {
           header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
?>
