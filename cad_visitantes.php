<?php
session_start();

include_once "conn.php"?>
<!-- CONEXAO COM BD-->

<!doctype html>
<html lang="en">

<head>
    <!--- LINK DOS LINKS -->
    <?php include_once "link_head.php" ?>

    <title>Cadastro de Visitante</title>

</head>

<body>

    <?php include_once "link_menu.php" ?>
    <!--- LINK DO MENU -->


    <div class="form-sigin cadVisitante">
        <!-- INICIO DA DIV FORMULARIO CADASTRO GERAL -->

        <div class="display form-sigin-heading text-center">Cadastro de Visitante</div> <!-- TEXTO DO TITTULO -->
        <hr>
        <div>
            <?php include_once "erro.php" ?>
            <!-- MSG DE ERRO -->
        </div>
        <form method="POST" action="processa_cad_visitantes.php" class="container">
            <!-- INICIO DO FORMULARIO CADASTRO GERAL -->

            <div class="input-grup">
                <!-- PREENCHEMENTO DOS DADOS PESSOAIS -->

                <div class="input-box">
                    <label for="posto">Posto:
                        <select class="form-control" name="posto" required>
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

                <div class="input-box">
                    <label for="nome">Nome:
                        <input type="name" name="nome" class="form-control col" placeholder="Digite o Nome Completo"
                            size="40%" minlength="2" required></label>
                </div>

                <div class="input-box">
                    <label for="cpf">CPF:
                        <input id="cpf" type="text" name="cpf" class="form-control cpf" placeholder="999.999.999-99"
                            maxlength="14" minlength="14" size="15%" required="required"></label>
                </div>

                <div class="input-box">
                    <label for="telefone">Telefone:
                        <input id="telefone" type="text" name="telefone" class="form-control"
                            placeholder="(99) 99999-9999" maxlength="11" minlength="10" size="15%"
                            required="required"></label>
                </div>



                <!-- <hr>

                <div class="input-grup">
                    PREENCHEMENTO DOS DADOS DA RESIDENCIA

                    <div class="input-box">
                        <label for="cep">Cep:
                            <input class="form-control" placeholder="99999-999" id="cep" name="cep" type="text" id="cep"
                                value="" size="7%" minlength="8" maxlength="9"
                                onblur="pesquisacep(this.value);" /></label>
                    </div>

                    <div class="input-box">
                        <label for="rua">Rua:
                            <input class="form-control" name="rua" type="text" id="rua" size="77"
                                minlength="3" /></label>
                    </div>

                    <div class="input-box">
                        <label for="num_casa">Nº:
                            <input class="form-control number" name="num_casa" type="number" id="num_casa" size="10"
                                minlength="1" /></label>
                    </div>

                    <div class="input-box">
                        <label for="bairro">Bairro:
                            <input class="form-control" name="bairro" type="text" id="bairro" size="46"
                                minlength="3" /></label>
                    </div>

                    <div class="input-box">
                        <label for="cidade">Cidade:
                            <input class="form-control" name="cidade" type="text" id="cidade" size="20"
                                minlength="2" /></label>
                    </div>

                    <div class="input-box">
                        <label for="uf">Estado:
                            <input class="form-control" class="form-control" name="uf" type="text" id="uf" size="10"
                                minlength="2" /></label>
                    </div>

                    <div class="input-box">
                        <label for="ibge">IBGE:
                            <input class="form-control" name="ibge" type="text" id="ibge" size="2" /></label>
                    </div>

                </div>FIM DO PREENCHEMENTO DOS DADOS DA RESIDENCIA

                <hr>

                <div class="input-grup">
                    INICIO PREENCHEMENTO DOS DADOS DO CARRO

                    <div class="input-box">
                        <label for="marca">Marca:
                            <select class="form-control" name="marca" id="marca">
                               
                               <?php
                                        // $stmt = $conn->prepare("SELECT DISTINCT marca FROM tb_ex_veiculo");
                                        // $stmt->execute();

                                        // if($stmt->rowCount() > 0){
                                        //         while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        //                 echo "<option value='{$dados['marca']}'>{$dados['marca']}</option>";
                                        //         }
                                        // }
                                ?>

                            </select>
                        </label>
                    </div>

                    <div class="input-box">
                        <label for="modelo">Modelo:
                            <select class="form-control" name="modelo" id="modelo">
                                
                                <?php
                                        // $stmt2 = $conn->prepare("SELECT modelo FROM tb_ex_veiculo");
                                        // $stmt2->execute();

                                        // if($stmt2->rowCount() > 0){
                                        //         while($dados = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                        //                 echo "<option value='{$dados['modelo']}'>{$dados['modelo']}</option>";
                                        //         }
                                        // }
                        
                                ?>

                            </select>
                        </label>
                    </div>

                    <div class="input-box">
                        <label for="placa">Placa:
                            <input class="form-control text-uppercase" id="placa" type="text" name="placa"
                                placeholder="AAA9A99" maxlength="7" size="5"></label>
                    </div>

                    <div class="input-box">
                        <label for="car_cor">Cor:
                            <input class="form-control" id="cor_car" type="text" name="cor_car" placeholder="Azul"
                                size="3"></label>
                    </div>

                    <div class="input-box">
                        <label for="ano_car">Ano:
                            <input class="form-control" id="ano_car" type="number" name="ano_car"  min="1884" placeholder="2022" 
                            onKeyDown="if(this.value.length==4 && event.keyCode>47 && event.keyCode < 58)return false;"></label>
                    </div>

                </div>FIM DO PREENCHEMENTO DOS DADOS DO CARRO -->

                <!-- <div class="input-grup align-items-center"> -->
                <div class="input-box">
                    <label for="cadastroGeral" class="invisible">Teste
                        <input type="submit" value="Salvar" id="cadastroGeral" name="cadastroGeral"
                            class="form-control btn btn-success btn-md botao  visible"></label>
                </div>
            </div>
    </div><!-- FIM DO PREENCHEMENTO DOS DADOS PESSOAIS -->
    </form><!-- FIM DO FORMULARIO CADASTRO GERAL -->


    </div><!-- FIM DA DIV FORMULARIO CADASTRO GERAL -->


    <!--------------------------------------------------- INICIO DO RODA PE ------------------------------------------>

    <?php include_once "link_footer.php" ?>
    <!--- LINK DO FOOTER -->

</body>

</html>