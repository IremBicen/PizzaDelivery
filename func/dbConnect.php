<?php
$userNameDB = "root";
$passwordDB = "";
$connect = new PDO("mysql:host=localhost;dbname=pizza;",$userNameDB,$passwordDB);
$connect->exec("SET NAMES UTF8");
error_reporting(0);
?>