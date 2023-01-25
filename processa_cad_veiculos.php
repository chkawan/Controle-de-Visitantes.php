<?php

session_start();

ob_start();
include "conn.php";

//RECBENDO DADOS DO FORMULARIO
$dados_veiculo = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//var_dump($dados);

$modelo = $_POST['modelo'];

$consulta = $conn->prepare("SELECT modelo FROM tb_ex_veiculo WHERE modelo = :modelo");

$consulta->bindParam(":modelo", $modelo);
$consulta->execute();

$total_linha = $consulta->rowCount();


if($total_linha == 1){
  //CRIAR A VARIAVEL GLOBAL
  $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Esse Modelo Já existe.</div>";

    //redirecionar
    header("Location: cad_veiculos.php");
}else{


//VERIFICAR SE O BOTAO FOI CLICADO
if(!empty($dados_veiculo['cadVeiculo'])){


//TABLE CARRO
    $query_veiculo  = "INSERT INTO tb_ex_veiculo (marca, modelo) VALUES (:marca, :modelo)";
    $cad_veiculo = $conn->prepare($query_veiculo);
    $cad_veiculo->bindParam(':marca', $dados_veiculo['marca'], PDO::PARAM_STR);
    $cad_veiculo->bindParam(':modelo', $dados_veiculo['modelo'], PDO::PARAM_STR);
    $cad_veiculo->execute();

   //CRIAR A VARIAVEL GLOBAL
   $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cadastro Feito!</div>";

   //redirecionar
  header("Location: cad_veiculos.php");

}else{
     //CRIAR A VARIAVEL GLOBAL
   $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'> NÃO FOI POSSIVEL CADASTRAR O VEÍCULO.</div>";

   //redirecionar
   header("Location: cad_veiculos.php");
}
}

?>