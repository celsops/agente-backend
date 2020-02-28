<?php
	header('Access-Control-Allow-Origin: *');
	if (isset($_GET['dados'])){

		/* Criando  usuario*/
		include "../dao/UsuarioDAO.php";

	  $jsonP = json_decode($_GET['dados']);

		$user = new UsuarioDAO();
		// var_dump($jsonP);
		$result = $user->create_agente($jsonP);
		echo $result;
	}
	else{
		echo "Nenhum dado foi enviado!";
	}
?>
