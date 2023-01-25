<?php
session_start();

include_once "conn.php"?>
<!-- CONEXAO COM BD-->

<!doctype html>
<html lang="en">

<head>
    <!--- LINK DOS LINKS -->
    <?php include_once "link_head.php" ?>

    <title>Lista de Visitas</title>


</head>

<body>
    <?php
        $saida = "SELECT COUNT(saidaHr) AS saidaNao FROM tb_visitas WHERE saidaHr = '00:00:00'";
        $resut_saida = $conn->prepare($saida);
        $resut_saida->execute();
        $row_saida = $resut_saida->fetch(PDO::FETCH_ASSOC);

        $entradas = "SELECT COUNT(entradaHr) AS visitas FROM tb_visitas WHERE saidaHr != '00:00:00'";
        $resut_entradas = $conn->prepare($entradas);
        $resut_entradas->execute();
        $row_entradas = $resut_entradas->fetch(PDO::FETCH_ASSOC);

    ?>
    
    <?php include_once "link_menu.php" ?><!--- LINK DO MENU -->
    
    <div class="display form-sigin-heading text-center">Lista de Visitas</div> <!-- TEXTO DO TITTULO -->
    <div class='alert alert-info' role='alert'>Visitas Realizadas: <?php echo $row_entradas['visitas'] ?> | Saidas Pendentes: <?php echo $row_saida['saidaNao'] ?>
    </div>
        <span id="msgAlerta"></span>
        <?php include_once "erro.php" ?>
        
    </div>
    <hr>
    <div class="listaVis">

        <table id="listar-visitas" class="table hover " width="100%">
            <thead>
                <tr>
                    <th>Qnt</th>
                    <th>Data</th>
                    <th>Entrada</th>
                    <th>P/G</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Tel</th>

                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Cor</th>
                    <th>Placa</th>

                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Numero</th>
                    <th>Cidade</th>
                    <th>Estado</th>

                    <th>Destino</th>
                    <th>Crachá</th>
                    
                    <th>Saida</th>
                    <th>Ação</th>
                </tr>
            </thead>
        </table>

    </div>

    <!--- LINK DO RODAPÉ -->
    <?php include_once "link_footer.php" ?>

</body>

</html>