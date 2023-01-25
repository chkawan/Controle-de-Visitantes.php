<?php

session_start();

ob_start();
include "conn.php";

//RECBENDO DADOS DO FORMULARIO
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$cpf = $_POST['cpf'];
$horaSaida = "00:00:00";

//ID PARA COLUNA DE LIGAÇÃO - BASEADO NO ID DO CPF INSERIDO 
$id = $conn->query("SELECT visit_id FROM tb_visitantes WHERE cpf = '$cpf'");
$id->execute();
$id_vis = $id->fetch(PDO::FETCH_ASSOC);
$id_visit = $id_vis['visit_id'];

$consulta = $conn->prepare("SELECT visit_id, cpf FROM tb_visitantes WHERE cpf = :cpf");
$consulta->bindParam(":cpf", $cpf);
$consulta->execute();
$total_linha = $consulta->rowCount();

if($total_linha == 1){
 

    // if(!empty($dados['cadGeral'])){//-------------------------- //VERIFICAR SE O BOTAO FOI CLICADO -------------------------------

      
      //-------------------------- ////INSERT NA TB_VISITAS --- ---------------------
      $result_msg_cont3 = "UPDATE tb_visitantes SET nome=:nome, posto=:posto, telefone=:telefone WHERE cpf='$cpf'";;

      $update_msg_cont3 = $conn->prepare($result_msg_cont3);
      $update_msg_cont3->bindParam(':posto', $dados['posto'], PDO::PARAM_STR);
      $update_msg_cont3->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
      // $update_msg_cont3->bindParam(':visit_id', $dados['visit_id'], PDO::PARAM_STR);
      $update_msg_cont3->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
      $update_msg_cont3->execute();
      


      $query_visitante = "INSERT INTO tb_visitas 
                        (id_visitante, destino, cracha, entrada, entradaHr, saidaHr) VALUES
                        (:id_visitante, :destino, :cracha, :entrada, :entradaHr, :saidaHr)";
        $cad_visitante = $conn->prepare($query_visitante);
      // $cad_visitante->bindParam(':id_visitas', $dados['id_visitas'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':id_visitante', $id_visit, PDO::PARAM_STR);
        $cad_visitante->bindParam(':destino', $dados['destino'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':cracha', $dados['cracha'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':entrada', $dados['entrada'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':entradaHr', $dados['entradaHr'], PDO::PARAM_STR);
        // $cad_visitante->bindParam(':saida', $dados['saida'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':saidaHr', $horaSaida , PDO::PARAM_STR);
        $cad_visitante->execute();

          //INSET TABLE ENDERECO
          $query_enderco = "INSERT INTO tb_endereco
                          (rua, bairro, num_casa, cidade, uf, cep, ibge, dono_resid) VALUES
                          (:rua, :bairro, :num_casa, :cidade, :uf, :cep, :ibge, :dono_resid)";
          $cad_endereco = $conn->prepare($query_enderco);
          $cad_endereco->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
          $cad_endereco->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
          $cad_endereco->bindParam(':num_casa', $dados['num_casa'], PDO::PARAM_STR);
          $cad_endereco->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
          $cad_endereco->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
          $cad_endereco->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
          $cad_endereco->bindParam(':ibge', $dados['ibge'], PDO::PARAM_INT);
          $cad_endereco->bindParam(':dono_resid', $id_visit, PDO::PARAM_STR);
          

            if($cad_endereco->execute()){//SE HOUVER ALGUM DONO_RESID COMO O MSM CPF - PARA SABER SE E update OU insert
              $consulta_loca = $conn->prepare("SELECT dono_resid FROM tb_endereco_visitante WHERE dono_resid=$id_visit");
              // $consulta_loca->bindParam(":dono_resid", $id_vis, PDO::PARAM_STR );
              $consulta_loca->execute();
              
              $total_linha_loca = $consulta_loca->rowCount();
              
              if($total_linha_loca == 1){// SE JA HOVER REGISTRO E UPDATE
              
                $result_msg_cont1 = "UPDATE tb_endereco_visitante SET cep=:cep, rua=:rua, num_casa=:num_casa, bairro=:bairro, cidade=:cidade, uf=:uf, ibge=:ibge WHERE dono_resid='$id_visit'";

                $update_msg_cont1 = $conn->prepare($result_msg_cont1);
                $update_msg_cont1->bindParam(':cep', $cep);
                $update_msg_cont1->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
                $update_msg_cont1->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
                $update_msg_cont1->bindParam(':num_casa', $dados['num_casa'], PDO::PARAM_STR);
                $update_msg_cont1->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
                $update_msg_cont1->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
                $update_msg_cont1->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
                $update_msg_cont1->bindParam(':ibge', $dados['ibge'], PDO::PARAM_INT);
                //$update_msg_cont1->bindParam(':dono_resid', $dados['cpf'], PDO::PARAM_STR);
                $update_msg_cont1->execute();
                
                    }else{ // SE NAO HOUVER REGISTRO E INSERT
                      $query_enderco2 = "INSERT INTO tb_endereco_visitante
                      (rua, bairro, num_casa, cidade, uf, cep, ibge, dono_resid) VALUES
                      (:rua, :bairro, :num_casa, :cidade, :uf, :cep, :ibge, :dono_resid)";

                      $cad_endereco2 = $conn->prepare($query_enderco2);
                      $cad_endereco2->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
                      $cad_endereco2->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
                      $cad_endereco2->bindParam(':num_casa', $dados['num_casa'], PDO::PARAM_STR);
                      $cad_endereco2->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
                      $cad_endereco2->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
                      $cad_endereco2->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
                      $cad_endereco2->bindParam(':ibge', $dados['ibge'], PDO::PARAM_INT);
                      $cad_endereco2->bindParam(':dono_resid',  $id_visit, PDO::PARAM_STR);
                      $cad_endereco2->execute();

                    };
            };

            //TABLE CARRO
            $query_carro  = "INSERT INTO tb_veiculo
                            (id_dono, marca, modelo, ano_car, cor_car, placa) VALUES
                            (:id_dono, :marca, :modelo, :ano_car, :cor_car, :placa)";
            $cad_carro = $conn->prepare($query_carro);
            $cad_carro->bindParam(':id_dono',  $id_visit, PDO::PARAM_STR);
            $cad_carro->bindParam(':marca', $dados['marca'], PDO::PARAM_STR);
            $cad_carro->bindParam(':modelo', $dados['modelo'], PDO::PARAM_STR);
            $cad_carro->bindParam(':ano_car', $dados['ano_car'], PDO::PARAM_INT);
            $cad_carro->bindParam(':cor_car', $dados['cor_car'], PDO::PARAM_STR);
            $cad_carro->bindParam(':placa', $dados['placa'], PDO::PARAM_STR);
            

            if($cad_carro->execute()){
              $consulta_carro = $conn->prepare("SELECT id_dono FROM tb_veiculo_visitante WHERE id_dono = $id_visit");
              // $consulta_carro->bindParam(":id_dono", $id_vis['visit_id'], PDO::PARAM_STR );
              $consulta_carro->execute();
              
              $total_linha_carro = $consulta_carro->rowCount();
              
              if($total_linha_carro == 1){
                
                  $result_msg_cont2 = "UPDATE tb_veiculo_visitante SET placa=:placa, ano_car=:ano_car, cor_car=:cor_car, modelo=:modelo, marca=:marca WHERE id_dono=$id_visit";

                  $update_msg_cont2 = $conn->prepare($result_msg_cont2);
                  $update_msg_cont2->bindParam(':marca', $dados['marca'], PDO::PARAM_STR);
                  $update_msg_cont2->bindParam(':modelo', $dados['modelo'], PDO::PARAM_STR);
                  $update_msg_cont2->bindParam(':ano_car', $dados['ano_car'], PDO::PARAM_INT);
                  $update_msg_cont2->bindParam(':cor_car', $dados['cor_car'], PDO::PARAM_STR);
                  $update_msg_cont2->bindParam(':placa', $dados['placa'], PDO::PARAM_STR);
                  $update_msg_cont2->execute();

              }else{
                $query_carro2  = "INSERT INTO tb_veiculo_visitante
                            (id_dono, marca, modelo, ano_car, cor_car, placa) VALUES
                            (:id_dono, :marca, :modelo, :ano_car, :cor_car, :placa)";
                $cad_carro2 = $conn->prepare($query_carro2);
                $cad_carro2->bindParam(':id_dono',  $id_vis['visit_id'], PDO::PARAM_STR);
                $cad_carro2->bindParam(':marca', $dados['marca'], PDO::PARAM_STR);
                $cad_carro2->bindParam(':modelo', $dados['modelo'], PDO::PARAM_STR);
                $cad_carro2->bindParam(':ano_car', $dados['ano_car'], PDO::PARAM_INT);
                $cad_carro2->bindParam(':cor_car', $dados['cor_car'], PDO::PARAM_STR);
                $cad_carro2->bindParam(':placa', $dados['placa'], PDO::PARAM_STR);
                $cad_carro2->execute();
              };

          };



      //CRIAR A VARIAVEL GLOBAL
      $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Visita Registrada com Sucesso!</div>";

      //redirecionar
      header("Location: cad_entrada.php");

    }else{
//         //CRIAR A VARIAVEL GLOBAL
//         $_SESSION['msg'] = "<p style='color: #f00;'> NÃO FOI POSSIVEL REGISTRAR A VISITA!</p>";

//       //redirecionar
//       header("Location: cad_entrada.php");
//     }


// }else{

  // if(!empty($dados['cadGeral'])){
    $query_visitante = "INSERT INTO tb_visitantes
    (nome, posto, cpf, telefone) VALUES
    (:nome, :posto, :cpf, :telefone)";
    $cad_visitante = $conn->prepare($query_visitante);
    $cad_visitante->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $cad_visitante->bindParam(':posto', $dados['posto'], PDO::PARAM_STR);
    $cad_visitante->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
    $cad_visitante->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
    
    
      if($cad_visitante->execute()){
        $lastId = $conn->lastInsertId();
        $query_visitante = "INSERT INTO tb_visitas 
                        (id_visitante, destino, cracha, entrada, entradaHr, saidaHr) VALUES
                        (:id_visitante, :destino, :cracha, :entrada, :entradaHr, :saidaHr)";
        $cad_visitante = $conn->prepare($query_visitante);
      // $cad_visitante->bindParam(':id_visitas', $dados['id_visitas'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':id_visitante', $lastId, PDO::PARAM_STR);
        $cad_visitante->bindParam(':destino', $dados['destino'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':cracha', $dados['cracha'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':entrada', $dados['entrada'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':entradaHr', $dados['entradaHr'], PDO::PARAM_STR);
        // $cad_visitante->bindParam(':saida', $dados['saida'], PDO::PARAM_STR);
        $cad_visitante->bindParam(':saidaHr', $horaSaida , PDO::PARAM_STR);
        
          if($cad_visitante->execute()){
            $query_enderco = "INSERT INTO tb_endereco_visitante
                          (rua, bairro, num_casa, cidade, uf, cep, ibge, dono_resid) VALUES
                          (:rua, :bairro, :num_casa, :cidade, :uf, :cep, :ibge, :dono_resid)";
            $cad_endereco = $conn->prepare($query_enderco);
            $cad_endereco->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
            $cad_endereco->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
            $cad_endereco->bindParam(':num_casa', $dados['num_casa'], PDO::PARAM_STR);
            $cad_endereco->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
            $cad_endereco->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
            $cad_endereco->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
            $cad_endereco->bindParam(':ibge', $dados['ibge'], PDO::PARAM_INT);
            $cad_endereco->bindParam(':dono_resid', $lastId, PDO::PARAM_STR);
            
            if($cad_endereco->execute()){

            $query_enderco2 = "INSERT INTO tb_endereco
                          (rua, bairro, num_casa, cidade, uf, cep, ibge, dono_resid) VALUES
                          (:rua, :bairro, :num_casa, :cidade, :uf, :cep, :ibge, :dono_resid)";
            $cad_endereco2 = $conn->prepare($query_enderco2);
            $cad_endereco2->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
            $cad_endereco2->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
            $cad_endereco2->bindParam(':num_casa', $dados['num_casa'], PDO::PARAM_STR);
            $cad_endereco2->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
            $cad_endereco2->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
            $cad_endereco2->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
            $cad_endereco2->bindParam(':ibge', $dados['ibge'], PDO::PARAM_INT);
            $cad_endereco2->bindParam(':dono_resid', $lastId, PDO::PARAM_STR);
          
             }if($cad_endereco2->execute()){

              $query_carro2  = "INSERT INTO tb_veiculo_visitante
                            (id_dono, marca, modelo, ano_car, cor_car, placa) VALUES
                            (:id_dono, :marca, :modelo, :ano_car, :cor_car, :placa)";
                $cad_carro2 = $conn->prepare($query_carro2);
                $cad_carro2->bindParam(':id_dono', $lastId, PDO::PARAM_STR);
                $cad_carro2->bindParam(':marca', $dados['marca'], PDO::PARAM_STR);
                $cad_carro2->bindParam(':modelo', $dados['modelo'], PDO::PARAM_STR);
                $cad_carro2->bindParam(':ano_car', $dados['ano_car'], PDO::PARAM_INT);
                $cad_carro2->bindParam(':cor_car', $dados['cor_car'], PDO::PARAM_STR);
                $cad_carro2->bindParam(':placa', $dados['placa'], PDO::PARAM_STR);
                
                if($cad_carro2->execute()){

                $query_carro1  = "INSERT INTO tb_veiculo
                            (id_dono, marca, modelo, ano_car, cor_car, placa) VALUES
                            (:id_dono, :marca, :modelo, :ano_car, :cor_car, :placa)";
                $cad_carro1 = $conn->prepare($query_carro1);
                $cad_carro1->bindParam(':id_dono', $lastId, PDO::PARAM_STR);
                $cad_carro1->bindParam(':marca', $dados['marca'], PDO::PARAM_STR);
                $cad_carro1->bindParam(':modelo', $dados['modelo'], PDO::PARAM_STR);
                $cad_carro1->bindParam(':ano_car', $dados['ano_car'], PDO::PARAM_INT);
                $cad_carro1->bindParam(':cor_car', $dados['cor_car'], PDO::PARAM_STR);
                $cad_carro1->bindParam(':placa', $dados['placa'], PDO::PARAM_STR);
                $cad_carro1->execute();
                }

          };

      };

  };
     //CRIAR A VARIAVEL GLOBAL
    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Novo Cadastro Realizado e Nova Visita Registrada com Sucesso!</div>";

    //redirecionar
    header("Location: cad_entrada.php");
    }
  //   }else{
  //      //CRIAR A VARIAVEL GLOBAL
  //   $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'> NÃO FOI POSSIVEL REALIZAR O REGISTRO DA VISITA.</div>";

  //   //redirecionar
  //   header("Location: cad_entrada.php");
  //   } 
  // // }