<?php 

include_once('../init/init.php');

if(isset($_POST['tx_chat']) and !empty($_POST['tx_chat']) and isset($_POST['cd_privado']) and !empty($_POST['cd_privado'])){

	$msg = $_POST['tx_chat'];
	$id_login = $_SESSION['cd_login'];
	$cd_privado = $_POST['cd_privado'];

	$sql = "INSERT into tb_chat_privado values (null,$cd_privado,'$msg',DEFAULT,'$id_login')";
	$query = $pdo->prepare($sql);
	$query->execute();

	echo $sql;
}