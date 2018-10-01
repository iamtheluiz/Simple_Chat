<?php include_once('init/init.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="css/material_icons.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8">
		<title>Login | Chat</title>
	</head>
	<body>
		<div class="content row">

			<?php 
				include_once('components/menu.php');
			?>

			<!-- Caixa de mensagem -->
			<section class="corpo col s12">
				<br><br>
				<div id="chat" class="col s12 m10 l6 offset-m1 offset-l3 grey" style="padding:10px;">
					<!-- Mensagens -->
				</div>

			</section>
			<!-- Fim do Caixa de mensagem -->

			<!-- Envio de Mensagem -->
			<section class="corpo col s12">
				<div class="col s12 m10 l6 offset-m1 offset-l3 black">
					<form action="" method="post" id="form_chat" autocomplete="off">
						<div class="input-field col s10">
							<i class="material-icons prefix">chat</i>
							<input type="text" id="tx_chat" name="tx_chat" value="">
						</div>
						<input type="reset" style="display:none;">
						<div class="input-field col s2 center-align">
							<button type="submit" class="btn-floating green darken-4"><i class="material-icons">send</i></button>
						</div>
					</form>
				</div>

			</section>
			<!-- Fim do Envio de Mensagem -->


		</div>
		<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript">

        	$(document).ready(function(){
        		$('.sidenav').sidenav();
        	});

        	$(function(){
				$('#form_chat').submit(function(event){
					event.preventDefault();
					var formDados = new FormData($(this)[0]);

					$.ajax({
						url:'actions/envia_msg.php',
						type:'POST',
						data:formDados,
						cache:false,
						contentType:false,
						processData:false,
						success:function (data)
			     		{
							$("#form_chat").trigger("reset");
				  		},
						dataType:'html'
					});
					return false;
				});
				atualizar_chat();
			});

			function atualizar_chat() {
					
				jQuery.ajax({
					url: "actions/exibir_chat.php",
					dataType: "html",
					 
					success: function(response){
						jQuery("#chat").html(response);
						var div = $('#chat');
						div.prop("scrollTop", div.prop("scrollHeight"));
					},
					// quando houver erro
					error: function(){
						//alert("Ocorreu um erro durante a requisição");
					}
				});

			}
			atualizar_chat();

			//Atualiza o chat periodicamente
			setInterval(atualizar_chat,500);
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