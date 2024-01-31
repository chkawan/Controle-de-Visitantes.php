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
    <title>Visualizar Visitante</title>
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



    <div class="form-sigin ediVis">
        <!-- INICIO DA DIV FORMULARIO CADASTRO GERAL -->

        <div class="display form-sigin-heading text-center">Visualizar Cadastro do Visitante</div>
        <!-- TEXTO DO TITTULO -->
        <span id="msgAlerta"></span>
        <?php include_once "erro.php" ?>
        <hr>

        <form method="POST" action="processa_editar.php" class="container">
            <!-- INICIO DO FORMULARIO CADASTRO GERAL -->

            <div class="input-grup">
                <!-- PREENCHEMENTO DOS DADOS PESSOAIS -->

                <div class="input-box">
                    <label for="posto">Posto:
                        <select disabled class="form-control" name="posto" required="required">
                            <option value="<?php if(isset($row_msg_cont['posto'])){ echo $row_msg_cont['posto']; } ?>">
                                <?php if(isset($row_msg_cont['posto'])){ echo $row_msg_cont['posto']; } ?>

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
                            </option>
                        </select>
                        <!--VINDO DO VISITANTE --->

                    </label>
                </div>

                <!-- <div class="input-box">
                    <label for="visit_id">ID:
                        <input type="text" name="visit_id" class="form-control col"
                            size="1%" minlength="1"
                            value="<?php if(isset($row_msg_cont['visit_id'])){ echo $row_msg_cont['visit_id']; } ?>"
                            disabled></label>
                </div> -->
                <div class="input-box">
                    <label for="nome">Nome:
                        <input type="name" name="nome" class="form-control col" placeholder="Digite o Nome Completo"
                            size="39%" minlength="2" required="required"
                            value="<?php if(isset($row_msg_cont['nome'])){ echo $row_msg_cont['nome']; } ?>"
                            disabled></label>
                </div>

                <div class="input-box">
                    <label for="cpf">CPF:
                        <input id="cpf" type="text" name="cpf" class="form-control cpf" placeholder="999.999.999-99"
                            maxlength="11" minlength="11" size="12%" required="required"
                            value="<?php if(isset($row_msg_cont['cpf'])){ echo $row_msg_cont['cpf']; } ?>"
                            readonly></label>
                </div>

                <div class="input-box">
                    <label for="telefone">Telefone:
                        <input id="telefone" type="text" name="telefone" class="form-control"
                            placeholder="(99) 99999-9999" maxlength="11" minlength="10" size="13%" required="required"
                            value="<?php if(isset($row_msg_cont['telefone'])){ echo $row_msg_cont['telefone']; } ?>"
                            disabled></label>
                </div>

            </div><!-- FIM DO PREENCHEMENTO DOS DADOS PESSOAIS -->

            <hr>

            <div class="input-grup">
                <!-- PREENCHEMENTO DOS DADOS DA RESIDENCIA -->

                <div class="input-box">
                    <label for="cep">Cep:
                        <input class="form-control" placeholder="99999-999" id="cep" name="cep" type="text" id="cep"
                            size="8%" minlength="8" maxlength="9" onblur="pesquisacep(this.value);"
                            value="<?php if(isset($row_msg_cont['cep'])){ echo $row_msg_cont['cep']; } ?>"
                            disabled /></label>
                </div>

                <div class="input-box">
                    <label for="rua">Rua:
                        <input class="txtBloqueado form-control" name="rua" type="text" id="rua" size="66%"
                            minlength="3" value="<?php if(isset($row_msg_cont['rua'])){ echo $row_msg_cont['rua']; } ?>"
                            disabled /></label>
                </div>

                <div class="input-box">
                    <label for="num_casa">Nº:
                        <input class="form-control number" name="num_casa" type="text" id="num_casa" size="7%"
                            minlength="1"
                            value="<?php if(isset($row_msg_cont['num_casa'])){ echo $row_msg_cont['num_casa']; } ?>"
                            disabled /></label>
                </div>
                <div>
                    <div class="input-grup">
                        <!-- PREENCHEMENTO DOS DADOS DA RESIDENCIA -->
                        <div class="input-box">
                            <label for="bairro">Bairro:
                                <input class="txtBloqueado form-control" name="bairro" type="text" id="bairro"
                                    size="49%" minlength="3"
                                    value="<?php if(isset($row_msg_cont['bairro'])){ echo $row_msg_cont['bairro']; } ?>"
                                    disabled /></label>
                        </div>

                        <div class="input-box">
                            <label for="cidade">Cidade:
                                <input class="txtBloqueado form-control" name="cidade" type="text" id="cidade"
                                    size="10%" minlength="2"
                                    value="<?php if(isset($row_msg_cont['cidade'])){ echo $row_msg_cont['cidade']; } ?>"
                                    disabled /></label>
                        </div>

                        <div class="input-box">
                            <label for="uf">Estado:
                                <input class="txtBloqueado form-control" class="form-control" name="uf" type="text"
                                    id="uf" size="10%" minlength="2"
                                    value="<?php if(isset($row_msg_cont['uf'])){ echo $row_msg_cont['uf']; } ?>"
                                    disabled /></label>
                        </div>

                        <div class="input-box">
                            <label for="ibge">IBGE:
                                <input class="txtBloqueado form-control" name="ibge" type="text" id="ibge" size="7%'"
                                    value="<?php if(isset($row_msg_cont['ibge'])){ echo $row_msg_cont['ibge']; } ?>"
                                    disabled /></label>
                        </div>

                    </div><!-- FIM DO PREENCHEMENTO DOS DADOS DA RESIDENCIA -->

                    <hr>

                    <div class="input-grup">
                        <!-- INICIO PREENCHEMENTO DOS DADOS DO CARRO -->

                        <div class="input-box">
                            <label for="marca">Marca:
                                <select required class="form-control selectDiv" name="marca" id="marca" disabled>
                                    <option
                                        value="<?php if(isset($row_msg_cont['marca'])){ echo $row_msg_cont['marca']; } ?>">
                                        <?php if(isset($row_msg_cont['marca'])){ echo $row_msg_cont['marca']; } ?>
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
                                <select required class="form-control selectDiv2" name="modelo" id="modelo" disabled>
                                    <option
                                        value="<?php if(isset($row_msg_cont['modelo'])){ echo $row_msg_cont['modelo']; } ?>">
                                        <?php if(isset($row_msg_cont['modelo'])){ echo $row_msg_cont['modelo']; } ?>
                                    </option>
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
                                        placeholder="AAA9A99" maxlength="8" size="7%"
                                        value="<?php if(isset($row_msg_cont['placa'])){ echo $row_msg_cont['placa']; } ?>"
                                        disabled></label>
                            </div>

                            <div class="input-box">
                                <label for="car_cor">Cor:
                                    <input class="form-control" id="cor_car" type="text" name="cor_car"
                                        placeholder="Azul" size="10%"
                                        value="<?php if(isset($row_msg_cont['cor_car'])){ echo $row_msg_cont['cor_car']; } ?>"
                                        disabled></label>
                            </div>

                            <div class="input-box">
                                <label for="ano_car">Ano:
                                    <input disabled="" class="form-control" id="ano_car" type="text" name="ano_car"
                                        min="0" placeholder="2022" size="5%"
                                        value="<?php if(isset($row_msg_cont['ano_car'])){ echo $row_msg_cont['ano_car']; } ?>"></label>
                            </div>
                        </div>
                    </div><!-- FIM DO PREENCHEMENTO DOS DADOS DO CARRO -->

                    <div class="input-grup justify-content-center">
                       
                        <div class="input-box">
                            <button disabled id="myButton3" type="submit" id='<?php echo $id?>'  name="SendEditCont" value="Salvar"
                                class="btn btn-success btn-sm botao2 bt">Salvar</button>
                        </div>

                        <!-- <div class="input-box">
                        <input disabled id="myButton3" type="button" id='<?php //echo $id?>'  name="deleteCad" value="Deletar"
                        onclick='apagarUsuario(<?php //echo "$id"?>)' class="btn btn-danger btn-sm botao2 bt">
                        </div> -->

                        <div class="input-box">
                            <button id="myButton" type="button" value="Editar" onclick="myFunction()"
                                class="btn btn-primary btn-sm botao2">Editar</button>
                        </div>

                        <div class="input-box">

                            <a href="lista_visitante.php"><button id="myButton2" type="button" value="Voltar"
                                    onclick="salvar()" class="btn btn-secondary btn-sm botao botao2">Sair</button></a>
                        </div>
                    </div>
                </div>
        </form><!-- FIM DO FORMULARIO CADASTRO GERAL -->


    </div><!-- FIM DA DIV FORMULARIO CADASTRO GERAL -->


    <!--------------------------------------------------- INICIO DO RODA PE ------------------------------------------>

    <script>//funação do botão EDITAR
    var btn = document.getElementById("myButton");
    var cep = document.getElementById("cep").value;

    // Se você deseja ocultar o botão quando estiver desativado
    if (button.disabled) {
            button.style.display = "none";
        } else {
            button.style.display = "inline-block"; // ou "block" dependendo do layout desejado
        }
    function myFunction() { 
        if (btn.innerHTML == "Editar") {// removendo disabled
            $("input").removeAttr('disabled');
            $("select").removeAttr('disabled');
            $("button").removeAttr('disabled');
            $("#myButton").remove();
            $('input').prop('required', true);
            $('select').prop('required', true);
        }

        if (cep.length = 0) {//removendo readonly
            $('#rua').prop('readonly', false);
            $('#bairro').prop('readonly', false);
            $('#cidade').prop('readonly', false);
            $('#uf').prop('readonly', false);
            $('#ibge').prop('readonly', false);

        } else {//mantendo o input com readonly
            document.getElementById('ibge').style.backgroundColor = '#e9ecef';
            document.getElementById('rua').style.backgroundColor = '#e9ecef';
            document.getElementById('bairro').style.backgroundColor = '#e9ecef';
            document.getElementById('cidade').style.backgroundColor = '#e9ecef';
            document.getElementById('uf').style.backgroundColor = '#e9ecef';
            $('#rua').prop('readonly', true);
            $('#bairro').prop('readonly', true);
            $('#cidade').prop('readonly', true);
            $('#uf').prop('readonly', true);
            $('#ibge').prop('readonly', true);
        }

    }
</script>
    
    <?php include_once "link_footer.php" ?>
    <!--- LINK DO FOOTER -->

</body>

</html>