<?php

$location = 'localhost';
$user = 'root';
$pass = '';
$dataBase = 'sysweb';

$conex = new mysqli($location,$user,$pass,$dataBase);
if($conex->connect_error){
    die('error'.$conex->connect_error);
}

?>