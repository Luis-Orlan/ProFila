<?php $setor = str_replace('-',' ', URL_1);?>
<div class="bg-white container py-5 ">
    <div class="card text-center ">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs pt-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="true" href="#"><?php echo $setor; ?></a>
          </li>
        </ul>

        <p style='margin-top:-3rem;'>IP Terminal: <strong><?php echo IP_LOCAL;?></strong></p>
          <a href='\Recepcao' class="btn btn-dark btn-sm" style="float:right;margin-top: -2.35rem">Voltar</a>
      </div>
      <div class="card-body row justify-content-lg-center">
        <div class='col-lg-auto py-3'>
        <p class="h5">Recepção | <?php echo $setor; ?></p>
        <hr>
        <div id="resposta" class="alert " style='display:none'></div>
        <form class="form-js text-center justify-content-center">
          <select name="tipoAtendimento" class="form-select form-select-lg" required>
            <option selected value="1">Nomal</option>
            <option value="2">Preferencial</option>
          </select>  
          <input type="hidden" name="token" value="Painel">
          <input type="hidden" name="key" value="GerarSenha">
          <input type="hidden" name="orgao" value="<?php echo $setor; ?>">
        </form>
        
        <div class="pt-4  text-center" id="printable" style="max-width: 220px;background-color: rgba(255, 255, 0, .3);visibility: hidden;">
                <div style="max-width: 240px;padding: 0 1rem 0 1rem;">
                  <img  class="img-fluid" src="\imagens/logo_prodesp.png" />
                </div>
                <p  class='text-center pt-2'><strong>Atenção</strong></p>
                <p class='text-center' style="margin-top: -1.4rem;"><strong style="font-size: .8rem;margin: 0;">Sua senha sera</p><p class="text-center">chamada no Painel</strong></p>
                <p id="hora" class="mb-1" style="font-size: .8rem;margin-top:-1rem;"></p>
                <p>
                  <div style="border-top: 2px solid black;width:100%;margin-bottom:1rem;"></div>
                  <sub class="pt-1 mb-1 h6 text-center">SETOR</sub>
                </p>
  
                <sup class="mt-0 pt-0 h4 text-center"><?php echo $setor; ?></sup>
                <p class="text-center" style="margin-bottom: -.9rem;"><sub class="pt-1 h6 text-center" >SENHA</sub></p>
                <p class="text-center p-l-4">
                  <div style="border-top: 2px solid black;width:70%;margin-bottom:1rem;position: relative;left:15%"></div>
                  <sup class="h1 senha" style="font-size: 3rem;" id="senha">XXXXX</sup>
                </p>
                
              </div>
        <button type="button" class="btn btn-prodesp btn-js py-3" style="margin-top: -36rem;" >Gerar Senha</button>
        <button type="button" class="btn-prodesp" id="btn-p" style="display: none;" onclick="window.print(document.getElementById('printable'))">Imprimir</button>
            
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">

var mgs = document.getElementById("resposta"), btn = document.querySelector(".btn-js"), senha = document.getElementById("senha"), print_ = document.getElementById("printable"), btn_print = document.getElementById("btn-p"), form_JS =  document.querySelector(".form-js");

btn.addEventListener("click", function() {
    let fom = document.querySelector('.form-js'), r_ = "Essa requisição não funcionou.";
    let formData = new FormData(fom), object = {};

    formData.forEach((value, key) => object[key] = value);

    let json = JSON.stringify(object), 
    ajax = new XMLHttpRequest();

    ajax.open("POST", "index.php", true), 
    ajax.setRequestHeader("Content-type", "application/json"), 
    ajax.send(json), ajax.onreadystatechange = function() {
      form_JS.style.display = 'none';
      mgs.style.display = 'inline-block';
      btn.disabled = true;
      mgs.classList.remove("alert-dange"); 
      if (ajax.readyState == 4 && ajax.status == 200) {
        
        let data = JSON.parse(ajax.responseText);
        console.log(data);
        if (data.tipo != '') {
          mgs.classList.add(data.tipo);
        }

        if (data.msg != '') {
          mgs.innerHTML = data.msg;
        }else{
          mgs.innerHTML = "Dado não carregado";
        }
         
        if (data.senha != '') {
          senha.innerHTML = data.senha;
        }else{
          senha.innerHTML = "Dado não carregado";
        }
        

        }else{
          mgs.classList.remove("alert-success");
          mgs.classList.add("alert-dange");
          mgs.innerHTML = r_;   
        }
        
        
        print_.style.visibility = 'visible';
        btn.style.display = 'none';  
        btn_print.style.display = 'inline-block';
        setTimeout(function() {
          setTimeout(function() {
            mgs.style.display = 'none'; 
            btn.disabled = false;
         }, 5000); 
        }, 10000);     
      }
  });

setInterval(function() {

        const today = new Date();
        const mes = today.getMonth() + 1;
        let todayMonth;

        if (mes < 10) {
          todayMonth = '0' + mes;
        } else {
          todayMonth = mes.toString();
        }

        const min = new Date();
        const minTo = min.getMinutes() + 1;
        let todayMin;

        if (minTo < 10) {
          todayMin = '0' + minTo;
        } else {
          todayMin = minTo.toString();
        }

        var d = new Date(),
            n0_0 = d.getDate(),
            n0_2 = d.getFullYear(),
            n1 = d.getHours(),
            n2 = d.getMinutes();
        document.getElementById("hora").innerHTML = 'Hora: <strong>' + n1 + ':' + minTo + '</strong> | Data: <strong>' + n0_0 + '/' + todayMonth + '/' + n0_2 + '</strong>';
    }, 1100);
</script>

<style type="text/css">
  @media print {
  body * {
    visibility: hidden;
  }
  #printable, #printable * {
    visibility: visible;
  }
  #printable {
    position: fixed;
    left: 0;
    top: 0;
  }
}
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

</style>