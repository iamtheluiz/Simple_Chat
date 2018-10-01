<?php 

	include_once('../init/init.php');

	$sql = "SELECT * from tb_chat join tb_login on id_login = cd_login order by cd_chat asc";
	$query = $pdo->prepare($sql);
	$query->execute();

	while($row = $query->fetch(PDO::FETCH_OBJ)){
		echo "<div class='col s12'>";
		echo "<b>$row->tx_login: </b><span>$row->tx_chat</span>";
		echo "</div>";
	}