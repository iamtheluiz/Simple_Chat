<?php 

include_once('../init/init.php');

if(isset($_POST['tx_chat']) and !empty($_POST['tx_chat'])){
	$msg = $_POST['tx_chat'];
	$id_login = $_SESSION['cd_login'];

	$sql = "INSERT into tb_chat values (null,'$msg',DEFAULT,'$id_login')";
	$query = $pdo->prepare($sql);
	$query->execute();

	echo $sql;
}