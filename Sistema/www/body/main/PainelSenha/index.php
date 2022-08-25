<?php
require_once __DIR__.'\SQL'._INDEX;
?>
<script type="text/javascript">
setTimeout(function() {
    window.location.reload();
}, 15000);	
</script>
<header class="ps_faixa_superior">
	<h1 class="ps_fs_h1"><?=_NOME;?></h1>
</header>
	
	<main class="grid-7-3">
		<div class="ps_inf_senha">
			<?php if(!empty($painel['as_SenhaPainel'])){ ?>
			<div class="ps_inf_senha ">
				Senha 
			</div>
			
			<div class="ps_senha  piscar">
				<?php echo $painel['as_SenhaPainel'];?>
			</div>
			<?php }  ?>

			<div class="grid-auto">
				<?php if(!empty($painel['as_Setor'])){ ?>
				<div class="ps_inf_orgao ">
					SETOR
				</div>
				<div class="ps_orgao  piscar">
					<?php echo $painel['as_Setor'];?>
				</div>
				<embed style='visibility: hidden;' src="\som/beep.mp3" autostart="false" width="0" height="0" id="sound1"enablejavascript="true">
				<?php } ?>
			</div>
		</div>
		<div>
			<?php if(!empty($data['ma_Mesa'])){ ?>
			<div class="ps_inf_mesa">
				Mesa
			</div>

			<div class="grid-auto">
				<div class="ps_mesa piscar">
					<?php  echo $data['ma_Mesa'];?>
				</div>
				
				<div class="grid-auto">
					<?php if(!empty($painel['as_NivelPrioridade']) && $painel['as_NivelPrioridade'] == 2){ ?>
					<div class="txt-center ps_inf_orgao piscar">PREFERENCIAL</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>

		</div>
	<footer class="ps_faixa_inferior bg-prodesp ">
		<div class="grid-2-8">
			<div class="ps_ult_chamadas txt-right p-b-2 p-t-8 font">
				ÚLTIMAS<br/>
				CHAMADAS
			</div>
			<div class="grid-4">
				<?php if($submit_OLD->rowCount() > 0){ ?>
				<?php 
                foreach($data_old as $v_){  ?>
           			
         
				<div class="ps_ult_senha_ch p-b-2">
					<div class="grid-7-3 p-l-2" >
						<div class="txt-left p-t-2 p-l-2">
							<div class="ps_info_senha_ant">Senha</div>
							<div class="ps_senha_ant"> <?=$v_['as_SenhaPainel'];?></div>
						</div>
						<div class="txt-right p-t-2">
							<div class="ps_info_senha_ant txt-right p-r-5">Mesa</div>
							<div class="ps_senha_ant txt-right  p-r-3"> <?=$v_['as_NumeroMesa'];?></div>
						</div>
					</div>
					<div class="ps_org_an_info txt-left p-l-4">SETOR</div>
					<div class="ps_org_an txt-left p-l-2"><?php echo $v_['as_Setor']; ?></div>
					<?php if($v_['as_NivelPrioridade'] == 2){ ?>
						<div class="ps_pref_an p-t-2 txt-center">PREFERENCIAL</div>
					<?php } ?>
				</div>
 				<?php  } } 
 				?>
				
			</div>
		</div>
	</footer>
	<?php 
	if (!empty($_SESSION['chamadas'])) {
		if ($_SESSION['chamadas'] > 2) {
			if (!empty($painel['as_NumeroMesa'])) {
				$mesaAtual = $painel['as_NumeroMesa'];
			}else{
				$mesaAtual = 0;
			}
			$senha = $_SESSION['chamadas']['senha'];
			$sql_timeout = "UPDATE 
								`tb_atendimentosenha` 
							SET
								`as_StatusAloca` = '3'
							WHERE 
								`tb_atendimentosenha`.`as_SenhaPainel` = '$senha'";

			$submit_timeout = \Sistema\Controle\Conexao::conectar()->prepare($sql_timeout);
			$submit_timeout ->execute();

			unset($_SESSION['chamadas']['senha']);
			unset($_SESSION['chamadas']['qtd']);
			unset($_SESSION['chamadas']['prioridade']);
			unset($_SESSION['chamadas']['setor']);
			unset($_SESSION['chamadas']);
		}else{
			$_SESSION['chamadas'] =+ 1;
		}
	}else{
		if (!empty($painel['as_SenhaPainel'])) {
		
			$_SESSION['chamadas']['prioridade'] = $painel['as_NivelPrioridade'];
			$_SESSION['chamadas']['senha'] = $painel['as_SenhaPainel'];
			$_SESSION['chamadas']['setor'] = $painel['as_Setor'];
			$_SESSION['chamadas']['qtd'] =+ 1;
		}
	}
	?>

	<style type="text/css">
		
		@-webkit-keyframes flash{
    0%,50%,to{
        opacity:1
    }
    25%,75%{
        opacity:0
    }
}
@keyframes flash{
    0%,50%,to{
        opacity:1
    }
    25%,75%{
        opacity:0
    }
}
.flash{
    -webkit-animation-name:flash;
    animation-name:flash;
}

</style>