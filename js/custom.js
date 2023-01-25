
// FUNÇÃO PARA RECEBER OS VALORES DO DATABESE
$(document).ready(function () {
    $("input[name='cpf']").blur(function () {
        var $nome = $("input[name='nome']");
        var $telefone = $("input[name='telefone']");
        var $posto = $("select[name='posto']");

        var $cep = $("input[name='cep']");
        var $rua = $("input[name='rua']");
        var $bairro = $("input[name='bairro']");
        var $num_casa = $("input[name='num_casa']");
        var $cidade = $("input[name='cidade']");
        var $uf = $("input[name='uf']");
        var $ibge = $("input[name='ibge']");

        var $marca = $("select[name='marca']");
        var $modelo = $("select[name='modelo']");
        var $ano_car = $("input[name='ano_car']");
        var $cor_car = $("input[name='cor_car']");
        var $placa = $("input[name='placa']");
        var cpf = $(this).val();
        
        $.getJSON('processa_pesquisa.php', {cpf},
            function(retorno){
                $nome.val(retorno.nome);
                $telefone.val(retorno.telefone);
                $posto.val(retorno.posto);

                $cep.val(retorno.cep);
                $rua.val(retorno.rua);
                $bairro.val(retorno.bairro);
                $num_casa.val(retorno.num_casa);
                $cidade.val(retorno.cidade);
                $uf.val(retorno.uf);
                $ibge.val(retorno.ibge);

                $marca.val(retorno.marca);
                $modelo.val(retorno.modelo);
                $ano_car.val(retorno.ano_car);
                $cor_car.val(retorno.cor_car);
                $placa.val(retorno.placa);
               
                /// RECEBENDO VALOR REDONLY NO FORMULARIO APOS O CPF
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
            
                var cep = document.getElementById("cep").value; //RECEBENDO O VALOR DO CAMPO CEP
                if(cep.length = 0){//HABILITANDO O CEP CASO NÃO TRAGA NENHUM VALOR NO CAMPO CEP
                    $('#rua').prop('readonly', false);
                    $('#bairro').prop('readonly', false);
                    $('#cidade').prop('readonly', false);
                    $('#uf').prop('readonly', false);
                    $('#ibge').prop('readonly', false);
                    document.getElementById('ibge').style.backgroundColor = '#fff';
                    document.getElementById('rua').style.backgroundColor = '#fff';
                    ocument.getElementById('bairro').style.backgroundColor = '#fff';
                    document.getElementById('cidade').style.backgroundColor = '#fff';
                    document.getElementById('uf').style.backgroundColor = '#fff';
                }

                }


        );  
  
    });
});
