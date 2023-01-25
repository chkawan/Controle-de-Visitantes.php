<?php
session_start();

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
		<?php include_once "link_menu.php" ?>
		
		<!--- INICIO DO CONTEUDO PRINCIPAL -->
		<div class="home text-center">
<h1 calss="display-1 ">BEM-VINDO VISITANTE</h1>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action">Lista de Visitantes</a>
  <a href="#" class="list-group-item list-group-item-action">Cadastrar Visitante</a>
  <a href="#" class="list-group-item list-group-item-action">Cadastrar Veículo</a>
  <a href="#" class="list-group-item list-group-item-action disabled">-</a>
  <a href="#" class="list-group-item list-group-item-action ">Lista de Visitas</a>
  <a href="#" class="list-group-item list-group-item-action">Regisitrar Visita</a>
  
</div>
             
        </div>
		





<!--------------------------------------------------- INICIO DO RODA PE ------------------------------------------>
		<!--- LINK DO FOOTER -->
		<?php include_once "link_footer.php" ?>
        
 	</body>
</html>