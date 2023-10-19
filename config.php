<?php

$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "portal_jogos";
$con   = mysqli_connect($host, $user, $pass, $base);
 

if($con === false){
    die("ERRO: A conexão falhou. " . mysqli_connect_error());
}

?>