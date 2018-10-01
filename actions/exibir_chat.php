<?php 

	include_once('../init/init.php');

	$sql = "SELECT * from tb_chat join tb_login on id_login = cd_login order by cd_chat asc";
	$query = $pdo->prepare($sql);
	$query->execute();

	while($row = $query->fetch(PDO::FETCH_OBJ)){
		$data = $row->dt_chat;			//Data e Hora da mensagem
		$data = explode(' ',$data);		//Data e hora Separadas
		$hora = $data[1];				//Hora da mensagem
		$hora = explode(':',$hora);		//Hora, minuto e segundo separados
		$hora = $hora[0].':'.$hora[1];	//Hora e minuto da mensagem
		$data = $data[0];				//Data da mensagem

		if($row->cd_login == $_SESSION['cd_login']){
			echo "<div class='chat_box col s12 right-align'>";
				echo "<span>$row->tx_chat<br>";
					echo "<i>$hora</i>";
				echo "</span>";
			echo "</div>";
		}else{
			echo "<div class='chat_box col s12 left-align'>";
				echo "<span>";
					echo "<b>$row->tx_login: </b><br>";
					echo "$row->tx_chat<br>";
					echo "<i>$hora</i>";
				echo "</span>";
			echo "</div>";
			//Css speech bubble generator
		}
		
	}