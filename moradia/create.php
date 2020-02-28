<?php
header('Access-Control-Allow-Origin: *');

if (isset($_GET['dados'])){
  include "../dao/moradiaDAO.php";

  $jsonP = json_decode($_GET['dados']);
  $moradia = new MoradiaDAO();
  $result = $moradia->create($jsonP);
  echo $result;
}
else{
  echo "Nenhum dado foi enviado!";
}

?>
