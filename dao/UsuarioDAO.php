<?php

include "../createConnection.php";

class UsuarioDAO{
	private function verificaCampos($fields){
		foreach($fields as $f => $v){
			if ($v === null or $v === ''){
				return False;
			}
		}
		return True;
	}

	private function get_cod_deficiencia($cod){
		$conn = createConnectionDB();

		$sql = "select cod_deficiencia from tbl_deficiencia where nom_deficiencia ='".$cod."';";

		$r = mysqli_query($conn, $sql);
		$conn->close();

		if ( mysqli_num_rows($r)==0){ //Tamanho
				return "Cod não cadastrado.";
		}
		$row = $r->fetch_assoc();
		return $row['cod_deficiencia'];

	}

	public function create($props){

		if (!$this->verificaCampos($props)){
			return "Algum campo está vazio!"; //"Campos inválidos";
		}
		foreach($props as $f => $v){
			if ($v===false){
				$props->$f = 0;
			}
			elseif ($v===true){
				$props->f = 0;
			}
		}

		$conn = createConnectionDB();

		$cod_deficiencia = $this->get_cod_deficiencia($props->cod_deficiencia);

		$sql = "insert into tbl_usuario(num_sus, col_parentesco, col_genero, cod_deficiencia, col_obito, col_plano_saude, col_mudanca, cod_escolaridade, col_crianca_fica_com)";
		$sql = $sql . "values(" . $props->num_sus .", '". $props->col_parentesco . "', '". $props->col_sexo . "', ". $cod_deficiencia . ",".  $props->col_obito . ",". $props->col_plano_saude .",". $props->col_mudanca.", '". $props->cod_escolaridade ."', '". $props->col_crianca."');";

		// var_dump($sql);
		$result = $conn->query($sql);
		$erro = $conn->error;
		$conn->close();

		if ($result===True){
			return "OK!";
		}else{
			var_dump($erro);
			return "Error";
		}

	}

	public function do_login($props){
		$conn = createConnectionDB();
		$email = $props ->col_email;
		$senha = md5($props -> col_senha);

		$sql = "select * from tbl_agente where col_email='". $email."';";

		$r = mysqli_query($conn, $sql);
		$conn->close();

		if ( mysqli_num_rows($r)==0){ //Tamanho
			return "Agente não cadastrado.";
		}

		while($row = $r->fetch_assoc()) {
			if($row['col_senha'] == $senha){
				return "OK!";
			}
		}

		return "Usuario ou senha incorreto.";
	}

	public function create_agente($props){
		$conn = createConnectionDB();
		$email = $props ->col_email;
		$senha = md5($props -> col_senha);
		$cpf = $props ->col_cpf;

		$sql = "select col_cpf from tbl_agente where col_cpf=".$cpf.";";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result)!=0){
			return "CPF já cadastrado!";
		}
		$sql = "select col_email from tbl_agente where col_email='".$email."';";

		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result)!=0){
			return "Este email já está sendo usado!";
		}


		// $sql = "select * from tbl_agente where col_email='". $email."';";
		$sql = "insert into tbl_agente(col_cpf, col_email, col_senha) VALUES (".$cpf.",'".$email."','".$senha."');";
		// var_dump($sql);
		$result = mysqli_query($conn, $sql);
		if ($result){
			return "OK!";
		}
		else{
			// var_dump($conn->error);
			return $conn->error;
		}
		$conn->close();

	}
  public function create_cidadao_rua($props){
			foreach($props as $f => $v){
				if ($v===false){
					$props->$f = 0;
				}
			}
			$conn = createConnectionDB();

			$sql = "insert into tbl_cidadao_rua(num_sus,col_tempo_rua, col_alimenta_dia, col_origem_alimentacao, col_higiene_pessoal, col_recebe_beneficio, col_possui_referencia_familiar) ";
			$sql = $sql . "values(".$props->num_sus.",'".$props->col_tempo_rua."','".$props->col_alimenta_dia."', '".$props->col_origem_alimentacao."','".$props->col_higiene_pessoal."', ".$props->col_recebe_beneficio.",".$props->col_possui_referencia_familiar.");";

			$result = $conn->query($sql);
			$erro = $conn->error;
			$conn->close();

			if ($result){
			  return "OK!";
			}
			else{
			  return "Erro ao cadastrar.";
			}
		}
}
?>
