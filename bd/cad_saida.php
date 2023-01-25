<?php
session_start();

include_once "conn.php"?> <!-- CONEXAO COM BD-->

<!doctype html>
<html lang="en">

<head>
    <!--- LINK DOS LINKS -->
    <?php include_once "link_head.php" ?>

    <title>Saida Visitante</title>


</head>

<body>

    <?php include_once "link_menu.php" ?>
    <!--- LINK DO MENU -->


    <div class="regSai">
        <!--- INICIO DO CONTEUDO PRINCIPAL -->

        <div class="form-sigin">
            <!-- INICIO DA DIV FORMULARIO CADASTRO GERAL -->

            <div class="display form-sigin-heading text-center">Registrar Saida</div> <!-- TEXTO DO TITTULO -->
            <hr>

            <?php include_once "erro.php" ?><!-- MSG DE ERRO -->
            
            <form method="POST" action="processa_cad_saida.php" class="container ">
                <!-- INICIO DO FORMULARIO CADASTRO GERAL -->

                <div class="input-grup ">
                    <!-- GRUP -->

                    <div class="input-box col-md-3">
                        <label for="id_visitas">Codigo da Visita:
                            <input type="number" id="id_visitas" name="id_visitas" class="form-control"
                                placeholder="000" minlength="1" size="10%" required="required"></label>
                    </div>

                    <div class="input-box col-md-3">
                        <label>Data:
                            <input id="saida" type="date" name="saida" class="form-control" size="10%"
                                value="<?php echo date('Y-m-d');?>"></label>
                    </div>

                    <div class="input-box col-md-3">
                        <label>Hora:
                            <input id="saidaHr" type="time" name="saidaHr" class="form-control"
                                size="10%" value="<?php echo date('H:i:s');?>"></label>
                    </div>

                </div> <!-- FIM DO GRUP -->

                <div class="botao"><!--- BOTÃO EDITAR -->
                    <input type="submit" value="Salvar" name="saida(<?php echo $id_visitas ?>)" class="btn btn-secondary btn-block ">
                </div><!--- BOTÃO EDITAR -->



            </form><!-- FIM DO FORMULARIO CADASTRO GERAL -->

        </div><!-- FIM DA DIV FORMULARIO CADASTRO GERAL -->

    </div><!--- DIM DA DIV INICIO DO CONTEUDO PRINCIPAL -->

    <!--------------------------------------------------- INICIO DO RODA PE ------------------------------------------>

    <?php include_once "link_footer.php" ?>
    <!--- LINK DO FOOTER -->

</body>

</html>