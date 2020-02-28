<?php
header('Access-Control-Allow-Origin: *');

if (isset($_GET['dados'])){
  include "../dao/UsuarioDAO.php";

  $jsonP = json_decode($_GET['dados']);

  $user = new UsuarioDAO();
  $r = $user->create_cidadao_rua($jsonP);
  echo $r;
}
else{
  echo "Nenhum dado enviado!";
}
?>
