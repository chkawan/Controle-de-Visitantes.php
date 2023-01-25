<?php
include_once "conn.php";

$marca = $_GET['marca'];

$stmt2 = $conn->prepare("SELECT modelo 
    FROM tb_ex_veiculo 
    WHERE marca = :marca");
$data = ['marca' => $marca];
$stmt2->execute($data);


if($stmt2->rowCount() > 0){
        while($dados = $stmt2->fetch(PDO::FETCH_ASSOC)){
                echo "<option value='{$dados['modelo']}'>{$dados['modelo']}</option>";
        }
}else{
    echo 'Nenhum modelo encontrado';
}

?>