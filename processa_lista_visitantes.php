<?php

include_once "./conn.php";

$query_qnt_usuarios = "SELECT COUNT(nome) AS qnt_usuarios FROM tb_visitantes";
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);
$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);
//var_dump($row_qnt_usuarios);

// recebendo o total de registros sem que haja nenhuma pesquisa
$sql = "SELECT vis.visit_id AS id, vis.posto AS posto, vis.nome AS visitante, vis.cpf AS cpf, vis.telefone AS telefone,
            ende.rua AS rua, ende.bairro AS bairro, ende.num_casa AS num_casa, ende.cidade AS cidade, ende.uf AS uf, ende.cep AS cep,
            car.marca AS marca, car.modelo AS modelo, car.ano_car AS ano_car, car.cor_car AS cor_car, car.placa AS placa
            FROM tb_visitantes vis
            LEFT JOIN tb_endereco_visitante AS ende ON ende.id_end=vis.visit_id
            LEFT JOIN tb_veiculo_visitante AS car ON car.id_carro=vis.visit_id ORDER BY visit_id DESC";

$consulta = $conn->query($sql);
$totalData = $consulta->rowCount();

// preparando o array
$data = array();
while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {

    extract($row);
    $registro = array();
    
    $registro[] = $posto; //0
    $registro[] = $visitante; //1
    $registro[] = $cpf; //2
    $registro[] = $telefone; //3
    $registro[] = $cep; //4
    $registro[] = $rua; //5
    $registro[] = $bairro; //6
    $registro[] = $num_casa; //7
    $registro[] = $cidade; //8
    $registro[] = $uf; //9
    $registro[] = $marca; //10
    $registro[] = $modelo; //11
    $registro[] = $ano_car; //12
    $registro[] = $cor_car; //13
    $registro[] = $placa; //14

    $registro[] = "<a href='visualizar.php?id=". $id ."'><button type='button' id='$id' class='btn btn-outline-primary btn-sm' onclick='visVisitante($id)'>Visualizar</button></a>
    ";
    // <a href='editar.php?id=". $id ."'><button type='button' id='$id' class='btn btn-outline-warning btn-sm'>Editar</button></a>
    // <button type='button' id='$id' class='btn btn-outline-danger btn-sm' onclick='apagarUsuario($id)'>Apagar</button>

    $data[] = $registro;
}

$json_data = array(
   // "recordsTotal" => intval($totalData), // total detotalData resultados
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']), // Quantidade de registros que há no banco de dados
    "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']), // Total de registros quando houver pesquisa
    "data" => $data   // conjunto total de dados
);

echo json_encode($json_data);  // send data as json format
?>