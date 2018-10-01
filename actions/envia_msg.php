<?php 

include_once('../init/init.php');

$msg = $_POST['tx_chat'];
$id_login = $_SESSION['cd_login'];

$sql = "INSERT into tb_chat values (null,'$msg','$id_login')";
$query = $pdo->prepare($sql);
$query->execute();

echo $sql;