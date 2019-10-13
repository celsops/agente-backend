<?php
include "../createConnection.php";

class MoradiaDAO{

	private function verificaCampos($fields){
		foreach($fields as $f => $v){
			if ($v == null or $v == ''){
				return False;
			}
		}

		return True;
	}

	public function create($props){
		if (!$this->verificaCampos($props)){
			return False;
		}

		$id_moradia = $this->create_moradia($props);

		if( gettype($id_moradia) != "string" ){
			$num_sus = $props ->numero_sus;
			$this->create_rel_user_moradia($num_sus, $id_moradia);
			return "OK!";
		}else{
			//echo "Não foi possível relacionar casa com cidadão. Tente novamente em alguns instantes.";
			return "ERROR";
		}
	}

	private function create_moradia($props){
		$conn = createConnectionDB();

		$sql = "insert into tbl_moradia(col_cep, col_numero, col_agua, col_esgoto, col_lixo, col_animal, col_rua_moradia)";
		$sql = $sql . "values(".$props->col_cep.",".$props->col_numero_casa .",'". $props->col_agua."', '". $props->col_esgoto."','". $props->col_lixo ."','";
		$sql = $sql . $props->col_tem_animal."','".$props->col_rua_moradia."');";

		// var_dump($sql);
		if ($conn->query($sql)==True){
			$consulta = "select * from tbl_moradia ordem by cod_moradia desc limit=1;";

			$retorno = $conn->query($consulta);

			$conn->close();
			return $retorno;
		}
		else{
			$conn->close();
			return "ERROR";
		}

	}

	private function create_rel_user_moradia($user_id, $moradia_id){
		$conn = createConnectionDB();

		$sql = "insert into tbl_rel_usuario_moradia(num_sus, cod_moradia)";
		$sql = $sql . "values(". $user_id.", ". $moradia_id .");";

		/**
		 * num_sus bigint not null, cod_moradia bigint not null
		 */

		 //echo " REL_USER_MORADIA |" . $sql;

		$result = $conn->query($sql);
		$conn->close();

		if($result === True){
			return "OK";
		}else{
			return "ERROR";
		}
	}

}



?>
