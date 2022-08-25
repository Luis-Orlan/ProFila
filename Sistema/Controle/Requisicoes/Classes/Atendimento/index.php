<?php

class Atendimento{

	private $mensage = [];
	public $senha;
	public $dado;

	public function fs_Ponto($paremetro = []){

		if(!empty($paremetro->mesa)){
			if(!empty($paremetro->orgao)){
				if ($this->abrePonto($paremetro->orgao)) {
					if($this->reservaMesa($paremetro->mesa)){
						$_SESSION['mesaAtendimento'] = array();
						$_SESSION['mesaAtendimento']['mesa'] = $paremetro->mesa;
						$_SESSION['mesaAtendimento']['setor'] = $paremetro->orgao;

						$this->set_Mensage(["tipo" => "alert-success", "msg" => "Ponto aberto, voce sera redirecionado.",  "url" => "\\PontoDeAtendimento"]);
					}else{
						$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Mesa indisponivel, atualize e tente novamente. 01"]);
					}
				}else{
						$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Mesa indisponivel, atualize e tente novamente. 02"]);
					}
				
			}else{
				$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Falha ao selecionar o Setor."]);
			}

		}else{
			$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Falha ao abrir mesa de Atendimento."]);
		}

		$this->show_Mensage();
	}

	private function abrePonto($orgao = ''){
		 $sql = "SELECT * 
					FROM `tb_mesaatendimento` AS `m` 
					WHERE `m`.`ma_SenhaAlocada`='0'
					AND
					`m`.`ma_Setor`= '$orgao'
					ORDER BY `m`.`ma_Mesa` ASC
					LIMIT 1";

            $submit = \Sistema\Controle\Conexao::conectar()->prepare($sql);
            $submit->execute();
            if ($submit->rowCount() > 0) {
            	$dado = $submit->fetchAll(\PDO::FETCH_ASSOC);
            	foreach($dado as $v_){
            		$dado_ID = $v_['ma_ID'];
            	}
            	
            	$this->dado = $dado_ID;

	    		return $this->dado;

            }else{

                return false;

            }


	}

	private function reservaMesa($mesa = false, $orgaoID = false){
		 
		 $sql = "UPDATE 
		 			 `tb_mesaatendimento` 
		 		 SET 
		 		 	 `ma_SenhaAlocada` = '1', 
		 		 	 `ma_IP_Local_OpenMesa` = '".IP_LOCAL."',
		 		 	 `ma_DataHora` = current_timestamp()
		 		 WHERE 
		 		 	 `tb_mesaatendimento`.`ma_ID` = $mesa";

            $submit = \Sistema\Controle\Conexao::conectar()->prepare($sql);
            $submit->execute();

            if ($submit->rowCount() > 0) {

                $dado = $submit->fetchAll(\PDO::FETCH_ASSOC);

                $_SESSION['mesaAtendimento'] = array();
                $_SESSION['mesaAtendimento'] = 1;
                
	 			 //Retorna a senha
	    		return true;

            }else{

                return false;

            }


	}

	public function fs_Inicia($paremetro = []){
		print_r(json_encode('Pronto '));
		if(!empty($paremetro->senha)){
			if(!empty($paremetro->mesa)){
				if(!empty($paremetro->idMesa)){
					if(!empty($paremetro->idSenha)){
						$ip = IP_LOCAL;
						$sql1 = "UPDATE 
						 			 `tb_mesaatendimento` 
						 		 SET 
						 		 	 `ma_SenhaAlocada` = '2', 
						 		 	 `ma_IP_Local_OpenMesa` = '$ip',
						 		 	 `ma_DataHora` = current_timestamp()
						 		 WHERE 
						 		 	 `tb_mesaatendimento`.`ma_ID` = $paremetro->idMesa";

						$sql0 ="UPDATE 
									`tb_atendimentosenha` 
								SET 
									`as_NumeroMesa` = $paremetro->mesa,
								 	`as_StatusAloca` = '2' ,
								 	`as_DataHora` = current_timestamp(), 
								 	`as_IP_Local_Senha_Atendida` = '$ip' 
								WHERE 
									`tb_atendimentosenha`.`as_ID` = $paremetro->idSenha";
			            
			            $submit = \Sistema\Controle\Conexao::conectar()->prepare($sql0);
			            $submit->execute();

			            if ($submit->rowCount() > 0) {
				    		$submit2 = \Sistema\Controle\Conexao::conectar()->prepare($sql1);
			            	$submit2->execute();

			            	if ($submit2->rowCount() > 0){
			            		$this->set_Mensage(["tipo" => "alert-success", "msg" => "Em atendimento..."]);
			            	}else{
			            		$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Falha ao atualizar a ID da Senha. 06"]);
			            	}
			            }else{

			                $this->set_Mensage(["tipo" => "alert-danger", "msg" => "Falha ao atualizar a ID da mesa. 05"]);

			            }

			            
					}else{
						$this->set_Mensage(["tipo" => "alert-danger", "msg" => "ID da Senha indisponivel, atualize e tente novamente. 04"]);
					}
				}else{
					$this->set_Mensage(["tipo" => "alert-danger", "msg" => "ID da Mesa indisponivel, atualize e tente novamente. 03"]);
				}
			}else{
				$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Mesa indisponivel, atualize e tente novamente. 02"]);
			}
		}else{
			$this->set_Mensage(["tipo" => "alert-danger", "msg" => "Senha indisponivel, atualize e tente novamente. 01"]);
		}
		$this->show_Mensage();
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