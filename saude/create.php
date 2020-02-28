<?php
header('Access-Control-Allow-Origin: *');

if (isset($_GET['dados'])){
  include "../dao/UsuarioSaudeDAO.php";

  $jsonP = json_decode($_GET['dados']);

  $health = new UsuarioSaudeDAO();
  $r = $health->create_health($jsonP);

  echo $r;
}
else{
  echo "Nenhum dado enviado!";
}
?>
