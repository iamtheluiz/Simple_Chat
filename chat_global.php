<?php include_once('init/init.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="css/material_icons.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <link rel="manifest" href="manifest.json">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
		<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
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
							<textarea type="text" id="tx_chat" name="tx_chat" class="materialize-textarea"></textarea>
							<?php 
								include_once('components/emojis.php');
							?>
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
							$("#tx_chat").html('');
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

			//Função que da submit no form quando se aperta a tecla enter
			document.getElementById('tx_chat').onkeypress = function(evt) {
				evt = evt || window.event;
				var key = evt.keyCode || evt.which;
				
				if(key == 13){
					$('#form_chat').submit();
				}
			};

			atualizar_chat();

			//Atualiza o chat periodicamente
			setInterval(atualizar_chat,500);
        </script>
	</body>
</html>