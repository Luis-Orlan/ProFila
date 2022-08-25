<?php if ($_SESSION['mesaAtendimento'] == true): ?>
<?php
$id = $_SESSION['mesaAtendimento']['mesa'];
require_once __DIR__.'\SQL'._INDEX;
?>
<style>
	.senha_m{
		font-size: 6rem;
	}
	.deslogar_mobile{
		display: none;
	}
@media (max-width: 720px){
	.senha_m{
		font-size: 3rem;
	}
	.deslogar_desktop{
		visibility: hidden;
	}
	.deslogar_mobile{ 
		display: inline-block;
	}
}
</style>
<div class="p-5">
	<main class="container text-center col-md-6">
	<div class="card  ">
	<a href="\Atendimento" class="btn btn-danger p-3 m-2 deslogar_mobile btn-small">Deslogar</a>
		<div class="card-header p-2 text-center">
			<div class="row p-2 ">
				<div class="col-lg-2 deslogar_desktop"><a href="\Atendimento" class="btn btn-danger p-3 ">Deslogar</a></div>
			</div>
			<div style="margin-top: -4rem;">
				<h5>Ponto aberto | Mesa <?php echo $s_[0]['ma_Mesa'];?></h5>
				<h3><?php echo $_SESSION['mesaAtendimento']['setor'];?></h3>
			</div>
			
		</div>
		<div class="card-body text-center" style="padding: 4rem;text-align:center;">
			<?php if(empty($data[0]['as_SenhaPainel'])): ?>
				<div class="text-center pb-2">
				  <div class="spinner-grow" role="status">
				    <span class="visually-hidden">Loading...</span>
				  </div>
				</div>
				<hr>
				<h3 class="">Aguardando Senha</h3>
				<script type="text/javascript">
setTimeout(function() {
 	window.location.reload();
}, 10000);
</script>
			<?php else: ?>
				<?php if($data[0]['ma_ID'] != $id): ?>
				<div class="text-center pb-5">
				  <div class="spinner-grow" role="status">
				    <span class="visually-hidden">Loading...</span>

				  </div>
				</div>
				<hr>
				<h3 class="">Aguardando Senha</h3>
				<script type="text/javascript">
setTimeout(function() {
 	window.location.reload();
}, 10000);
</script>
				<?php else: ?>
					<p>Senha:</p>
					<h1 class="flash senha_m"><?php echo $data[0]['as_SenhaPainel']; ?></h1>
					<script type="text/javascript">
setTimeout(function() {
 	window.location.reload();
 	setTimeout(function() {
	 	window.location.reload();
	}, 10000);
}, 26000);
</script>
				<?php endif; ?>
			<?php endif; ?>
			
		<form class="form-js">
			<input type="hidden" name="token" value="Atendimento">
            <input type="hidden" name="key" value="Inicia">
			<input type="hidden" name="mesa" value="<?php echo $data[0]['ma_Mesa'];  ?>">
			<input type="hidden" name="senha" value="<?php echo $data[0]['as_SenhaPainel']; ?>">
			<input type="hidden" name="idMesa" value="<?php echo $id; ?>">
			<input type="hidden" name="idSenha" value="<?php echo $data[0]['as_ID'];  ?>">
		</form>
		</div>
		<div class="card-footer">
			<div class="p-2">
				<div id="resposta" class="alert " style="display: none;"></div>
			</div>
			
			<div class="row">
				<div class="col-lg-12">
					<button class="btn btn-prodesp btn-js <?php if($data[0]['ma_ID'] != $id){ echo 'disabled';} ?>" >
						Iniciar Atendimento
					</button>
					<div class="col-lg-6">
						<a href="\Atendimento" class="btn btn-success p-4 atend" style="display: none;">Encerrar Atendimento</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</div>
<script type="text/javascript">
var mgs = document.getElementById("resposta"), btn = document.querySelector(".btn-js"), atend = document.querySelector(".atend");

btn.addEventListener("click", function() {
    let fom = document.querySelector('.form-js'), r_ = "Essa requisição não funcionou.";
    let formData = new FormData(fom), object = {};

    formData.forEach((value, key) => object[key] = value);

    let json = JSON.stringify(object), 
    ajax = new XMLHttpRequest();

    ajax.open("POST", "index.php", true), 
    ajax.setRequestHeader("Content-type", "application/json"), 
    ajax.send(json), ajax.onreadystatechange = function() {

      mgs.style.display = 'inline-block';
      btn.disabled = true;
      mgs.classList.remove("alert-dange"); 
      if (ajax.readyState == 4 && ajax.status == 200) {
        
        let data = JSON.parse(ajax.responseText);

	        if (data.tipo != '') {
	          mgs.classList.add(data.tipo);
	        }

	        if (data.msg != '') {
	          mgs.innerHTML = data.msg;
	        }else{
	          mgs.innerHTML = "Dado não carregado";
	        }
	              

        }else{
          mgs.classList.remove("alert-success");
          mgs.classList.add("alert-dange");
  
        }
        atend.style.display = 'block';
        
        btn.style.display = 'none';  
        setTimeout(function() {
          setTimeout(function() {
            mgs.style.display = 'none'; 
            btn.disabled = false;
         }, 5000); 
        }, 10000);     
      }
  });
</script>
<pre>
<?php 
else:
	header("Location: \\");
	exit();
endif;
?>
</pre>
<style type="text/css">
	.btn-prodesp{
    cursor: pointer;
    padding: 1rem;
    margin: 1.4rem;
    background-color: rgb(84,12,124) !important;
    color: white !important;
    border-radius: .4rem;
    font-weight: 600;
    font-size: 1.3rem;
}

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
    animation-duration: 1s;
}
</style>