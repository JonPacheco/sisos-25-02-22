<?php

$servidor = "localhost";
$username = "root";
$password = "";
$db       = "bdsisos";

try {
$con = new PDO("mysql:host=$servidor;dbname=$db",$username,$password);

}catch(PDOException $e){
    echo "Conexão falhou: <br>".$e->getMessage();

}