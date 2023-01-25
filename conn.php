<?php

$localhost = "localhost";
$user = "root";
$pass = "";
//$port = "3306";
$dbname = "db_visitante";

try{
    //CONNECTION WITHOUT THE PORT 
    $conn = new PDO("mysql:host=$localhost;dbname=". $dbname, $user, $pass);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $err){
    echo "Erro: Conexão com banco de dados não foi realizada co sucesso. Erro gerado " . $err->getMenssage();
}


?>