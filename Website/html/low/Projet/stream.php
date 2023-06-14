<!DOCTYPE html> <?php session_start(); if (($_SESSION['username'] == 
'admin')) {
    
}
else { header('Location: login.php?erreur=3');
}
?> <html lang="en"> <head> <meta charset="utf-8" /> <meta 
        name="viewport" content="width=device-width, initial-scale=1, 
        shrink-to-fit=no" /> <meta name="description" content="" /> 
        <meta name="author" content="" /> <title>PolyCamera</title> <!-- 
        Favicon-->
		<link rel="icon" type="image/x-icon" 
		href="https://upload.wikimedia.org/wikipedia/commons/c/c3/Circle-icons-camera.svg"
        <!-- Core theme CSS (includes Bootstrap)--> <link 
        rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
    </head> 
	
	<body> <!-- Responsive navbar--> 
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
	<div class="container">
  <a class="navbar-brand" href="#">
    <img src="Seul.png" width="30" height="30" class="d-inline-block align-top" alt="  ">
      PolyHome Low
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
     
      
      
    </ul>
      
      <a href="logout.php">
				<button type="button" class="btn btn-outline-info my-4 my-sm-0" >Déconnexion</button>
		</a>
    
  </div>
  </div>
</nav>
				
			
			
	
	<div class="container text-center mt-5">
	
			<h2>Bienvenue sur la page d'administration de la caméra</h2>
            <div class="text-center mt-5 embed-responsive embed-responsive-16by9">
			
					<iframe scrolling="no" width="640" height="480"class="embed-responsive-item" src="http://192.168.1.2:5000/video_feed"></iframe>
					<br>
					<br>
					<br>
					<br>
		    </div>
			
			
        </div>
		
		
		<div class="container text-center mt-3">
		
		<h3><u> Vos photos capturées </u></h3>
		<?php
$urlphoto = "Pictures";

// nom du répertoire qui contient les images
$nomRepertoire = "Pictures";
if (is_dir($nomRepertoire))
   {
   $dossier = opendir($nomRepertoire);
   while ($Fichier = readdir($dossier))
       {
      if ($Fichier != "." AND $Fichier != ".." AND stristr($Fichier,'.jpg') )
        {
        // Hauteur de toutes les images
        $h_vign = "120";
        $taille = getimagesize($nomRepertoire."/".$Fichier);
        $reduc  = floor(($h_vign*100)/($taille[1]));
        $l_vign = floor(($taille[0]*$reduc)/100);
      
          echo '<a target="_blank" href="', $urlphoto, '/',$Fichier, '">';
          echo '<img src="', $urlphoto, '/',$Fichier, '" ';
          echo "width='$l_vign' height='$h_vign'>";
          echo "</a>&nbsp;";
          }
        }    
   closedir($dossier);
   }else{
   echo' Le répertoire spécifié n\'existe pas';
   }
?>
		
		</div>
        
		
		
		
    </body> 
	
	
<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Create by Emilien and Gwenael, IA2R student in Polytech Nancy, Modified by Guillaume, Florian, Joeffrey, Clément and Faly</p>
    
  </div>
</footer>
	
</html>
