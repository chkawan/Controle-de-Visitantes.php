// Adicionando Javascript 
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=(""); 
            document.getElementById("rua").disabled = false;
            $("input").removeAttr('readonly');
            $("select").removeAttr('readonly');
            document.getElementById('ibge').style.backgroundColor = '#fff';
            document.getElementById('rua').style.backgroundColor = '#fff';
            document.getElementById('bairro').style.backgroundColor = '#fff';
            document.getElementById('cidade').style.backgroundColor = '#fff';
            document.getElementById('uf').style.backgroundColor = '#fff';

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            document.getElementById('ibge').value=(conteudo.ibge);
    
     
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado."); 
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                document.getElementById('ibge').value="...";

                

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);
                $('#rua').prop('readonly', true);
                $('#bairro').prop('readonly', true);
                $('#cidade').prop('readonly', true);
                $('#uf').prop('readonly', true);
                $('#ibge').prop('readonly', true);
                document.getElementById('ibge').style.backgroundColor = '#e9ecef';
                document.getElementById('rua').style.backgroundColor = '#e9ecef';
                document.getElementById('bairro').style.backgroundColor = '#e9ecef';
                document.getElementById('cidade').style.backgroundColor = '#e9ecef';
                document.getElementById('uf').style.backgroundColor = '#e9ecef';
              
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
                
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
            document.body.appendChild(script);
                
        }
    };





   