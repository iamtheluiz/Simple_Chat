<meta charset="utf-8">
<?php 

	include_once('init/init.php');

	if(isset($_GET['type']) and isset($_GET['login2']) and !empty($_GET['type']) and !empty($_GET['login2'])){

		if($_GET['type'] == 'cadastro'){

			$cd_login2 = $_GET['login2'];
			$valid = 0;		//Variavel que verifica se já existe o chat privado

			//Verifica se já foi criado um chat privado para os dois
			$sql = "SELECT * from tb_privado where id_login2 = $cd_login2 and id_login1 = ".$_SESSION['cd_login'];
			$query = $pdo->prepare($sql);
			$query->execute();

			if($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_OBJ);
				$valid++;
			}

			$sql_v = "SELECT * from tb_privado where id_login1 = $cd_login2 and id_login2 = ".$_SESSION['cd_login'];
			$query_v = $pdo->prepare($sql_v);
			$query_v->execute();

			if($query_v->rowCount() > 0){
				$row = $query_v->fetch(PDO::FETCH_OBJ);
				$valid++;
			}

			if($valid != 0){
				//Já existe o chat entre os dois
				header('location: chat_privado.php?cd='.$row->cd_privado);
			}else{

				//Cadastra um chat privado
				$sql_i = "INSERT into tb_privado values (null,'$cd_login2','".$_SESSION['cd_login']."')";
				$query_i = $pdo->prepare($sql_i);
				$query_i->execute();

				//echo $sql_i;

				if($query_i->rowCount() > 0){

					//Verifica se já foi criado um chat privado para os dois
					$sql = "SELECT * from tb_privado where id_login2 = $cd_login2 and id_login1 = ".$_SESSION['cd_login'];
					$query = $pdo->prepare($sql);
					$query->execute();

					if($query->rowCount() > 0){
						$row_t = $query->fetch(PDO::FETCH_OBJ);
					}

					$sql_v = "SELECT * from tb_privado where id_login1 = $cd_login2 and id_login2 = ".$_SESSION['cd_login'];
					$query_v = $pdo->prepare($sql_v);
					$query_v->execute();

					if($query_v->rowCount() > 0){
						$row_t = $query_v->fetch(PDO::FETCH_OBJ);
					}

					header('location: chat_privado.php?cd='.$row_t->cd_privado);

				}

			}

		}else{
			header('location: home.php');
		}

	}else if(isset($_GET['cd']) and !empty($_GET['cd'])){
		$cd = $_GET['cd'];

		//Verifica se o código do privado é válido
		$sql_v = "SELECT a.cd_login as cd_1, b.cd_login as cd_2, a.tx_login as tx_1, b.tx_login as tx_2 from tb_privado join tb_login as a on id_login1 = a.cd_login join tb_login as b on id_login2 = b.cd_login where (b.cd_login != ".$_SESSION['cd_login']." or a.cd_login != ".$_SESSION['cd_login'].") and cd_privado = $cd";
		$query_v = $pdo->prepare($sql_v);
		$query_v->execute();

		if($query_v->rowCount() > 0){
			//Código válido
			$row_v = $query_v->fetch(PDO::FETCH_OBJ);

			//Os dois usuários
			if($row_v->cd_1 != $_SESSION['cd_login']){

				$user = $row_v->tx_1;

			}else if($row_v->cd_2 != $_SESSION['cd_login']){

				$user = $row_v->tx_2;

			}

		}else{
			//$sys->redirect("Selecione um chat válido!","home.php");
		}
	}

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="css/material_icons.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <link rel="manifest" href="manifest.json">
		<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
		<meta charset="UTF-8">
		<title>Login | Chat</title>
	</head>
	<body>
		<div class="content row">

			<?php 
				include_once('components/menu.php');
			?>

			<!-- Caixa de usuário -->
			<section class="corpo col s12">
				<br><br>
				<div class="col s12 m10 l6 offset-m1 offset-l3 black" style="padding:10px;">
					<div class="chat col s12 black white-text">
						<div class="col s3">
							<i class="material-icons medium">account_circle</i>
						</div>
						<div class="col s9">
							<h5><?php echo $user; ?></h5>
						</div>
					</div>
				</div>

			</section>
			<!-- Fim do Caixa de usuário -->

			<!-- Caixa de mensagem -->
			<section class="corpo col s12">
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
						<input type="hidden" name="cd_privado" value="<?php echo $cd; ?>">
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
						url:'actions/msg_privado.php',
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
					url: "actions/exibir_chat_privado.php?cd=<?php echo $cd; ?>",
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