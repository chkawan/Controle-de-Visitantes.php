<?php
session_start();
ob_start();
include_once "conn.php" ?>

<!doctype html>
<html lang="en">

<head>
    <!--- LINK DOS LINKS -->
    <?php include_once "link_head.php" ?>

    <title>Lista de Visitantes</title>


</head>

<body>
    
    <?php include_once "link_menu.php" ?><!--- LINK DO MENU -->

    <div class="display form-sigin-heading text-center">Lista de Visitantes</div> <!-- TEXTO DO TITTULO -->
        <span id="msgAlerta"></span>
        <?php include_once "erro.php" ?>
        <hr>
    </div>
    
    <div class="listaVis">

        <table id="listar-visitantes" class="table hover row-border order-column " width="100%">
            <thead>
                <tr>
                    <th>P/G</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Tel</th>
                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Numero</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano do Carro</th>
                    <th>Cor do Carro</th>
                    <th>Placa</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>

        <!--- LINK DO RODAPÉ -->
        <?php include_once "link_footer.php" ?>
</body>

</html>