<?php 

	include_once('../init/init.php');

	$sql = "SELECT * from tb_chat join tb_login on id_login = cd_login order by cd_chat asc";
	$query = $pdo->prepare($sql);
	$query->execute();

	while($row = $query->fetch(PDO::FETCH_OBJ)){

		if($row->cd_login == $_SESSION['cd_login']){
			echo "<div class='chat_box col s12 right-align'>";
			echo "<span>$row->tx_chat</span>";
			echo "</div>";
		}else{
			echo "<div class='chat_box col s12 left-align'>";
			echo "<span><b>$row->tx_login: </b><br>$row->tx_chat</span>";
			echo "</div>";
			//Css speech bubble generator
		}
		
	}