<?php
session_start();
include_once 'conn.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!-- CONEXAO COM BD-->

<!doctype html>
<html lang="en">

<head>
    <!--- LINK DOS LINKS -->
    <?php include_once "link_head.php" ?>
    <title>Editar Visitante</title>
</head>

<body>

    <?php include_once "link_menu.php" ?>
    <!--- LINK DO MENU -->

    <?php
        //SQL para selecionar o registro
        $result_msg_cont = "SELECT * FROM tb_visitantes vis
        LEFT JOIN tb_veiculo_visitante AS car ON car.id_carro=vis.visit_id
        LEFT JOIN tb_endereco_visitante AS loc ON loc.id_end=vis.visit_id
        WHERE visit_id='$id'";
        
        //Seleciona os registros
        $resultado_msg_cont = $conn->prepare($result_msg_cont);
        $resultado_msg_cont->execute();
        $row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC); 
        
        ?>



    <div class="form-sigin ediVis ">
        <!-- INICIO DA DIV FORMULARIO CADASTRO GERAL -->

        <div class="display form-sigin-heading text-center">Editar Cadastro do Visitante</div> <!-- TEXTO DO TITTULO -->
        <hr>

        <?php include_once "erro.php" ?>
        <!--*table table-striped table-hover display nowarp-->

        <form id="editarform" method="POST" action="processa_editar.php" class="container" >
            <!-- INICIO DO FORMULARIO CADASTRO GERAL -->

            <div class="input-grup">
                <!-- PREENCHEMENTO DOS DADOS PESSOAIS -->

                <div class="input-box">
                    <label for="posto">Posto:
                        <select class="form-control" name="posto" required="required">
                            <option value="<?php if(isset($row_msg_cont['posto'])){ echo $row_msg_cont['posto']; } ?>">
                                <?php if(isset($row_msg_cont['posto'])){ echo $row_msg_cont['posto']; } ?>
                            </option>
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

                <div class="input-box">
                    <label for="nome">Nome:
                        <input type="name" name="nome" class="form-control col" placeholder="Digite o Nome Completo"
                            size="40%" minlength="2" required="required"
                            value="<?php if(isset($row_msg_cont['nome'])){ echo $row_msg_cont['nome']; } ?>"></label>
                </div>

                <div class="input-box">
                    <label for="cpf">CPF:
                        <input id="cpf" type="text" name="cpf" class="form-control cpf btnNone"
                            placeholder="999.999.999-99" maxlength="11" minlength="11" size="12%" required="required"
                            value="<?php if(isset($row_msg_cont['cpf'])){ echo $row_msg_cont['cpf']; } ?>"
                            readonly></label>
                </div>

                <div class="input-box">
                    <label for="telefone">Telefone:
                        <input id="telefone" type="text" name="telefone" class="form-control"
                            placeholder="(99) 99999-9999" maxlength="11" minlength="10" size="12%" required="required"
                            value="<?php if(isset($row_msg_cont['telefone'])){ echo $row_msg_cont['telefone']; } ?>"></label>
                </div>
                <!-- <div class="input-box invisible">
                    <label for="nome">ID:
                        <input type="text" name="visit_id" class="form-control col" size="1" minlength="1"
                            required="required"
                            value="<?php if(isset($row_msg_cont['visit_id'])){ echo $row_msg_cont['visit_id']; } ?>"></label>
                </div> -->

            </div><!-- FIM DO PREENCHEMENTO DOS DADOS PESSOAIS -->
            <hr>
            <!--  
            ---- FORMULARIO PARA ENDEREÇO E VEICULO --->

            <div class="input-grup">
                <!-- PREENCHEMENTO DOS DADOS DA RESIDENCIA -->

                <div class="input-box">
                    <label for="cep">Cep:
                        <input required="required" class="form-control" placeholder="99999-999" id="cep" name="cep" type="text" id="cep"
                            size="7%" minlength="8" maxlength="9" onblur="pesquisacep(this.value);"
                            value="<?php if(isset($row_msg_cont['cep'])){ echo $row_msg_cont['cep']; } ?>" /></label>
                </div>

                <div class="input-box">
                    <label for="rua">Rua:
                        <input $disabledCampo required="required" class="form-control" name="rua" type="text" id="rua" size="63%" minlength="3"
                            value="<?php if(isset($row_msg_cont['rua'])){ echo $row_msg_cont['rua']; } ?>"  /></label>
                </div>

                <div class="input-box">
                    <label for="num_casa">Nº:
                        <input required="required" class="form-control number" name="num_casa" type="text" id="num_casa" size="7%"
                            minlength="1"
                            value="<?php if(isset($row_msg_cont['num_casa'])){ echo $row_msg_cont['num_casa']; } ?>" /></label>
                </div>
                    </div>
                    <div class="input-grup">
                <!-- PREENCHEMENTO DOS DADOS DA RESIDENCIA -->
                <div class="input-box">
                    <label for="bairro">Bairro:
                        <input required="required" class="form-control" name="bairro" type="text" id="bairro" size="43%" minlength="3"
                            value="<?php if(isset($row_msg_cont['bairro'])){ echo $row_msg_cont['bairro']; } ?>" /></label>
                </div>

                <div class="input-box">
                    <label for="cidade">Cidade:
                        <input required="required" class="form-control" name="cidade" type="text" id="cidade" size="10%" minlength="2"
                            value="<?php if(isset($row_msg_cont['cidade'])){ echo $row_msg_cont['cidade']; } ?>" /></label>
                </div>

                <div class="input-box">
                    <label for="uf">Estado:
                        <input required="required" class="form-control" class="form-control" name="uf" type="text" id="uf" size="10%"
                            minlength="2"
                            value="<?php if(isset($row_msg_cont['uf'])){ echo $row_msg_cont['uf']; } ?>" /></label>
                </div>

                <div class="input-box">
                    <label for="ibge">IBGE:
                        <input class="form-control" name="ibge" type="text" id="ibge" size="7%" maxlength="8"
                            value="<?php if(isset($row_msg_cont['ibge'])){ echo $row_msg_cont['ibge']; } ?>" /></label>
                </div>

            </div><!-- FIM DO PREENCHEMENTO DOS DADOS DA RESIDENCIA -->

            <hr>

            <div class="input-grup">
                <!-- INICIO PREENCHEMENTO DOS DADOS DO CARRO -->

                <div class="input-box">
                    <label for="marca">Marca:
                        <select required="required" class="form-control selectDiv" name="marca" id="marca">
                            <option value=""><?php if(isset($row_msg_cont['marca'])){ echo $row_msg_cont['marca']; } ?>
                            </option>
                            <!--VINDO DO VISITANTE --->
                            <?php
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

                <div class="input-box">
                    <label for="modelo">Modelo:
                        <select required="required" class="form-control selectDiv2" name="modelo" id="modelo"
                            value="<?php if(isset($row_msg_cont['modelo'])){ echo $row_msg_cont['modelo']; } ?>">
                            <option value="">
                                <?php if(isset($row_msg_cont['modelo'])){ echo $row_msg_cont['modelo']; } ?></option>
                            <!--VINDO DO VISITANTE --->
                            <?php
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

            

            <div class="input-grup">
                <div class="input-box">
                    <label for="placa">Placa:
                        <input class="form-control text-uppercase" id="placa" type="text" name="placa"
                            placeholder="AAA9A99" maxlength="8" minlength="7" size="5"
                            value="<?php if(isset($row_msg_cont['placa'])){ echo $row_msg_cont['placa']; } ?>"></label>
                </div>

                <div class="input-box">
                    <label for="car_cor">Cor:
                        <input class="form-control" id="cor_car" type="text" name="cor_car" minlength="2" maxlength="30"
                            placeholder="Azul" size="3"
                            value="<?php if(isset($row_msg_cont['cor_car'])){ echo $row_msg_cont['cor_car']; } ?>"></label>
                </div>

                <div class="input-box">
                    <label for="ano_car">Ano:
                        <input class="form-control"  id="ano_car" type="number" name="ano_car" min="0000"
                            placeholder="2022"
                            onKeyDown="if(this.value.length==4 && event.keyCode>47 && event.keyCode < 58)return false;"
                            value="<?php if(isset($row_msg_cont['ano_car'])){ echo $row_msg_cont['ano_car']; } ?>"></label>
                </div>
                    </div>

            </div><!-- FIM DO PREENCHEMENTO DOS DADOS DO CARRO -->


            <div class="input-grup justify-content-center">
            <div class="input-box">
                <button type='button' id='<?php echo "$id"?>' class='btn btn-danger btn-sm'
                onclick='apagarUsuario2(<?php echo "$id"?>)'>Apagar</button>
            </div>
                <div class="input-box">
                    <input type="submit" id='<?php echo $id?>' value="Salvar" name="SendEditCont"
                        class="btn btn-success btn-sm botao">
                </div>

                <div class="input-box">
                    <a href="lista_visitante.php"></a><input type="buttom" value="Voltar"
                            class="btn btn-secondary btn-sm botao">
                    
                </div>
            </div>
    </div>
    </form><!-- FIM DO FORMULARIO CADASTRO GERAL -->


    </div><!-- FIM DA DIV FORMULARIO CADASTRO GERAL -->


    <!--------------------------------------------------- INICIO DO RODA PE ------------------------------------------>

    <?php include_once "link_footer.php" ?>
    <!--- LINK DO FOOTER -->

</body>

</html>