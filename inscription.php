<html>

	<head>
		<title>Inscription</title>
		<link rel="stylesheet" type="text/css" href="blog.css">
	</head>

	<body id="">
		<?php include('header.php'); ?>
		<main id="">
			
			<div id="">
				<div id="">INSCRIPTION</div>
				<form action="" method="post" ><br />
					
					<div id="">
						Login :<br /> <input type="text" name="login"><br />
						Mdp :<br /><input type="password" name="password"><br />
						Conf mdp : <br /><input type="password" name="confirmpassword"><br />
					</div>
					<div id="">
						<input type="submit" name="valider">
					</div>
						
				</form>
			<?php

			include('fonctions.php');
			inscription();
			?>
			</div>


		</main>

	</body>
</html>