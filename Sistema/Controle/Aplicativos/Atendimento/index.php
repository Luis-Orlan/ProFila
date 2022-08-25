<?php
	class Atendimento{

		public $pagina = "Atendimento"; 

		public function index(){
			require_once __DIR__.'/../../../www/body'._INDEX;
		}

		public function main(){
			if (is_file(__DIR__.'/../../../www/body/main/'.URL_0.'/Abrir'._INDEX)) {
				if(!empty(URL_1)){
					require_once __DIR__.'/../../../www/body/main/'.URL_0.'/Abrir'._INDEX;
				}else{
					require_once __DIR__.'/../../../www/body/main/'.$this->pagina._INDEX;
				}
			}else{
				require_once __DIR__.'/../../../www/body/main/'.$this->pagina._INDEX;
			}
		}
	}
?>
