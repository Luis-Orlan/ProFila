<?php
class Painel{

	private $mensage = [];
	public $senha;
	public $senhaPronta;

	public function fs_GerarSenha($paremetro = []){
		if(!empty($paremetro->tipoAtendimento)){

			if(!empty($paremetro->orgao)){

				if($this->montaSenha($paremetro->tipoAtendimento, $paremetro->orgao)) {

					$this->set_Mensage(["tipo" => "alert-success", "msg" => "Senha Gerada com Sucesso.", "senha" => $_SESSION['senha']]);
					unset($this->senha);
				}else{
					$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Erro ao Gerar a Senha"]);
				}

			}else{
				$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Orgão Selecionado invalido."]);
			}

		}else{
			$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Prioridade de Atendimento invalida."]);
		}

		$this->show_Mensage();
	}

	private function montaSenha($prioridade = false, $orgao = false){
		 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		   	$ip = $_SERVER['REMOTE_ADDR'];
		}

		$senha = $this->generatePassword($prioridade, 4);
		$sql = "INSERT INTO `tb_atendimentosenha` (
				`as_ID`, 
				`as_NumeroMesa`, 
				`as_Setor`, 
				`as_NivelPrioridade`, 
				`as_SenhaPainel`, 
				`as_TempoMesa`, 
				`as_DataHora`, 
				`as_IP_Local_Senha_Gerada`, 
				`as_IP_Local_Senha_Atendida`,
				`as_StatusAloca`
			) VALUES (
				NULL, 
				'0', 
				'$orgao', 
				'$prioridade', 
				'$senha', 
				'0', 
				current_timestamp(), 
				'".IP_LOCAL."', 
				'0',
				'1'
			)";

            $submit = \Sistema\Controle\Conexao::conectar()->prepare($sql);
            $submit->execute();

            if ($submit->rowCount() > 0) {

	 			 $_SESSION['senha'] = $senha;

	    		return true;

            }else{

                return false;

            }

	}

	private function generatePassword($prioridade = 1, $qtyCaraceters = 8){
 
    //Números aleatórios
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers = 123456789;
 
    $characters = $numbers;
 
    //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
    $senha = substr(str_shuffle($characters), 0, $qtyCaraceters);

    if($prioridade == 1 ){
    	$senha = 'A'.$senha;
    }else{
    	$senha = 'P'.$senha;
    }
	    //Retorna a senha
	    return $senha ;
	}

 	private function show_Mensage(){
        if(!empty($this->mensage)){
            throw new Exception(json_encode($this->mensage));
         }
    }

    private function set_Mensage($mensage = []){
        $this->mensage = $mensage;
        return $this->mensage;
    }

}
?>