<?php

include_once "conn.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
//$id = "";

if(!empty($id)){
    $query_usuario = "DELETE FROM tb_visitantes WHERE visit_id=:visit_id";//id_dono e id_end
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(":visit_id", $id);

    if($result_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Usuário apagado com sucesso!</div>"];
      
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não apagado com sucesso!</div>"];
 
    }
}else{
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não apagado com sucesso!</div>"];
}

echo json_encode($retorna);