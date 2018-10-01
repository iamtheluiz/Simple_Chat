<meta charset="utf-8">
<?php

include_once('../class/Sys.php');
$sys = new Sys;
$pdo = $sys->getPdo();

if(isset($_POST['login']) and isset($_POST['pass']) and !empty($_POST['login']) and !empty($_POST['pass'])){

	$login = $_POST['login'];
	$pass = $_POST['pass'];

	$sys->cadastrar_login($login,$pass);

}else{
	$sys->redirect("Prencha o formulário para acessar essa página!","../index.php");
}