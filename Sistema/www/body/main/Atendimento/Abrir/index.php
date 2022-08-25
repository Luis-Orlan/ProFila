<?php require_once __DIR__.'\../SQL'._INDEX; ?>
<div class="bg-white container py-5 ">
    <div class="card text-center ">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs pt-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="true" href="#">Geral</a>
          </li>
        </ul>

        <p style='margin-top:-3rem;'>IP Terminal: <strong><?php echo IP_LOCAL;?></strong></p>
          <a href='\Atendimento' class="btn btn-dark btn-sm" style="float:right;margin-top: -2.35rem">Voltar</a>
      </div>
      <div class="card-body row justify-content-lg-center">
        <div class='col-lg-auto py-3'>
        <h5 class="card-title"><?php echo $setor; ?></h5>

        <div id="resposta" class="alert " style='display:none'></div>
        <p class="card-text">Abrir Mesa de Atendimento</p>
        <form class="form-geral">
            <select class="form-select form-select-lg text-center" name='mesa'>
                <option selected disabled>Selecione a Mesa</option>
                <?php 
                    if (is_array($data) || is_object($data)){
                        foreach($data as $v_){  ?>
                <option value="<?=$v_['ma_ID'];?>">Mesa <?=$v_['ma_Mesa'];?></option>
                <?php   } 
                    }
                ?>
            </select>
            <input type="hidden" name="token" value="Atendimento">
            <input type="hidden" name="key" value="Ponto">
            <input type="hidden" name="orgao" value="<?php echo $setor; ?>">
        </form>
        <button type="button" class="btn btn-prodesp btn-js py-3 mt-3">Abrir Mesa de Atendimento</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
var msg = document.getElementById("resposta"), btn_ = document.querySelector(".btn-js");
btn_.addEventListener("click", function() {
    let geral = document.querySelector('.form-geral'), r_ = "Essa requisição não funcionou.";
    let formData = new FormData(geral), object = {};

    formData.forEach((value, key) => object[key] = value);

    let json = JSON.stringify(object), 
    ajax = new XMLHttpRequest();

    ajax.open("POST", "index.php", true), 
    ajax.setRequestHeader("Content-type", "application/json"), 
    ajax.send(json), ajax.onreadystatechange = function() {
        btn_.disabled = true;
        
            if (ajax.readyState == 4 && ajax.status == 200) {
                let data = JSON.parse(ajax.responseText);
                msg.classList.remove("alert-dange");
                msg.style.display = 'block'; 
                msg.classList.add(data.tipo);    
                msg.innerHTML = data.msg;

              if(data.url){
                    setTimeout(function() {
                        window.location.href = data.url;
                    }, 2000);
                }
            }else{

                msg.classList.remove("alert-success");
                msg.style.display = 'block'; 
                msg.classList.add(data.tipo);
                
                msg.innerHTML = r_;   

            }
             
            setTimeout(function() {
            
                setTimeout(function() {
                    msg.style.display = 'none'; 
                    btn_.disabled = false;
                }, 1000);   
            }, 3500);     
        }
});
</script>