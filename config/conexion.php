<?php

$host = 'localhost';
$user = 'root';
$password = '';
$BD = 'registro';


$conex = new mysqli($host,$user,$password,$BD);
if($conex->connect_error){
    die('error'.$conex->connect_error);
}else{
    //echo "Conectado";
}

?>