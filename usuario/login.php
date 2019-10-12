<?php

include "../dao/UsuarioDAO2.php";

header('Acess-Control-Allow-Origin: *');

$jsonP = json_decode($_GET);

$user = new UsuarioDAO();
$r = $user->do_login($jsonP['dados']);
echo $r;

?>