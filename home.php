<?php
session_start();
ob_start();
include_once "conn.php"?> <!-- CONEXAO COM BD-->

<!doctype html>
	<html lang="en">
	<head>
		<!--- LINK DOS LINKS -->
		<?php include_once "link_head.php" ?>	
		
		<title>Controle de Visitantes</title>
		
	</head>

 	<body>
		<!--- LINK DO MENU -->
		<?php include_once "link_menu.php" ;
			$dataInicial = isset($_POST['dataInicial']) ? $_POST['dataInicial'] : null;
			$dataFinal = isset($_POST['dataFinal']) ? $_POST['dataFinal'] : null;
	
			
			// if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if ($dataInicial != null && $dataFinal != null) {
				// VERIFICA SE O BOTÃO APLICAR FOI CLICADO

				//TODAS AS SAIDAS PENDENTES DENTRO DA DATA SELECIONADA NO INPUT
				$saida = "SELECT COUNT(saidaHr) AS saidaNao FROM tb_visitas WHERE entrada BETWEEN '$dataInicial' AND '$dataFinal' AND saidaHr = '00:00:00'";
				$resut_saida = $conn->prepare($saida);
				$resut_saida->execute();
				$row_saida = $resut_saida->fetch(PDO::FETCH_ASSOC);

				// TODAS AS ENTRADAS PENDENTES DENTRO DA DATA SELECIONADA NO INPUT
				$entradas = "SELECT COUNT(entradaHr) AS visitas FROM tb_visitas WHERE entrada BETWEEN '$dataInicial' AND '$dataFinal' AND saidaHr != '00:00:00'";
				$resut_entradas = $conn->prepare($entradas);
				$resut_entradas->execute();
				$row_entradas = $resut_entradas->fetch(PDO::FETCH_ASSOC);
				
			
				
		}else{ //CASO O BOTÃO APLICAR NAO TENHA SIDO CLICADO O VALOR PADRÃO DEVERÁ SER ESSE.

			//TODAS AS SAIDAS PENDENTES
			$saida = "SELECT COUNT(saidaHr) AS saidaNao FROM tb_visitas WHERE saidaHr = '00:00:00'";
			$resut_saida = $conn->prepare($saida);
			$resut_saida->execute();
			$row_saida = $resut_saida->fetch(PDO::FETCH_ASSOC);

				// TODAS AS ENTRADAS PENDENTES
			$entradas = "SELECT COUNT(entradaHr) AS visitas FROM tb_visitas WHERE saidaHr != '00:00:00'";
			$resut_entradas = $conn->prepare($entradas);
			$resut_entradas->execute();
			$row_entradas = $resut_entradas->fetch(PDO::FETCH_ASSOC);

		}
	
		//TOTAL DE VISITAS - NAO MUDA
		$total = "SELECT COUNT(entradaHr) AS visitas  
		FROM tb_visitas";
        $resut_total = $conn->prepare($total);
        $resut_total->execute();
        $row_total = $resut_total->fetch(PDO::FETCH_ASSOC);

			//TOTAL DE VISITANTES - NAO MUDA
		$visitantes = "SELECT COUNT(visit_id) AS id FROM tb_visitantes WHERE visit_id <> '0'";
		$result_visitantes = $conn->prepare($visitantes);
		$result_visitantes->execute();
		$row_visitantes = $result_visitantes->fetch(PDO::FETCH_ASSOC);
		?>
		<!--- INICIO DO CONTEUDO PRINCIPAL -->
		<div class="home">
			<div class="display form-sigin-heading text-center">Resumo Geral</div>
			<hr>
			<div class="seletor">
			<form method="POST" action="home.php" id="data">
					<label for="dataInicial">Data inicial:</label>
					<input type="date" id="dataInicial" name="dataInicial" value="<?php echo $dataInicial; ?>">
					
					<label for="dataFinal">Data final:</label>
					<input type="date" id="dataFinal" name="dataFinal" value="<?php echo $dataFinal; ?>">
					
					<button onclick="enviarDados()" class="botao">Aplicar</button>
            		<button onclick="limparCampos()" class="botao">Limpar</button>
				</form>
			</div>

			

			<div class="container">
				
				<div class="box-control  ">

					<div class="title green">Visitas Realizadas</div>
					
					<div class="valores green"><?php echo $row_entradas['visitas'] ?></div>

				</div>

				
				
				<div class="box-control">
					
					<div class="title red">Saidas Pendentes</div>
				
					<div class="valores red"><?php echo $row_saida['saidaNao'] ?></div>
				
				</div>

				<div class="box-control">

					<div class="title">Total de Visitas</div>

					<div class="valores"><?php echo $row_total['visitas'] ?></div>
										
				</div>

				<div class="box-control">
					
					<div class="title">Visitantes</div>
					
					<div class="valores"><?php echo $row_visitantes['id'] ?></div>
				
				</div>
			</div>
		</div>


		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function enviarDados() {
            var dataInicial = document.getElementById("dataInicial").value;
            var dataFinal = document.getElementById("dataFinal").value;

            $.ajax({
                type: "POST",
                url: "home.php",
                data: { dataInicial: dataInicial, dataFinal: dataFinal },
                success: function(response) {
                    console.log("Data inicial: " + dataInicial),
					console.log("Data final: " + dataFinal);
                }
            });
        }


		function limparCampos() {
            document.getElementById('dataInicial').value = null;
            document.getElementById('dataFinal').value = null;
			form.reset();
        }	
		
    </script>
		
<!--------------------------------------------------- INICIO DO RODA PE ------------------------------------------>
		<!--- LINK DO FOOTER -->
		<?php include_once "link_footer.php" ?>
        
 	</body>
</html>