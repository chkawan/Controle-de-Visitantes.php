<?php
session_start();

include_once "conn.php"?>
<!-- CONEXAO COM BD-->
<!doctype html>
<html lang="en">

<head>
    <!--- LINK DOS LINKS -->
    <?php include_once "link_head.php" ?>
    <title>Registrar Visita</title>

</head>

<body>

    <?php include_once "link_menu.php" ?>
    <!--- LINK DO MENU -->


    <div class="regVis">
        <!--- INICIO DO CONTEUDO PRINCIPAL -->

        <div class="display form-sigin-heading text-center">Registrar Entrada</div> <!-- TEXTO DO TITTULO -->
        <hr>

        <?php include_once "erro.php" ?>
        <!-- MSG DE ERRO -->


        <form method="POST" action="processa_cad_entrada.php" class="container">
            <!-- INICIO DO FORMULARIO CADASTRO GERAL -->


            <div class="input-grup row">
                <!-- GRUP - CPF DESTINO-->

                <div class="input-box col col-sm-auto colPessoal">
                    <!-- CPF -->
                    <label for="nome">CPF:*
                        <input type="text" id="cpf" name="cpf" class="form-control cpf" placeholder="000.000.000-00"
                            minlength="14" maxlength="14" size="15%" required="required"></label>
                </div>

                <div class="input-box col col-sm-auto colPessoal">
                    <label for="nome">Nome:*
                        <input type="name" name="nome" class="form-control" placeholder="Digite o Nome Completo"
                            size="70%" minlength="2" required="required" value=""></label>
                </div>

                <!-- <div class="input-grup"> -->
                <!-- PREENCHEMENTO DOS DADOS PESSOAIS -->

                <div class="input-box col col-sm-auto colPessoal">
                    <label for="posto">Posto:*
                        <select class="form-control" name="posto" required="required">

                            <!--VINDO DO VISITANTE --->
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM tb_posto ORDER BY cod_posto_grad ASC");
                                $stmt->execute();

                                if($stmt->rowCount() > 0){
                                        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                                            echo "<option value='{$dados['forca']} - {$dados['abrev']}'>{$dados['forca']} - {$dados['abrev']}</option>";
                                        }         
                                }
                        ?>
                        </select></label>
                </div>



                <div class="input-box col col-sm-auto colPessoal">
                    <label for="telefone">Telefone:*
                        <input id="telefone" type="text" name="telefone" class="form-control"
                            placeholder="(99) 99999-9999" maxlength="11" minlength="10" size="15%" required="required"
                            value=""></label>
                </div>

            </div><!-- FIM DO PREENCHEMENTO DOS DADOS PESSOAIS -->
            <HR>
            <div class="input-grup row">
                <!-- PREENCHEMENTO DOS DADOS DA RESIDENCIA -->

                <div class="input-box col col-sm-auto colEnd">
                    <!-- CEP -->
                    <label for="cep">Cep:*
                        <input class="form-control" required="required" placeholder="99999-999" id="cep" name="cep"
                            type="text" id="cep" value="" size="7%" minlength="8" maxlength="9"
                            onblur="pesquisacep(this.value);" /></label>
                </div>

                <div class="input-box col col-sm-auto colEnd">
                    <!-- RUA -->
                    <label for="rua">Rua:*
                        <input class="form-control" name="rua" type="text" id="rua" size="29%" minlength="3"
                            placeholder="Digite o Rua" required="required" /></label>
                </div>

                <div class="input-box col col-sm-auto colEnd">
                    <!-- NUMERO -->
                    <label for="num_casa">Nº:*
                        <input class="form-control number" value="" name="num_casa" type="text" id="num_casa" size="5%"
                            minlength="1" placeholder="Ex:01" required="required" /></label>
                </div>

                <div class="input-box col col-sm-auto colEnd">
                    <!-- BAIRRO -->
                    <label for="bairro">Bairro:*
                        <input class="form-control" value="" name="bairro" type="text" id="bairro" size="22"
                            minlength="3" placeholder="Digite o Bairro" required="required" /></label>
                </div>

                <div class="input-box col col-sm-auto colEnd">
                    <!-- CIDADE -->
                    <label for="cidade">Cidade:*
                        <input class="form-control" name="cidade" type="text" id="cidade" size="8" minlength="3"
                            placeholder="Ex:Resende" required="required" /></label>
                </div>

                <div class="input-box col col-sm-auto colEnd">
                    <!-- ESTADO -->
                    <label for="uf">Estado:*
                        <input class="form-control" class="form-control" name="uf" type="text" id="uf" size="14%"
                            minlength="2" maxlength="30"  placeholder="Ex:Rio de Janeiro" required="required" /></label>
                </div>

                <div class="input-box col col-sm-auto colEnd">
                    <!-- IBGE -->
                    <label for="ibge">IBGE:
                        <input class="form-control" name="ibge" type="text" id="ibge" size="8%" placeholder="Ex:0000000"
                            maxlength="8" minlength="8" /></label>
                </div>

            </div><!-- FIM DO PREENCHEMENTO DOS DADOS DA RESIDENCIA -->

            <hr>

            <div class="input-grup row">
                <!-- INICIO PREENCHEMENTO DOS DADOS DO CARRO -->

                <div class="input-box col col-sm-auto colCar">
                    <!-- MARCA -->
                    <label for="marca">Marca:*
                        <select class="form-control selectDiv" name="marca" id="marca" required="required">

                            <?php //BUSCANDO NO BANCO AS INFORMAÇÕES PARA O SELECT - tb_ex_veiculos - marca 
                                        $stmt = $conn->prepare("SELECT DISTINCT marca FROM tb_ex_veiculo");
                                        $stmt->execute();

                                        if($stmt->rowCount() > 0){
                                                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                        echo "<option value='{$dados['marca']}'>{$dados['marca']}</option>";
                                                }
                                        }
                                ?>

                        </select>
                    </label>
                </div>

                <div class="input-box col col-sm-auto colCar">
                    <!-- MODELO -->
                    <label for="modelo">Modelo:*
                        <select class="form-control selectDiv2" name="modelo" id="modelo" required="required">

                            <?php //BUSCANDO NO BANCO AS INFORMAÇÕES PARA O SELECT - tb_ex_veiculos - modelo 
                                        $stmt2 = $conn->prepare("SELECT modelo FROM tb_ex_veiculo");
                                        $stmt2->execute();

                                        if($stmt2->rowCount() > 0){
                                                while($dados = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                                        echo "<option value='{$dados['modelo']}'>{$dados['modelo']}</option>";
                                                }
                                        }
                        
                                ?>

                        </select>
                    </label>
                </div>

                <!-- </div> FIM GRUP -->

                <!-- <div class="input-grup"> -->

                <div class="input-box col col-sm-auto colCar">
                    <!-- PALCA -->
                    <label for="placa">Placa:
                        <input class="form-control text-uppercase" id="placa" type="text" name="placa"
                        value="AAA-0000"   placeholder="AAA9A99" maxlength="8" minlength="7" size="10%"></label>
                </div>

                <div class="input-box col col-sm-auto colCar">
                    <!-- COR -->
                    <label for="car_cor">Cor:
                        <input class="form-control" id="cor_car" type="text" name="cor_car" placeholder="Azul"
                        value="Nenhuma"   minlength="2" maxlength="30" size="10%"></label>
                </div>

                <div class="input-box col col-sm-auto colCar">
                    <!-- ANO -->
                    <label for="ano_car">Ano:
                        <input class="form-control" id="ano_car" type="text" name="ano_car" size="5%" min="0000" value="0000"
                           value="0000" ></label>
                           <!-- onKeyDown="if(this.value.length==4 && event.keyCode>47 && event.keyCode < 58)return false;" -->
                </div>

            </div><!-- FIM DO PREENCHEMENTO DOS DADOS DO CARRO -->
            <hr>


            <div class="input-grup row">
                <div class="input-box col col-sm-auto colDes">
                    <!-- DESTINO -->
                    <label for="destino">Destino:*
                        <input id="destino" type="text" name="destino" class="form-control"
                            placeholder="Destino do Visitante" minlength="2" maxlength="255" size="60%"
                            required="required"></label>
                </div>
                <!-- </div>FIM GRUP - CPF DESTINO -->


                <!-- GRUP CRACHÁ - DATA-HORA- ENTRADA-->

                <div class="input-box col col-sm-auto colDes">
                    <!-- CRACHÁ -->
                    <label for="cracha">Crachá:*
                        <input id="cracha" type="text" name="cracha" class="form-control" placeholder="Ex:01"
                            maxlength="255" minlength="2" size="10%" required="required"></label>
                </div>

                <div class="input-box col col-sm-auto colDes">
                    <!-- DATA - ENTRADA -->
                    <label>Data:*
                        <input id="entrada" type="date" name="entrada" class="form-control" size="15%"
                            value="<?php echo date('Y-m-d');?>" required="required"></label>
                </div>

                <div class="input-box col col-sm-auto colDes">
                    <!-- HORA - ENTRADA -->
                    <label>Hora:*
                        <input id="entradaHr" type="time" name="entradaHr" class="form-control" placeholder="00:00"
                            maxlength="6" size="15%" value="<?php echo date('H:i:s');?>" required="required"></label>
                </div>

              
            <!-- </div> -->
            <!-- FIM GRUP  CRACHÁ - DATA-HORA- ENTRADA -->

            <!-- <div class="input-grup  justify-content-center"> -->
            <div class="input-box col col-sm-auto colBtn">
                <!--- BOTÃO SALVAR -->
                <input type="submit" value="Salvar" name="cadGeral" class="btn btn-success btn-sm  botao">
            </div>
            <!--- BOTÃO SALVAR -->

        </form><!-- FIM DO FORMULARIO CADASTRO GERAL -->

    </div>
    <!--- DIM DA DIV INICIO DO CONTEUDO PRINCIPAL -->
    <br>
    <!--------------------------------------------------- INICIO DO RODA PE ------------------------------------------>


    <?php include_once "link_footer.php" ?>

    <script type="text/javascript" src="js/custom.js"></script>
    <!--- LINK DO FOOTER -->

    </script>
</body>

</html>