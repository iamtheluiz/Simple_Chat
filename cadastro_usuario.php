<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="css/material_icons.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <link rel="manifest" href="manifest.json">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8">
		<title>Cadastrar | Chat</title>
	</head>
	<body>
		<div class="content row">

			<!-- Corpo do Site -->
			<section class="corpo col s12">

				<div class="col s12 m8 l6 offset-m2 offset-l3">
					<br>
					<form action="actions/cadastrar_usuario.php" method="post" autocomplete="off">
						<div class="input-field center-align">
							<i class="material-icons large">edit</i>
						</div>
						
						<div class="input-field">
							<i class="material-icons prefix">account_circle</i>
							<input type="text" name="login" id="login">
							<label for="login">Login</label>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">account_circle</i>
							<input type="password" name="pass" id="pass">
							<label for="pass">Senha</label>
						</div>
						<div class="input-field center-align">
							<button type="submit" class="btn black">Enviar</button><br>
							<a href="index.php">Efetuar Login</a>
						</div>

					</form>
				</div>

			</section>
			<!-- Fim do Corpo do Site -->


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
a{
	color:black !important;
}

	/* label color */
.input-field label {
 color: black;
}
/* label focus color */
.input-field input:focus + label {
 color: white !important;
}

.input-field input{
 border-bottom: 1px solid black !important;
 box-shadow: 0 1px 0 0 black !important;
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
.input-field .prefix.active {
 color: white !important;
}
</style>