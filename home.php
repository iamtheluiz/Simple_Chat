<?php include_once('init/init.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="css/material_icons.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <link rel="manifest" href="manifest.json">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8">
		<title>Login | Chat</title>
	</head>
	<body>
		<div class="content row">

			<?php 
				include_once('components/menu.php');
			?>

			<!-- Lista de Chats -->
			<br>
			<section class="corpo col s12 m8 l6 offset-m2 offset-l3">
				
				<a href="chat_global.php">
					<div class="chat col s12 white">
						<div class="col s3">
							<i class="material-icons medium">web</i>
						</div>
						<div class="col s9">
							<h5>Chat Global</h5>
						</div>
					</div>
				</a>

				<!-- Mostrar todos os usuário do site -->
				<?php

					$sql = "SELECT * from tb_login where cd_login != ".$_SESSION['cd_login'];
					$query = $pdo->prepare($sql);
					$query->execute();

					while($row = $query->fetch(PDO::FETCH_OBJ)){
						echo '<a href="chat_privado.php?type=cadastro&login2='.$row->cd_login.'">
							<div class="chat col s12 white">
								<div class="col s3">
									<i class="material-icons medium">account_circle</i>
								</div>
								<div class="col s9">
									<h5>'.$row->tx_login.'</h5>
								</div>
							</div>
						</a>';
					}

				?>

			</section>
			<!-- Fim da Lista de Chats -->

		</div>
		<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript">
        	$(document).ready(function(){
        		$('.sidenav').sidenav();
        	});
        </script>
	</body>
</html>
<style type="text/css">

#chat{
	max-height: 70vh;
	overflow-y: auto;
}

a{
	color:black !important;
}

	/* label color */
.input-field label {
 color: white;
}
/* label focus color */
.input-field input:focus + label {
 color: white !important;
}

.input-field input{
 border-bottom: 1px solid white !important;
 box-shadow: 0 1px 0 0 white !important;
 color:white;
}
/* label underline focus color */
.input-field input:focus {
 border-bottom: 1px solid white !important;
 box-shadow: 0 1px 0 0 white !important;
 color:white;
}
/* valid color */
.input-field input.valid {
 border-bottom: 1px solid #000 !important;
 box-shadow: 0 1px 0 0 #000 !important;
}
/* invalid color */
.input-field input.invalid {
 border-bottom: 1px solid #000 !important;
 box-shadow: 0 1px 0 0 #000 !important;
}
/* icon prefix focus color */
.input-field .prefix {
 color: white !important;
}
.input-field .prefix.active {
 color: white !important;
}
</style>