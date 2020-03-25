<html>
	<head>
		<title>Connexion</title>
		<link rel="stylesheet" type="text/css" href="blog.css">

	</head>
	<body id="bodyConnexion">
		<?php include('header.php'); ?>
		<main id="">
		
	 			
	 		<div id="">
	 			<div id="">CONNEXION</div><br />
	 			<div id="">
	 				<form action="" method="post"><br />

		 				Login : <br /><input type="text" name="login"><br />
		 				Password : <br /><input type="password" name="password"><br />
		 				
	 				
                    </div>
                    <div id="">
                    	<input  type="submit" name="valider">
                    </div>
                    
                    <?php

	                    include('fonctions.php');
	                    connexion();
	                ?>
                </form>
	 			
	 		</div>
			

			 
		</main>
		
	</body>

</html>