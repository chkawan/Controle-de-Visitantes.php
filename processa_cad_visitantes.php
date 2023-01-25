<?php

session_start();

ob_start();
include "conn.php";

//RECBENDO DADOS DO FORMULARIO
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//var_dump($dados);

//DANDO VALOR DO SELECT PARA "NENHUM"
$marca1 = $conn->query("SELECT marca FROM tb_ex_veiculo WHERE id_carro = '0'");
$marca1->execute();
$resultMarca = $marca1->fetch(PDO::FETCH_ASSOC); 
$resultMarca1 = $resultMarca['marca'];

$modelo1 = $conn->query("SELECT modelo FROM tb_ex_veiculo WHERE id_carro = '0'");
$modelo1->execute();
$resultModelo = $modelo1->fetch(PDO::FETCH_ASSOC); 
$resultModelo1 = $resultModelo;


// VALIDAÇÃO DE CPF - PLACA
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];

$cep = '000000000';    
$rua = 'Rua ainda não Informada';
$num_casa = '00';   
$bairro = 'Bairro ainda não Informada';   
$cidade = 'Não Consta';    
$uf = 'Não Consta';    
$ibge = '0000000';

$marca = $resultMarca['marca'];
$modelo = $resultModelo['modelo'];
$placa = 'AAA-0000';
$cor_car = 'Não Consta';
$ano_car = '0000';

$consulta = $conn->prepare("SELECT nome, cpf FROM tb_visitantes WHERE cpf = :cpf");
$consulta->bindParam(":cpf", $cpf);
$consulta->execute();

$total_linha = $consulta->rowCount();

if($total_linha == 1){
   //CRIAR A VARIAVEL GLOBAL
   $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'> NÃO FOI POSSIVEL REALIZAR O CADASTRO! CPF já cadastrado.</div>";

   //redirecionar
   header("Location: cad_visitantes.php");
}else{
   
//VERIFICAR SE O BOTAO FOI CLICADO
if(!empty($dados['cadastroGeral'])){
   $query_visitante = "INSERT INTO tb_visitantes
                    (nome, posto, cpf, telefone) VALUES
                    (:nome, :posto, :cpf, :telefone)";
    $cad_visitante = $conn->prepare($query_visitante);
    $cad_visitante->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $cad_visitante->bindParam(':posto', $dados['posto'], PDO::PARAM_STR);
    $cad_visitante->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
    $cad_visitante->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
    $cad_visitante->execute();
    $lastId = $conn->lastInsertId();

// //TABLE ENDERECO
    $query_enderco = "INSERT INTO tb_endereco_visitante
                    (rua, bairro, num_casa, cidade, uf, cep, ibge, dono_resid) VALUES
                    (:rua, :bairro, :num_casa, :cidade, :uf, :cep, :ibge, :dono_resid)";
    $cad_endereco = $conn->prepare($query_enderco);
    $cad_endereco->bindParam(':rua', $rua, PDO::PARAM_STR);
    $cad_endereco->bindParam(':bairro', $bairro, PDO::PARAM_STR);
    $cad_endereco->bindParam(':num_casa', $num_casa, PDO::PARAM_STR);
    $cad_endereco->bindParam(':cidade', $cidade, PDO::PARAM_STR);
    $cad_endereco->bindParam(':uf', $uf, PDO::PARAM_STR);
    $cad_endereco->bindParam(':cep', $cep, PDO::PARAM_STR);
    $cad_endereco->bindParam(':ibge', $ibge, PDO::PARAM_INT);
    $cad_endereco->bindParam(':dono_resid', $lastId, PDO::PARAM_STR);
    $cad_endereco->execute();

// //TABLE CARRO
    $query_carro  = "INSERT INTO tb_veiculo_visitante
                    (id_dono, marca, modelo, ano_car, cor_car, placa) VALUES
                    (:id_dono, :marca, :modelo, :ano_car, :cor_car, :placa)";
    $cad_carro = $conn->prepare($query_carro);
    $cad_carro->bindParam(':id_dono', $lastId, PDO::PARAM_STR);
    $cad_carro->bindParam(':marca', $marca, PDO::PARAM_STR);
    $cad_carro->bindParam(':modelo', $modelo, PDO::PARAM_STR);
    $cad_carro->bindParam(':ano_car', $ano_car, PDO::PARAM_INT);
    $cad_carro->bindParam(':cor_car', $cor_car, PDO::PARAM_STR);
    $cad_carro->bindParam(':placa', $placa, PDO::PARAM_STR);
    $cad_carro->execute();

   //CRIAR A VARIAVEL GLOBAL
   $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cadastro Feito!</div>";

 
   //redirecionar
   header("Location: cad_visitantes.php");

}else{
     //CRIAR A VARIAVEL GLOBAL
   $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'> NÃO FOI POSSIVEL REALIZAR O CADASTRO! CPF já cadastrado.</div>";

   //redirecionar
   header("Location: cad_visitantes.php");
}

}

?>