<?php
session_start();
include_once 'conn.php';

$SendEditCont = filter_input(INPUT_POST, "SendEditCont", FILTER_SANITIZE_STRING);


if($SendEditCont){//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
    
    //Receber os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $posto = $_POST['posto'];

    $cep = $_POST['cep'];    
    $rua = $_POST['rua'];
    $num_casa = $_POST['num_casa'];   
    $bairro = $_POST['bairro'];    
    $cidade = $_POST['cidade'];    
    $uf = $_POST['uf'];    
    $ibge = $_POST['ibge'];

    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $cor_car = $_POST['cor_car'];
    $ano_car = $_POST['ano_car'];
    

    $dados = "SELECT visit_id FROM tb_visitantes WHERE cpf='$cpf'";
    $dados2 = $conn->prepare($dados);
    $dados2->execute();
    $dados3 = $dados2->fetch(PDO::FETCH_ASSOC);
    $id = $dados3['visit_id'];

    //UPDATE no BD - DADOS USUARIOS
    $result_msg_cont = "UPDATE tb_visitantes SET nome=:nome, posto=:posto, telefone=:telefone WHERE visit_id='$id'";

    $update_msg_cont = $conn->prepare($result_msg_cont);
    $update_msg_cont->bindParam(':posto', $posto);
    $update_msg_cont->bindParam(':nome', $nome);
    // $update_msg_cont->bindParam(':cpf', $cpf);
    $update_msg_cont->bindParam(':telefone', $telefone);

    //UPDATE no BD - DADOS ENDEREÇO
    if($update_msg_cont->execute()){
       
        $result_msg_cont1 = "UPDATE tb_endereco_visitante SET cep=:cep, rua=:rua, num_casa=:num_casa, bairro=:bairro, cidade=:cidade, uf=:uf, ibge=:ibge WHERE dono_resid='$id'";

        $update_msg_cont1 = $conn->prepare($result_msg_cont1);
        $update_msg_cont1->bindParam(':cep', $cep);
        $update_msg_cont1->bindParam(':rua', $rua);
        $update_msg_cont1->bindParam(':num_casa', $num_casa);
        $update_msg_cont1->bindParam(':bairro', $bairro);
        $update_msg_cont1->bindParam(':cidade', $cidade);
        $update_msg_cont1->bindParam(':uf', $uf);
        $update_msg_cont1->bindParam(':ibge', $ibge);
        
            }if($update_msg_cont1->execute()){
                
                $result_msg_cont2 = "UPDATE tb_veiculo_visitante SET placa=:placa, ano_car=:ano_car, cor_car=:cor_car, modelo=:modelo, marca=:marca WHERE id_dono='$id'";

                $update_msg_cont2 = $conn->prepare($result_msg_cont2);
                $update_msg_cont2->bindParam(':placa', $placa);
                $update_msg_cont2->bindParam(':ano_car', $ano_car);
                $update_msg_cont2->bindParam(':cor_car', $cor_car);
                $update_msg_cont2->bindParam(':modelo', $modelo);
                $update_msg_cont2->bindParam(':marca', $marca);
                $update_msg_cont2->execute();

                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cadastro do(a) <b>$nome</b> foi atualizado com Sucesso!</div>";
                header("Location: lista_visitante.php");
                
}else{
    //CRIAR A VARIAVEL GLOBAL
  $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Cadastro não foi editada com sucesso</div>";
  header("Location: lista_visitante.php");
}    
}