<?php

include_once 'conn.php';

$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_STRING);
if(!empty($cpf)){
    
    $limit = 1;
    $result_ = "SELECT * FROM tb_visitantes vis
        LEFT JOIN tb_veiculo_visitante AS car ON vis.visit_id=car.id_dono
        LEFT JOIN tb_endereco_visitante AS loc ON vis.visit_id=loc.dono_resid
        WHERE cpf=:cpf LIMIT :limit";
    
    $resultado_ = $conn->prepare($result_);
    $resultado_->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $resultado_->bindParam(':limit', $limit, PDO::PARAM_INT);
    $resultado_->execute();
    
    $array_valores = array();
    
    if($resultado_->rowCount() != 0){
        $row_ = $resultado_->fetch(PDO::FETCH_ASSOC);
        $array_valores['nome'] = $row_['nome']; 
        $array_valores['telefone'] = $row_['telefone']; 
        $array_valores['posto'] = $row_['posto']; 
        $array_valores['telefone'] = $row_['telefone']; 

        $array_valores['cep'] = $row_['cep']; 
        $array_valores['rua'] = $row_['rua']; 
        $array_valores['bairro'] = $row_['bairro']; 
        $array_valores['num_casa'] = $row_['num_casa']; 
        $array_valores['cidade'] = $row_['cidade']; 
        
        $array_valores['ibge'] = $row_['ibge']; 
        $array_valores['uf'] = $row_['uf']; 
        
        $array_valores['marca'] = $row_['marca']; 
        $array_valores['modelo'] = $row_['modelo']; 
        $array_valores['ano_car'] = $row_['ano_car']; 
        $array_valores['cor_car'] = $row_['cor_car']; 
        $array_valores['placa'] = $row_['placa']; 
    }
    echo json_encode($array_valores);
}
