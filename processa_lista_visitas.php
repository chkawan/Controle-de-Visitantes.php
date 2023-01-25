<?php

include_once "conn.php";


$query_qnt_usuarios = "SELECT COUNT(id_visitas) AS qnt_usuarios FROM tb_visitas";
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);
$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);
//var_dump($row_qnt_usuarios);

    // recebendo o total de registros sem que haja nenhuma pesquisa
$sql = "SELECT vis.visit_id AS id, vis.posto AS posto, vis.nome AS visitante, vis.cpf AS cpf, vis.telefone AS telefone,
ende.rua AS rua, ende.bairro AS bairro, ende.num_casa AS num_casa, ende.cidade AS cidade, ende.uf AS uf, ende.cep AS cep,
car.marca AS marca, car.modelo AS modelo, car.ano_car AS ano_car, car.cor_car AS cor_car, car.placa AS placa,
vit.destino AS destino, vit.id_visitante AS id_visita, vit.cracha AS cracha, vit.id_visitas AS id_visitas, DATE_FORMAT(vit.entrada,'%d/%m/%Y') AS entrada, vit.entradaHr AS entradaHr, vit.saida AS saida, vit.saidaHr AS saidaHr 
FROM  tb_visitas vit
LEFT JOIN tb_visitantes vis ON vis.visit_id=vit.id_visitante
LEFT JOIN tb_veiculo car ON car.id_carro=vit.id_visitas
LEFT JOIN tb_endereco ende ON ende.id_end=vit.id_visitas";

$consulta = $conn->query($sql);
$totalData = $consulta->rowCount();

// preparando o array
$data = array();
while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {

    extract($row);
    $registro = array();
$registro[] = $id_visitas; //0

$registro[] = $entrada; //1
$registro[] = $entradaHr; //2

$registro[] = $posto; //3
$registro[] = $visitante; //4
$registro[] = $cpf; //5
$registro[] = $telefone; //6

$registro[] = $marca; //7
$registro[] = $modelo; //8
$registro[] = $ano_car; //9
$registro[] = $cor_car; //10
$registro[] = $placa; //11

$registro[] = $cep; //12
$registro[] = $rua; //13
$registro[] = $bairro; //14
$registro[] = $num_casa; //15
$registro[] = $cidade; //16
$registro[] = $uf; //17

$registro[] = $destino; //18
$registro[] = $cracha; //19
//$registro[] = $saida;
$registro[] = $saidaHr; //20

$disabled = $saidaHr == '00:00:00' ? "" : " disabled='disabled'";

$registro[] = "<button type='button' id='$id_visitas' name='saida($id_visitas)' class='btn btn-outline-primary btn-sm' onclick=\"window.location.href='processa_cad_saida.php?id=".$id_visitas."'\"$disabled>Saida</button>";

    $data[] = $registro;
};

$json_data = array(
    // "recordsTotal" => intval($totalData), // total detotalData resultados
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']), // Quantidade de registros que há no banco de dados
    "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']), // Total de registros quando houver pesquisa
    "data" => $data   // conjunto total de dados
);

echo json_encode($json_data);  // send data as json format
?>