<?php

session_start();

ob_start();
include "conn.php";
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
date_default_timezone_set('America/Sao_Paulo');
$hora = "0";
$saida = date('Y-m-d');
$saidaHr = date('H:i:s');

//validação se o ID existe na TB_VISITAS
// $id_visitas = $_POST['id_visitas']; //recuperando dado do input
// $saida = $_POST['saida'];//recuperando dado do input
// $saidaHr = $_POST['saidaHr'];//recuperando dado do input


//SELECIONANDO TABELA NO BD
$consulta2 = $conn->prepare("SELECT id_visitas, saidaHr FROM tb_visitas WHERE id_visitas=$id AND saidaHr=$hora");
//$consulta2->bindParam(":id_visitas", $dados['id_visitas']);
$consulta2->execute();

$total_linha = $consulta2->rowCount();
    
if($total_linha == 1){
var_dump($saida, $saidaHr);
      $query_visitante = ("UPDATE tb_visitas SET saidaHr='$saidaHr', saida='$saida' WHERE id_visitas=$id ");
      $cad_visitante = $conn->prepare($query_visitante);
     // $cad_visitante->bindParam(':saida', $saida);
     //$cad_visitante->bindParam(':saidaHr', $saidaHr);
      $cad_visitante->execute();


     //CRIAR A VARIAVEL GLOBAL
     $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Saida Realizada!</div>";

    // redirecionar
    header("Location:listar_visitas.php"); 

  }else{
    //CRIAR A VARIAVEL GLOBAL
   $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'> Essa saida ja foi realizada!</div>";

  //  //redirecionar
  header("Location: listar_visitas.php");
  }



?>