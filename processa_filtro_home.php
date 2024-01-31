<?php

include_once "conn.php";



		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Obter os dados do formulário
			$dataInicial = $_POST["dataInicial"];
			$dataFinal = $_POST["dataFinal"];

			// Agora você pode usar $dataInicial e $dataFinal conforme necessário

			// Exemplo de uso:
			echo "Data Inicial: " . $dataInicial . "<br>";
			echo "Data Final: " . $dataFinal . "<br>";
		}else{


		}