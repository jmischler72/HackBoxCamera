<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container" class="login-box">
            <!-- zone de connexion -->
            
            <form action="verification.php" method="POST" >
                <h2>PolyCamera Login</h2>
                <div class="user-box">
                
                <input type="text"  name="username" required>
				<label>Username</label>
				</div>
                
				<div class="user-box">
				
                <input type="password"  name="password" required>
				<label>Mot de passe</label>
				</div>
				<a>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
                <input  type="submit" id='submit' value='LOGIN' >
				
				</a>
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];	
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
					if($err==3)
                        echo "<p style='color:red'>Vous devez vous connecter avant de pouvoir accéder à la page de surveillance</p>";
                }
                ?>
				
            </form>
			<h5>Mot de passe oublié ?</h5><a href="mailto: hackbox.polydmin@outlook.fr">Contactez-moi</a>
			
        </div>
		
		

  

    </body>
</html>
