<?php

include "../createConnection.php";

class UsuarioSaudeDAO{
    public function create_health($props){
        $conn = createConnectionDB();

        foreach($props as $f => $v){
    			if ($v===false){
    				$props->$f = 0;
    			}
    		}

        $sql = "insert into tbl_saude_cidadao(num_sus, col_peso, col_doenca_cardiaca, col_doenca_respiratoria, col_problema_rins,";
        $sql = $sql . "col_fumante, col_alcool, col_avc, col_drogas, col_hipertensao, col_diabetes, col_mudanca, col_cancer)";
        $sql = $sql . "values(".$props->num_sus.",'".$props->col_peso."','".$props->col_doenca_cardiaca."','".$props->col_doenca_respiratoria."','".$props->col_problema_rins."'";
        $sql = $sql . ",".$props->col_fumante.",".$props->col_alcool.",".$props->col_avc.",".$props->col_drogas.",".$props->col_hipertensao.",".$props->col_diabetes.",".$props->col_mudanca.",".$props->col_cancer.");";

        $result = $conn->query($sql);

        $conn->close();

        if($result){
            return "OK!";
        }else{
            return "ERROR";
        }
    }
}

?>
