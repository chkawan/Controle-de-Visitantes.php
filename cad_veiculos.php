<?php
session_start();

include_once "conn.php"?>
<!-- CONEXAO COM BD-->

<!doctype html>
<html lang="en">

<head>
    <!--- LINK DOS LINKS -->
    <?php include_once "link_head.php" ?>

    <title>Novo Veículo</title>



</head>

<body>
    <!--- LINK DO MENU -->
    <?php include_once "link_menu.php" ?>


    <div class="cadVeiculo">

        <div class="display form-sigin-heading text-center">Novo Veículo</div> <!-- TEXTO DO TITTULO -->
        <hr>

        <form method="POST" action="processa_cad_veiculos.php">
            <!-- INICIO PREENCHEMENTO DOS DADOS DO CARRO -->

            <?php include_once "erro.php" ?>
            <!-- MSG DE ERRO -->

            <div class="input-grup ">
                <!-- GRUP -->

                <div class="input-box col-md-16">
                    <label for="inputMarca">Marca:
                        <input id="marca" type="text" name="marca" class="form-control" placeholder="Marca do Veículo"
                            Required></label>
                </div>

                <div class="input-box col-md-16">
                    <label for="inputModelo">Modelo:
                        <input id="modelo" type="text" name="modelo" class="form-control"
                            placeholder="Modelo do Veículo" Required></label>
                </div>


                <div class="input-box">
                    <label for="cadastroGeral" class="invisible">Teste
                        <input type="submit" value="Salvar" name="cadVeiculo"
                            class="form-control btn btn-success btn-md botao  visible"></label>
                </div>
                <!--- BOTÃO EDITAR -->

        </form><!-- FIM DO PREENCHEMENTO DOS DADOS DO CARRO -->

    </div>

    </div>



    <!--------------------------------------------------- INICIO DO RODA PE ------------------------------------------>
    <!--- LINK DO FOOTER -->
    <?php include_once "link_footer.php" ?>


</body>

</html>