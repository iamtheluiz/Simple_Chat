<?php
session_start();

$pathFile = $_SERVER['DOCUMENT_ROOT'].'/class/Sys.php' ;

include($pathFile);

$sys = new Sys;
$sys->valid_login();
$pdo = $sys->getPdo();
date_default_timezone_set("America/Sao_Paulo");
